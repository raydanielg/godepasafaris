<?php

namespace Tests\Feature;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BookingSpamTest extends TestCase
{
    use RefreshDatabase;

    public function test_honeypot_submission_is_silently_dropped(): void
    {
        Mail::fake();

        $response = $this->from('/')->post('/booking/store', [
            'name'    => 'SpamBot',
            'email'   => 'bot@spam.example',
            'phone'   => '+000000000',
            'message' => 'buy cheap stuff http://spam.link',
            'website' => 'http://filled-by-bot.example', // honeypot filled = bot
        ]);

        $response->assertRedirect('/');
        $this->assertSame(0, Booking::count(), 'Honeypot submission must NOT be saved.');
    }

    public function test_clean_submission_is_saved(): void
    {
        Mail::fake();

        $response = $this->from('/')->post('/booking/store', [
            'name'    => 'Real Customer',
            'email'   => 'real@customer.example',
            'phone'   => '+255700000000',
            'message' => 'We would love a 5-day Serengeti safari in August.',
            'website' => '', // honeypot empty = human
        ]);

        $response->assertRedirect('/');
        $this->assertSame(1, Booking::count(), 'A clean submission must be saved.');
        $this->assertDatabaseHas('bookings', ['email' => 'real@customer.example']);
    }
}
