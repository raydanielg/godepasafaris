<?php

namespace Tests\Feature;

use App\Models\MenuLink;
use App\Models\MenuSection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class MegaMenuManagerTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    private function section(string $navItem = 'kilimanjaro'): MenuSection
    {
        return MenuSection::create([
            'nav_item'      => $navItem,
            'title'         => 'Climbing Kilimanjaro Guide',
            'description'   => 'A comprehensive guide.',
            'badge'         => '52 Reasons',
            'badge_color'   => 'success',
            'link_url'      => '/kilimanjaro',
            'link_text'     => 'Read Our Guide',
            'display_order' => 1,
            'is_active'     => true,
        ]);
    }

    private function link(MenuSection $section, string $title, int $order): MenuLink
    {
        return MenuLink::create([
            'menu_section_id' => $section->id,
            'title'           => $title,
            'url'             => '/kilimanjaro/' . strtolower(str_replace(' ', '-', $title)),
            'icon'            => 'fa-mountain',
            'badge_color'     => 'secondary',
            'display_order'   => $order,
            'is_active'       => true,
        ]);
    }

    // ---------------------------------------------------------------- security

    public function test_guests_cannot_reach_the_manager_or_mutate_menu_data(): void
    {
        $section = $this->section();
        $link = $this->link($section, 'Machame', 1);

        $this->get(route('admin.mega-menu'))->assertRedirect();
        $this->post(route('admin.mega-menu.section.update', $section), ['title' => 'Hacked'])->assertRedirect();
        $this->post(route('admin.mega-menu.links.store', $section), ['title' => 'X', 'url' => '/x'])->assertRedirect();
        $this->delete(route('admin.mega-menu.links.destroy', $link))->assertRedirect();

        $this->assertSame('Climbing Kilimanjaro Guide', $section->fresh()->title);
        $this->assertDatabaseHas('menu_links', ['id' => $link->id]);
    }

    public function test_logged_in_non_admins_are_forbidden(): void
    {
        $section = $this->section();
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get(route('admin.mega-menu'))->assertForbidden();
        $this->actingAs($user)
            ->post(route('admin.mega-menu.section.update', $section), ['title' => 'Hacked'])
            ->assertForbidden();

        $this->assertSame('Climbing Kilimanjaro Guide', $section->fresh()->title);
    }

    // ------------------------------------------------------------ feature card

    public function test_admin_can_open_the_manager_and_pick_a_category(): void
    {
        $this->section();

        $this->actingAs($this->admin())
            ->get(route('admin.mega-menu', ['section' => 'kilimanjaro']))
            ->assertOk()
            ->assertSee('Mega Menu Manager')
            ->assertSee('Climbing Kilimanjaro Guide');
    }

    public function test_unknown_category_falls_back_instead_of_erroring(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.mega-menu', ['section' => 'not-a-real-menu']))
            ->assertOk();
    }

    public function test_admin_can_edit_the_feature_card(): void
    {
        $section = $this->section();

        $this->actingAs($this->admin())
            ->post(route('admin.mega-menu.section.update', $section), [
                'title'       => '10 Reasons to Climb Kilimanjaro',
                'description' => 'A brand new description.',
                'badge'       => '10 Reasons',
                'badge_color' => 'warning',
                'link_text'   => 'Explore Kilimanjaro',
                'link_url'    => '/kilimanjaro/routes',
                'is_active'   => 1,
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $section->refresh();
        $this->assertSame('10 Reasons to Climb Kilimanjaro', $section->title);
        $this->assertSame('10 Reasons', $section->badge);
        $this->assertSame('warning', $section->badge_color);
        $this->assertSame('/kilimanjaro/routes', $section->link_url);
    }

    public function test_dangerous_urls_are_rejected(): void
    {
        $section = $this->section();

        $this->actingAs($this->admin())
            ->post(route('admin.mega-menu.section.update', $section), [
                'title'    => 'Still Fine',
                'link_url' => 'javascript:alert(1)',
            ])
            ->assertSessionHasErrors('link_url');

        $this->assertSame('/kilimanjaro', $section->fresh()->link_url);
    }

    public function test_uploaded_feature_image_is_stored_and_served_from_public_uploads(): void
    {
        $section = $this->section();

        // A mime-typed fake rather than fake()->image(): the latter needs the GD
        // extension to synthesise a real JPEG, and this codebase never processes
        // image contents — it only validates the type and moves the file.
        $this->actingAs($this->admin())
            ->post(route('admin.mega-menu.section.update', $section), [
                'title' => 'With Image',
                'image' => UploadedFile::fake()->create('kili.jpg', 64, 'image/jpeg'),
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $section->refresh();

        $this->assertStringStartsWith('uploads/menu/', $section->image);
        $this->assertFileExists(public_path($section->image));
        $this->assertStringContainsString($section->image, $section->image_url);

        // keep the test suite from leaving files behind
        File::delete(public_path($section->image));
    }

    public function test_non_image_upload_is_rejected(): void
    {
        $section = $this->section();

        $this->actingAs($this->admin())
            ->post(route('admin.mega-menu.section.update', $section), [
                'title' => 'Nope',
                'image' => UploadedFile::fake()->create('payload.php', 16, 'application/x-php'),
            ])
            ->assertSessionHasErrors('image');

        $this->assertNull($section->fresh()->image);
    }

    // --------------------------------------------------------- shortcut links

    public function test_admin_can_add_edit_and_delete_a_shortcut_link(): void
    {
        $section = $this->section();
        $admin = $this->admin();

        $this->actingAs($admin)->post(route('admin.mega-menu.links.store', $section), [
            'title'       => 'Machame Route',
            'description' => 'Scenic 7-day adventure',
            'icon'        => 'mountain',           // stored normalised as fa-mountain
            'url'         => '/kilimanjaro/routes',
            'badge'       => 'Popular',
            'badge_color' => 'danger',
            'is_active'   => 1,
        ])->assertRedirect();

        $link = MenuLink::where('title', 'Machame Route')->firstOrFail();
        $this->assertSame('fa-mountain', $link->icon);
        $this->assertSame(1, $link->display_order);

        $this->actingAs($admin)->put(route('admin.mega-menu.links.update', $link), [
            'title'       => 'Lemosho Route',
            'description' => 'Quieter 8-day route',
            'icon'        => 'fa-route',
            'url'         => '/kilimanjaro/routes',
            'badge_color' => 'secondary',
            'is_active'   => 1,
        ])->assertRedirect();

        $this->assertSame('Lemosho Route', $link->fresh()->title);

        $this->actingAs($admin)->delete(route('admin.mega-menu.links.destroy', $link))->assertRedirect();
        $this->assertDatabaseMissing('menu_links', ['id' => $link->id]);
    }

    public function test_link_can_be_hidden_without_being_deleted(): void
    {
        $section = $this->section();
        $link = $this->link($section, 'Machame', 1);

        $this->actingAs($this->admin())
            ->post(route('admin.mega-menu.links.toggle', $link))
            ->assertRedirect();

        $this->assertFalse($link->fresh()->is_active);
        $this->assertDatabaseHas('menu_links', ['id' => $link->id]);

        // and a hidden link must not reach the public menu
        $this->assertFalse(MenuSection::menu('kilimanjaro')->links->contains('id', $link->id));
    }

    public function test_links_can_be_reordered(): void
    {
        $section = $this->section();
        $a = $this->link($section, 'Alpha', 1);
        $b = $this->link($section, 'Bravo', 2);
        $c = $this->link($section, 'Charlie', 3);

        $this->actingAs($this->admin())
            ->post(route('admin.mega-menu.links.move', $c), ['direction' => 'up'])
            ->assertRedirect();

        $this->assertSame(['Alpha', 'Charlie', 'Bravo'], MenuLink::orderBy('display_order')->pluck('title')->all());

        $this->actingAs($this->admin())
            ->post(route('admin.mega-menu.links.move', $a), ['direction' => 'down'])
            ->assertRedirect();

        $this->assertSame(['Charlie', 'Alpha', 'Bravo'], MenuLink::orderBy('display_order')->pluck('title')->all());

        // moving the first item up is a no-op rather than an error
        $first = MenuLink::orderBy('display_order')->first();
        $this->actingAs($this->admin())
            ->post(route('admin.mega-menu.links.move', $first), ['direction' => 'up'])
            ->assertRedirect();
        $this->assertSame(['Charlie', 'Alpha', 'Bravo'], MenuLink::orderBy('display_order')->pluck('title')->all());

        unset($b);
    }

    // ------------------------------------------------------------------ cache

    public function test_saving_invalidates_the_cached_menu_so_edits_appear_immediately(): void
    {
        $section = $this->section();
        $this->link($section, 'Machame', 1);

        // prime the cache
        $this->assertSame('Climbing Kilimanjaro Guide', MenuSection::menu('kilimanjaro')->title);

        $this->actingAs($this->admin())->post(route('admin.mega-menu.section.update', $section), [
            'title'     => 'Totally New Title',
            'is_active' => 1,
        ])->assertRedirect();

        $this->assertSame('Totally New Title', MenuSection::menu('kilimanjaro')->title);
    }

    public function test_adding_a_link_invalidates_the_cached_menu(): void
    {
        $section = $this->section();
        $this->link($section, 'Machame', 1);

        $this->assertCount(1, MenuSection::menu('kilimanjaro')->links);

        $this->actingAs($this->admin())->post(route('admin.mega-menu.links.store', $section), [
            'title' => 'Lemosho', 'url' => '/kilimanjaro/routes', 'is_active' => 1,
        ])->assertRedirect();

        $this->assertCount(2, MenuSection::menu('kilimanjaro')->links);
    }

    // -------------------------------------------------------------- public API

    public function test_public_api_returns_only_active_content(): void
    {
        $section = $this->section();
        $visible = $this->link($section, 'Visible Link', 1);
        $hidden = $this->link($section, 'Hidden Link', 2);
        $hidden->update(['is_active' => false]);

        $response = $this->getJson('/api/navigation/mega-menu')->assertOk();

        $payload = $response->json();
        $this->assertArrayHasKey('categories', $payload);

        $kili = collect($payload['categories'])->firstWhere('navItem', 'kilimanjaro');
        $this->assertNotNull($kili);
        $this->assertSame('Climbing Kilimanjaro Guide', $kili['featureCard']['title']);
        $this->assertSame('52 Reasons', $kili['featureCard']['badgeText']);

        $labels = collect($kili['links'])->pluck('label')->all();
        $this->assertContains('Visible Link', $labels);
        $this->assertNotContains('Hidden Link', $labels);

        unset($visible);
    }

    public function test_public_api_hides_an_inactive_section_entirely(): void
    {
        $section = $this->section();
        $this->link($section, 'Machame', 1);
        $section->update(['is_active' => false]);

        $payload = $this->getJson('/api/navigation/mega-menu')->assertOk()->json();

        $this->assertNull(collect($payload['categories'])->firstWhere('navItem', 'kilimanjaro'));
    }
}
