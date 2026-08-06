<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Support\FormTiming;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BookingSaveIntegrityTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(): array
    {
        // Age the timing token so it clears the "submitted too fast" gate.
        \Illuminate\Support\Carbon::setTestNow(now()->subSeconds(10));
        $formTs = FormTiming::token();
        \Illuminate\Support\Carbon::setTestNow();

        return [
            'name'               => 'Real Customer',
            'email'              => 'real@customer.example',
            'phone_country_code' => '+255',
            'phone'              => '700000000',
            'travel_date'        => now()->addMonths(2)->toDateString(),
            'travelers'          => '2',
            'message'            => 'A 5-day Serengeti safari please.',
            'website'            => '',
            'form_ts'            => $formTs,
        ];
    }

    /**
     * THE core requirement: if the database insert fails, the customer must NOT
     * be shown "booking received" — they must get a real error, and nothing is
     * reported as saved. Simulate a DB failure with a model event that throws.
     */
    public function test_failed_save_returns_error_not_received(): void
    {
        Mail::fake();

        Booking::creating(function () {
            throw new \RuntimeException('Simulated DB failure');
        });

        $response = $this->postJson('/booking/store', $this->validPayload());

        $response->assertStatus(500);
        $response->assertJson(['success' => false]);

        // Must not claim the booking was received.
        $this->assertStringNotContainsStringIgnoringCase('received', $response->json('message') ?? '');
        $this->assertSame(0, Booking::count(), 'A failed save must leave no booking.');

        // And no customer/admin email should imply a successful booking.
        Mail::assertNothingSent();
    }

    /**
     * The happy path still works end-to-end: saved + success message.
     */
    public function test_successful_save_shows_received_and_persists(): void
    {
        Mail::fake();

        $response = $this->postJson('/booking/store', $this->validPayload());

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertStringContainsStringIgnoringCase('received', $response->json('message'));
        $this->assertDatabaseHas('bookings', ['email' => 'real@customer.example']);
    }
}
