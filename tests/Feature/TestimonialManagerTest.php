<?php

namespace Tests\Feature;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class TestimonialManagerTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name'      => 'Sarah Mitchell',
            'location'  => 'United Kingdom',
            'content'   => 'The Machame route was tough but our guide got all six of us to the summit.',
            'rating'    => 5,
            'is_active' => 1,
        ], $overrides);
    }

    // ------------------------------------------------------------- security

    public function test_guests_and_non_admins_cannot_manage_testimonials(): void
    {
        $t = Testimonial::create($this->payload());

        $this->get(route('admin.testimonials'))->assertRedirect();
        $this->post(route('admin.testimonials.store'), $this->payload())->assertRedirect();
        $this->delete(route('admin.testimonials.destroy', $t))->assertRedirect();

        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user)->get(route('admin.testimonials'))->assertForbidden();
        $this->actingAs($user)->delete(route('admin.testimonials.destroy', $t))->assertForbidden();

        $this->assertDatabaseHas('testimonials', ['id' => $t->id]);
    }

    // ---------------------------------------------------------------- CRUD

    public function test_admin_can_add_edit_hide_and_delete_a_testimonial(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->post(route('admin.testimonials.store'), $this->payload())->assertRedirect();
        $t = Testimonial::firstOrFail();
        $this->assertSame('Sarah Mitchell', $t->name);
        $this->assertSame(1, $t->display_order);

        $this->actingAs($admin)->put(route('admin.testimonials.update', $t), $this->payload([
            'name' => 'Sarah M.', 'rating' => 4,
        ]))->assertRedirect();
        $this->assertSame('Sarah M.', $t->fresh()->name);
        $this->assertSame(4, $t->fresh()->rating);

        // hiding keeps the record but pulls it off the website
        $this->actingAs($admin)->post(route('admin.testimonials.toggle', $t))->assertRedirect();
        $this->assertFalse($t->fresh()->is_active);
        $this->assertCount(0, Testimonial::active()->get());

        $this->actingAs($admin)->delete(route('admin.testimonials.destroy', $t))->assertRedirect();
        $this->assertDatabaseMissing('testimonials', ['id' => $t->id]);
    }

    public function test_a_testimonial_needs_real_content_and_a_sane_rating(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->post(route('admin.testimonials.store'), $this->payload(['content' => 'Great']))
            ->assertSessionHasErrors('content');

        $this->actingAs($admin)
            ->post(route('admin.testimonials.store'), $this->payload(['rating' => 9]))
            ->assertSessionHasErrors('rating');

        $this->actingAs($admin)
            ->post(route('admin.testimonials.store'), $this->payload(['travelled_on' => now()->addYear()->toDateString()]))
            ->assertSessionHasErrors('travelled_on');

        $this->assertSame(0, Testimonial::count());
    }

    public function test_featured_testimonials_come_first(): void
    {
        Testimonial::create($this->payload(['name' => 'First Added']));
        Testimonial::create($this->payload(['name' => 'Featured One', 'is_featured' => true]));

        $this->assertSame('Featured One', Testimonial::active()->first()->name);
    }

    // --------------------------------------------------------------- photos

    public function test_photo_uploads_are_stored_and_bad_files_rejected(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->post(route('admin.testimonials.store'), $this->payload([
            'photo' => UploadedFile::fake()->create('sarah.jpg', 64, 'image/jpeg'),
        ]))->assertRedirect()->assertSessionHasNoErrors();

        $t = Testimonial::firstOrFail();
        $this->assertStringStartsWith('uploads/testimonials/', $t->image);
        $this->assertFileExists(public_path($t->image));
        File::delete(public_path($t->image));

        $this->actingAs($admin)->post(route('admin.testimonials.store'), $this->payload([
            'name'  => 'Payload',
            'photo' => UploadedFile::fake()->create('evil.php', 8, 'application/x-php'),
        ]))->assertSessionHasErrors('photo');
    }

    public function test_missing_photo_falls_back_to_an_initial_not_a_stock_face(): void
    {
        $t = Testimonial::create($this->payload(['name' => 'sarah mitchell']));

        $this->assertNull($t->image_url);
        $this->assertSame('S', $t->initial);
    }

    public function test_rating_is_clamped_for_display(): void
    {
        $t = Testimonial::create($this->payload());
        $t->forceFill(['rating' => 99])->save();

        $this->assertSame(5, $t->fresh()->stars);
    }

    // ------------------------------------------------------- public output

    public function test_site_shows_no_testimonial_section_when_none_exist(): void
    {
        $html = $this->get('/testimonials')->assertOk()->getContent();

        $this->assertStringNotContainsString('pravatar', $html);
        $this->assertStringNotContainsString('John Doe', $html);
        $this->assertStringContainsString('first reviews are on their way', $html);
    }

    public function test_hidden_testimonials_never_reach_the_public_page(): void
    {
        Testimonial::create($this->payload(['name' => 'Visible Guest']));
        Testimonial::create($this->payload(['name' => 'Hidden Guest', 'is_active' => false]));

        $html = $this->get('/testimonials')->assertOk()->getContent();

        $this->assertStringContainsString('Visible Guest', $html);
        $this->assertStringNotContainsString('Hidden Guest', $html);
    }
}
