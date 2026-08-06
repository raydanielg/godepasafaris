<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use App\Support\FormTiming;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BookingSubmissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    /** A booking submitted with realistic timing and valid data should succeed. */
    public function test_valid_booking_succeeds(): void
    {
        $response = $this->postJson(route('booking.store'), $this->validPayload());

        $response->assertOk()->assertJson(['success' => true]);

        $this->assertDatabaseCount('bookings', 1);
        $booking = Booking::first();
        $this->assertSame('+255712345678', $booking->phone);
        $this->assertSame('127.0.0.1', $booking->ip_address);
    }

    /** A travel date in the past (e.g. 1985) must be rejected server-side. */
    public function test_past_travel_date_is_rejected(): void
    {
        $response = $this->postJson(route('booking.store'), array_merge(
            $this->validPayload(),
            ['travel_date' => '1985-01-01']
        ));

        $response->assertStatus(422)->assertJsonValidationErrors('travel_date');
        $this->assertDatabaseCount('bookings', 0);
    }

    /** Garbage phone numbers should fail validation instead of being stored. */
    public function test_invalid_phone_is_rejected(): void
    {
        $response = $this->postJson(route('booking.store'), array_merge(
            $this->validPayload(),
            ['phone' => 'abc']
        ));

        $response->assertStatus(422)->assertJsonValidationErrors('phone');
        $this->assertDatabaseCount('bookings', 0);
    }

    /** Bots that fill the honeypot field get a fake "success" but nothing is saved. */
    public function test_honeypot_submission_is_silently_dropped(): void
    {
        $response = $this->postJson(route('booking.store'), array_merge(
            $this->validPayload(),
            ['website' => 'http://spam.example']
        ));

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseCount('bookings', 0);
    }

    /**
     * A too-fast submission gets a real, visible error (not a fake
     * "success") — unlike the honeypot, this can happen to genuine visitors
     * (fast testers, autofill), so it must never look like it worked when
     * it didn't.
     */
    public function test_too_fast_submission_is_rejected_with_a_visible_error(): void
    {
        // FormTiming::token() encodes "now", so submitting it immediately
        // yields ~0 elapsed seconds — well under the 3s minimum.
        $response = $this->postJson(route('booking.store'), array_merge(
            $this->validPayload(),
            ['form_ts' => FormTiming::token()]
        ));

        $response->assertStatus(422)->assertJson(['success' => false]);
        $this->assertDatabaseCount('bookings', 0);
    }

    /** A form_ts token old enough to look human-paced is accepted. */
    public function test_submission_with_realistic_delay_is_accepted(): void
    {
        $oldToken = Crypt::encryptString((string) now()->subSeconds(10)->timestamp);

        $response = $this->postJson(route('booking.store'), array_merge(
            $this->validPayload(),
            ['form_ts' => $oldToken]
        ));

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseCount('bookings', 1);
    }

    /** Five honeypot/timing strikes from the same IP earn a temporary block. */
    public function test_repeated_spam_attempts_get_the_ip_temporarily_blocked(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->postJson(route('booking.store'), array_merge(
                $this->validPayload(),
                ['website' => 'spam']
            ));
        }

        // A perfectly valid submission from the same (now-blocked) IP is rejected.
        $response = $this->postJson(route('booking.store'), $this->validPayload());

        $response->assertStatus(429);
        $this->assertDatabaseCount('bookings', 0);
    }

    /** Non-admin authenticated users must not reach the admin bookings area. */
    public function test_non_admin_user_cannot_access_admin_bookings(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get(route('admin.bookings'));

        $response->assertForbidden();
    }

    /** Admin users can reach the admin bookings area. */
    public function test_admin_user_can_access_admin_bookings(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.bookings'));

        $response->assertOk();
    }

    protected function tearDown(): void
    {
        Cache::flush();
        parent::tearDown();
    }

    private function validPayload(): array
    {
        return [
            'name' => 'Jane Traveler',
            'email' => 'jane@example.com',
            'phone_country_code' => '+255',
            'phone' => '712345678',
            'tour_name' => 'General Inquiry',
            'travel_date' => now()->addMonths(2)->toDateString(),
            'travelers' => '2',
            'accommodation' => 'mid_range',
            'message' => 'Excited for this trip!',
            'form_ts' => Crypt::encryptString((string) now()->subSeconds(10)->timestamp),
        ];
    }
}
