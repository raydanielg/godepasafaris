<?php

namespace Tests\Feature;

use App\Mail\BookingInquiry;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminBookingToolsTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create();
    }

    private function seedBookings(int $n): void
    {
        for ($i = 1; $i <= $n; $i++) {
            Booking::create([
                'tour_name' => "Tour {$i}",
                'name'      => "Customer {$i}",
                'email'     => "c{$i}@example.com",
                'message'   => 'Interested.',
            ]);
        }
    }

    public function test_delete_all_removes_every_booking(): void
    {
        $this->seedBookings(3);
        $this->assertSame(3, Booking::count());

        $response = $this->actingAs($this->admin())
            ->delete(route('admin.bookings.delete-all'), [], ['Accept' => 'application/json']);

        $response->assertOk()->assertJson(['success' => true, 'deleted' => 3]);
        $this->assertSame(0, Booking::count());
    }

    public function test_restart_wipes_bookings_and_resets_id_to_one(): void
    {
        $this->seedBookings(3);

        $response = $this->actingAs($this->admin())
            ->post(route('admin.bookings.restart'), [], ['Accept' => 'application/json']);

        $response->assertOk()->assertJson(['success' => true, 'cleared' => 3]);
        $this->assertSame(0, Booking::count());

        // The very next booking must start at #1 again (full reset).
        $fresh = Booking::create(['name' => 'First', 'email' => 'first@example.com']);
        $this->assertSame(1, (int) $fresh->id, 'ID counter must reset to #1 after restart.');
    }

    public function test_test_notification_goes_to_both_configured_inboxes(): void
    {
        Mail::fake();

        $recipients = config('mail.booking_recipients');
        $this->assertIsArray($recipients);
        $this->assertContains('info@godeepafricasafari.com', $recipients);
        $this->assertContains('exaudlaizer501@gmail.com', $recipients);

        $response = $this->actingAs($this->admin())
            ->post(route('admin.bookings.test-email'), [], ['Accept' => 'application/json']);

        $response->assertOk()->assertJson(['success' => true]);

        Mail::assertSent(BookingInquiry::class, function ($mail) {
            return $mail->hasTo('info@godeepafricasafari.com')
                && $mail->hasTo('exaudlaizer501@gmail.com');
        });
    }

    public function test_public_booking_notifies_both_inboxes_and_customer(): void
    {
        Mail::fake();

        $this->from('/')->post('/booking/store', [
            'name'    => 'Real Customer',
            'email'   => 'real@customer.example',
            'phone'   => '+255700000000',
            'message' => 'A 5-day Serengeti safari please.',
            'website' => '',
        ])->assertRedirect('/');

        // Saved to the bookings system.
        $this->assertDatabaseHas('bookings', ['email' => 'real@customer.example']);

        // Company notification sent to BOTH configured inboxes.
        Mail::assertSent(BookingInquiry::class, function ($mail) {
            return $mail->hasTo('info@godeepafricasafari.com')
                && $mail->hasTo('exaudlaizer501@gmail.com');
        });

        // Customer gets their confirmation ("your booking has been sent").
        Mail::assertSent(\App\Mail\CustomerConfirmation::class, function ($mail) {
            return $mail->hasTo('real@customer.example');
        });
    }

    public function test_bulk_tools_require_authentication(): void
    {
        $this->delete(route('admin.bookings.delete-all'))->assertRedirect(route('login'));
        $this->post(route('admin.bookings.restart'))->assertRedirect(route('login'));
    }
}
