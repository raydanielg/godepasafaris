<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

Route::post('/clear-cache', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return response()->json(['status' => 'success', 'message' => 'Cache cleared']);
})->name('cache.clear.ajax');

// One-time: Seed Zanzibar destination on production — DELETE THIS ROUTE AFTER USE
Route::get('/setup-zanzibar-destination', function () {
    try {
        $exists = \Illuminate\Support\Facades\DB::table('safari_destinations')->where('slug', 'zanzibar')->exists();

        if (!$exists) {
            $id = \Illuminate\Support\Facades\DB::table('safari_destinations')->insertGetId([
                'name'              => 'Zanzibar Island',
                'slug'              => 'zanzibar',
                'tagline'           => 'Spice Island paradise — turquoise waters, coral reefs, and ancient Stone Town',
                'description'       => 'Zanzibar is a semi-autonomous archipelago off the coast of Tanzania, renowned for its stunning white-sand beaches, crystal-clear turquoise waters, vibrant coral reefs, and the UNESCO World Heritage Site of Stone Town. The island blends African, Arab, Indian, and European influences into a unique cultural tapestry. Beyond the beaches, Zanzibar offers spice tours, dolphin watching, snorkelling, kite-surfing, and exploring the historic alleys of Stone Town. It is the perfect complement to a Tanzania safari.',
                'short_description' => "White beaches, spice tours, and the historic Stone Town — Zanzibar is Tanzania's island paradise.",
                'location'          => 'Indian Ocean, Tanzania Coast',
                'best_time'         => 'June – October & December – February',
                'icon'              => 'fa-umbrella-beach',
                'badge'             => 'Beach & Culture',
                'badge_color'       => 'info',
                'is_featured'       => 0,
                'is_active'         => 1,
                'display_order'     => 16,
                'highlight_1'       => 'UNESCO World Heritage Stone Town',
                'highlight_2'       => 'Pristine Coral Reefs & Marine Parks',
                'highlight_3'       => 'Spice Plantation Tours',
                'area'              => '2,462 km²',
                'established'       => 'Ancient — 10th Century',
                'wildlife_count'    => '200+ Marine Species',
                'gallery'           => '[]',
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            $activities = [
                ['name' => 'Beach Relaxation',     'icon' => 'fa-umbrella-beach', 'description' => 'Relax on world-class white sand beaches like Nungwi and Kendwa',  'display_order' => 1],
                ['name' => 'Snorkelling & Diving', 'icon' => 'fa-water',          'description' => 'Explore vibrant coral reefs and marine parks',                    'display_order' => 2],
                ['name' => 'Stone Town Tour',       'icon' => 'fa-mosque',         'description' => 'Walk the historic UNESCO World Heritage Site alleys',             'display_order' => 3],
                ['name' => 'Spice Plantation Tour', 'icon' => 'fa-seedling',       'description' => 'Discover cloves, vanilla, cinnamon, and cardamom',               'display_order' => 4],
                ['name' => 'Dolphin Watching',      'icon' => 'fa-fish',           'description' => 'Swim with wild dolphins in Kizimkazi Bay',                       'display_order' => 5],
                ['name' => 'Kite Surfing',          'icon' => 'fa-wind',           'description' => 'World-class kite surfing at Paje Beach',                         'display_order' => 6],
                ['name' => 'Deep Sea Fishing',      'icon' => 'fa-anchor',         'description' => 'Game fishing in the Indian Ocean',                               'display_order' => 7],
                ['name' => 'Sunset Dhow Cruise',    'icon' => 'fa-ship',           'description' => 'Traditional wooden dhow sunset cruise with dinner',              'display_order' => 8],
            ];

            foreach ($activities as $activity) {
                \Illuminate\Support\Facades\DB::table('safari_activities')->insert(array_merge($activity, [
                    'safari_destination_id' => $id,
                    'created_at'            => now(),
                    'updated_at'            => now(),
                ]));
            }

            $message = '✅ SUCCESS: Zanzibar destination created with ' . count($activities) . ' activities.';
        } else {
            $message = 'ℹ️ Zanzibar already exists in the database (id=' .
                \Illuminate\Support\Facades\DB::table('safari_destinations')->where('slug','zanzibar')->value('id') . ').';
        }

        // Fix menu link regardless
        \Illuminate\Support\Facades\DB::table('menu_links')
            ->where('title', 'Zanzibar Island')
            ->orWhere('title', 'Zanzibar Beach & Safari')
            ->update(['url' => '/destinations/zanzibar', 'title' => 'Zanzibar Island', 'updated_at' => now()]);

        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return $message . '<br><br>Menu link fixed. Caches cleared.<br><br>'
            . '👉 <a href="/destinations/zanzibar">Open Zanzibar Page</a><br>'
            . '⚠️ <strong>DELETE the /setup-zanzibar-destination route from routes/web.php after confirming it works!</strong>';
    } catch (\Exception $e) {
        return '❌ ERROR: ' . $e->getMessage();
    }
});

// Emergency cache clear via browser
Route::get('/clear-all-cache', function () {
    try {
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        return 'All caches cleared! <a href="/">Go Home</a>';
    } catch (Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/impact', [App\Http\Controllers\WelcomeController::class, 'impact'])->name('impact');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/all-tours', [App\Http\Controllers\TourController::class, 'index'])->name('tours.all');

Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{id}/comment', [App\Http\Controllers\BlogController::class, 'comment'])->name('blog.comment');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Footer Pages
Route::get('/help-center', function () { return view('pages.help-center'); })->name('help.center');
Route::get('/faq', function () { return view('pages.faq'); })->name('faq');
Route::get('/privacy-policy', function () { return view('pages.privacy'); })->name('privacy');
Route::get('/terms-of-service', function () { return view('pages.terms'); })->name('terms');
Route::get('/how-it-works', function () { return view('pages.how-it-works'); })->name('how.works');
Route::get('/testimonials', [App\Http\Controllers\WelcomeController::class, 'testimonials'])->name('testimonials');

// Packing List Routes
Route::get('/packing-list', [App\Http\Controllers\PackingListController::class, 'index'])->name('packing-list.index');
Route::get('/packing-list/category/{category}', [App\Http\Controllers\PackingListController::class, 'category'])->name('packing-list.category');
Route::get('/packing-list/{slug}', [App\Http\Controllers\PackingListController::class, 'show'])->name('packing-list.show');

    // Safari Styles
    Route::get('/safari-styles/private', function () { return view('pages.styles.private'); })->name('styles.private');
    Route::get('/safari-styles/budget', function () { return view('pages.styles.budget'); })->name('styles.budget');
    Route::get('/safari-styles/photographic', function () { return view('pages.styles.photographic'); })->name('styles.photographic');
    Route::get('/safari-styles/cultural', function () { return view('pages.styles.cultural'); })->name('styles.cultural');
    Route::get('/safari-styles/walking', function () { return view('pages.styles.walking'); })->name('styles.walking');
    Route::get('/safari-styles/luxury', function () { return view('pages.styles.luxury'); })->name('styles.luxury');

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        // Profile
        Route::get('/admin/profile', [App\Http\Controllers\Admin\DashboardController::class, 'profile'])->name('admin.profile');
        Route::post('/admin/profile/delete', [App\Http\Controllers\Admin\DashboardController::class, 'deleteAccount'])->name('admin.profile.delete');
        
        // Destinations
        Route::get('/admin/destinations', [App\Http\Controllers\Admin\DashboardController::class, 'destinations'])->name('admin.destinations');
        Route::get('/admin/destinations/create', [App\Http\Controllers\Admin\DashboardController::class, 'createDestination'])->name('admin.destinations.create');
        Route::post('/admin/destinations', [App\Http\Controllers\Admin\DashboardController::class, 'storeDestination'])->name('admin.destinations.store');
        Route::get('/admin/destinations/{destination}/edit', [App\Http\Controllers\Admin\DashboardController::class, 'editDestination'])->name('admin.destinations.edit');
        Route::put('/admin/destinations/{destination}', [App\Http\Controllers\Admin\DashboardController::class, 'updateDestination'])->name('admin.destinations.update');
        Route::delete('/admin/destinations/{destination}', [App\Http\Controllers\Admin\DashboardController::class, 'deleteDestination'])->name('admin.destinations.delete');
        
        // Bookings/Inquiries
        Route::get('/admin/bookings', [App\Http\Controllers\Admin\DashboardController::class, 'bookings'])->name('admin.bookings');
        Route::get('/admin/bookings/{booking}', [App\Http\Controllers\Admin\DashboardController::class, 'viewBooking'])->name('admin.bookings.show');
        Route::patch('/admin/bookings/{booking}/status', [App\Http\Controllers\Admin\DashboardController::class, 'updateBookingStatus'])->name('admin.bookings.status');
        Route::get('/admin/bookings/{booking}/invoice', [App\Http\Controllers\Admin\DashboardController::class, 'generateInvoice'])->name('admin.bookings.invoice');
        Route::delete('/admin/bookings/{booking}', [App\Http\Controllers\Admin\DashboardController::class, 'deleteBooking'])->name('admin.bookings.delete');
    
    // Safari Packages
    Route::get('/admin/safari-packages', [App\Http\Controllers\Admin\DashboardController::class, 'safariPackages'])->name('admin.safaris');
    Route::get('/admin/safari-packages/create', [App\Http\Controllers\Admin\DashboardController::class, 'createSafari'])->name('admin.safaris.create');
    Route::post('/admin/safari-packages', [App\Http\Controllers\Admin\DashboardController::class, 'storeSafari'])->name('admin.safaris.store');
    Route::get('/admin/safari-packages/{package}/edit', [App\Http\Controllers\Admin\DashboardController::class, 'editSafari'])->name('admin.safaris.edit');
    Route::put('/admin/safari-packages/{package}', [App\Http\Controllers\Admin\DashboardController::class, 'updateSafari'])->name('admin.safaris.update');
    Route::delete('/admin/safari-packages/{package}', [App\Http\Controllers\Admin\DashboardController::class, 'deleteSafari'])->name('admin.safaris.delete');
    
    // Kilimanjaro Packages
    Route::get('/admin/kili-packages', [App\Http\Controllers\Admin\DashboardController::class, 'kiliPackages'])->name('admin.kilimanjaro');
    Route::get('/admin/kili-packages/create', [App\Http\Controllers\Admin\DashboardController::class, 'createKili'])->name('admin.kilimanjaro.create');
    Route::post('/admin/kili-packages', [App\Http\Controllers\Admin\DashboardController::class, 'storeKili'])->name('admin.kilimanjaro.store');
    Route::get('/admin/kili-packages/{package}/edit', [App\Http\Controllers\Admin\DashboardController::class, 'editKili'])->name('admin.kilimanjaro.edit');
    Route::put('/admin/kili-packages/{package}', [App\Http\Controllers\Admin\DashboardController::class, 'updateKili'])->name('admin.kilimanjaro.update');
    Route::delete('/admin/kili-packages/{package}', [App\Http\Controllers\Admin\DashboardController::class, 'deleteKili'])->name('admin.kilimanjaro.delete');

    // Blog Posts
    Route::get('/admin/posts', [App\Http\Controllers\Admin\DashboardController::class, 'posts'])->name('admin.posts');
    Route::get('/admin/posts/create', [App\Http\Controllers\Admin\DashboardController::class, 'createPost'])->name('admin.posts.create');
    Route::post('/admin/posts', [App\Http\Controllers\Admin\DashboardController::class, 'storePost'])->name('admin.posts.store');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\Admin\DashboardController::class, 'editPost'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [App\Http\Controllers\Admin\DashboardController::class, 'updatePost'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [App\Http\Controllers\Admin\DashboardController::class, 'deletePost'])->name('admin.posts.delete');
    Route::post('/admin/posts/upload-image', [App\Http\Controllers\Admin\DashboardController::class, 'uploadEditorImage'])->name('admin.posts.image.upload');
    
    // User Management
    Route::get('/admin/users', [App\Http\Controllers\Admin\DashboardController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{user}/role', [App\Http\Controllers\Admin\DashboardController::class, 'updateRole'])->name('admin.users.role');
    Route::delete('/admin/users/{user}', [App\Http\Controllers\Admin\DashboardController::class, 'deleteUser'])->name('admin.users.delete');

    // Announcements
    Route::get('/admin/announcements', [App\Http\Controllers\Admin\DashboardController::class, 'announcements'])->name('admin.announcements');
    Route::post('/admin/announcements', [App\Http\Controllers\Admin\DashboardController::class, 'storeAnnouncement'])->name('admin.announcements.store');
    Route::delete('/admin/announcements/{announcement}', [App\Http\Controllers\Admin\DashboardController::class, 'deleteAnnouncement'])->name('admin.announcements.delete');
    Route::post('/admin/announcements/{announcement}/status', [App\Http\Controllers\Admin\DashboardController::class, 'updateAnnouncementStatus'])->name('admin.announcements.status');

    // Settings
    Route::get('/admin/settings', [App\Http\Controllers\Admin\DashboardController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [App\Http\Controllers\Admin\DashboardController::class, 'updateSettings'])->name('admin.settings.update');
    Route::post('/admin/settings/clear-cache', [App\Http\Controllers\Admin\DashboardController::class, 'clearCache'])->name('admin.settings.clear-cache');

    // Impact / Giving Back Management
    Route::get('/admin/impact', [App\Http\Controllers\Admin\ImpactController::class, 'index'])->name('admin.impact.index');

    // Stats
    Route::get('/admin/impact/stats', [App\Http\Controllers\Admin\ImpactController::class, 'stats'])->name('admin.impact.stats');
    Route::get('/admin/impact/stats/create', [App\Http\Controllers\Admin\ImpactController::class, 'createStat'])->name('admin.impact.stats.create');
    Route::post('/admin/impact/stats', [App\Http\Controllers\Admin\ImpactController::class, 'storeStat'])->name('admin.impact.stats.store');
    Route::get('/admin/impact/stats/{stat}/edit', [App\Http\Controllers\Admin\ImpactController::class, 'editStat'])->name('admin.impact.stats.edit');
    Route::put('/admin/impact/stats/{stat}', [App\Http\Controllers\Admin\ImpactController::class, 'updateStat'])->name('admin.impact.stats.update');
    Route::delete('/admin/impact/stats/{stat}', [App\Http\Controllers\Admin\ImpactController::class, 'deleteStat'])->name('admin.impact.stats.delete');
    Route::patch('/admin/impact/stats/{stat}/toggle', [App\Http\Controllers\Admin\ImpactController::class, 'toggleStatStatus'])->name('admin.impact.stats.toggle');

    // Stories
    Route::get('/admin/impact/stories', [App\Http\Controllers\Admin\ImpactController::class, 'stories'])->name('admin.impact.stories');
    Route::get('/admin/impact/stories/create', [App\Http\Controllers\Admin\ImpactController::class, 'createStory'])->name('admin.impact.stories.create');
    Route::post('/admin/impact/stories', [App\Http\Controllers\Admin\ImpactController::class, 'storeStory'])->name('admin.impact.stories.store');
    Route::get('/admin/impact/stories/{story}/edit', [App\Http\Controllers\Admin\ImpactController::class, 'editStory'])->name('admin.impact.stories.edit');
    Route::put('/admin/impact/stories/{story}', [App\Http\Controllers\Admin\ImpactController::class, 'updateStory'])->name('admin.impact.stories.update');
    Route::delete('/admin/impact/stories/{story}', [App\Http\Controllers\Admin\ImpactController::class, 'deleteStory'])->name('admin.impact.stories.delete');
    Route::patch('/admin/impact/stories/{story}/toggle', [App\Http\Controllers\Admin\ImpactController::class, 'toggleStoryStatus'])->name('admin.impact.stories.toggle');
    Route::patch('/admin/impact/stories/{story}/featured', [App\Http\Controllers\Admin\ImpactController::class, 'toggleStoryFeatured'])->name('admin.impact.stories.featured');

    // Gallery
    Route::get('/admin/impact/gallery', [App\Http\Controllers\Admin\ImpactController::class, 'gallery'])->name('admin.impact.gallery');
    Route::get('/admin/impact/gallery/create', [App\Http\Controllers\Admin\ImpactController::class, 'createGallery'])->name('admin.impact.gallery.create');
    Route::post('/admin/impact/gallery', [App\Http\Controllers\Admin\ImpactController::class, 'storeGallery'])->name('admin.impact.gallery.store');
    Route::get('/admin/impact/gallery/{gallery}/edit', [App\Http\Controllers\Admin\ImpactController::class, 'editGallery'])->name('admin.impact.gallery.edit');
    Route::put('/admin/impact/gallery/{gallery}', [App\Http\Controllers\Admin\ImpactController::class, 'updateGallery'])->name('admin.impact.gallery.update');
    Route::delete('/admin/impact/gallery/{gallery}', [App\Http\Controllers\Admin\ImpactController::class, 'deleteGallery'])->name('admin.impact.gallery.delete');
    Route::patch('/admin/impact/gallery/{gallery}/toggle', [App\Http\Controllers\Admin\ImpactController::class, 'toggleGalleryStatus'])->name('admin.impact.gallery.toggle');

    // Timeline
    Route::get('/admin/impact/timeline', [App\Http\Controllers\Admin\ImpactController::class, 'timeline'])->name('admin.impact.timeline');
    Route::get('/admin/impact/timeline/create', [App\Http\Controllers\Admin\ImpactController::class, 'createTimeline'])->name('admin.impact.timeline.create');
    Route::post('/admin/impact/timeline', [App\Http\Controllers\Admin\ImpactController::class, 'storeTimeline'])->name('admin.impact.timeline.store');
    Route::get('/admin/impact/timeline/{timeline}/edit', [App\Http\Controllers\Admin\ImpactController::class, 'editTimeline'])->name('admin.impact.timeline.edit');
    Route::put('/admin/impact/timeline/{timeline}', [App\Http\Controllers\Admin\ImpactController::class, 'updateTimeline'])->name('admin.impact.timeline.update');
    Route::delete('/admin/impact/timeline/{timeline}', [App\Http\Controllers\Admin\ImpactController::class, 'deleteTimeline'])->name('admin.impact.timeline.delete');
    Route::patch('/admin/impact/timeline/{timeline}/toggle', [App\Http\Controllers\Admin\ImpactController::class, 'toggleTimelineStatus'])->name('admin.impact.timeline.toggle');

    // Partners
    Route::get('/admin/impact/partners', [App\Http\Controllers\Admin\ImpactController::class, 'partners'])->name('admin.impact.partners');
    Route::get('/admin/impact/partners/create', [App\Http\Controllers\Admin\ImpactController::class, 'createPartner'])->name('admin.impact.partners.create');
    Route::post('/admin/impact/partners', [App\Http\Controllers\Admin\ImpactController::class, 'storePartner'])->name('admin.impact.partners.store');
    Route::get('/admin/impact/partners/{partner}/edit', [App\Http\Controllers\Admin\ImpactController::class, 'editPartner'])->name('admin.impact.partners.edit');
    Route::put('/admin/impact/partners/{partner}', [App\Http\Controllers\Admin\ImpactController::class, 'updatePartner'])->name('admin.impact.partners.update');
    Route::delete('/admin/impact/partners/{partner}', [App\Http\Controllers\Admin\ImpactController::class, 'deletePartner'])->name('admin.impact.partners.delete');
    Route::patch('/admin/impact/partners/{partner}/toggle', [App\Http\Controllers\Admin\ImpactController::class, 'togglePartnerStatus'])->name('admin.impact.partners.toggle');

    // Packing List Management
    Route::get('/admin/packing-lists', [App\Http\Controllers\Admin\PackingListController::class, 'index'])->name('admin.packing-lists.index');
    Route::get('/admin/packing-lists/create', [App\Http\Controllers\Admin\PackingListController::class, 'create'])->name('admin.packing-lists.create');
    Route::post('/admin/packing-lists', [App\Http\Controllers\Admin\PackingListController::class, 'store'])->name('admin.packing-lists.store');
    Route::get('/admin/packing-lists/{packingList}/edit', [App\Http\Controllers\Admin\PackingListController::class, 'edit'])->name('admin.packing-lists.edit');
    Route::put('/admin/packing-lists/{packingList}', [App\Http\Controllers\Admin\PackingListController::class, 'update'])->name('admin.packing-lists.update');
    Route::delete('/admin/packing-lists/{packingList}', [App\Http\Controllers\Admin\PackingListController::class, 'destroy'])->name('admin.packing-lists.destroy');
    
    // Packing List Items
    Route::post('/admin/packing-lists/{packingList}/items', [App\Http\Controllers\Admin\PackingListController::class, 'storeItem'])->name('admin.packing-lists.items.store');
    Route::put('/admin/packing-list-items/{item}', [App\Http\Controllers\Admin\PackingListController::class, 'updateItem'])->name('admin.packing-lists.items.update');
    Route::delete('/admin/packing-list-items/{item}', [App\Http\Controllers\Admin\PackingListController::class, 'destroyItem'])->name('admin.packing-lists.items.destroy');

    // Safari Destinations Management
    Route::get('/admin/safari-destinations', [App\Http\Controllers\Admin\SafariDestinationController::class, 'index'])->name('admin.safari-destinations.index');
    Route::get('/admin/safari-destinations/create', [App\Http\Controllers\Admin\SafariDestinationController::class, 'create'])->name('admin.safari-destinations.create');
    Route::post('/admin/safari-destinations', [App\Http\Controllers\Admin\SafariDestinationController::class, 'store'])->name('admin.safari-destinations.store');
    Route::get('/admin/safari-destinations/{safariDestination}/edit', [App\Http\Controllers\Admin\SafariDestinationController::class, 'edit'])->name('admin.safari-destinations.edit');
    Route::put('/admin/safari-destinations/{safariDestination}', [App\Http\Controllers\Admin\SafariDestinationController::class, 'update'])->name('admin.safari-destinations.update');
    Route::delete('/admin/safari-destinations/{safariDestination}', [App\Http\Controllers\Admin\SafariDestinationController::class, 'destroy'])->name('admin.safari-destinations.destroy');
    
    // Safari Activities
    Route::post('/admin/safari-destinations/{safariDestination}/activities', [App\Http\Controllers\Admin\SafariDestinationController::class, 'storeActivity'])->name('admin.safari-destinations.activities.store');
    Route::delete('/admin/safari-activities/{activity}', [App\Http\Controllers\Admin\SafariDestinationController::class, 'destroyActivity'])->name('admin.safari-activities.destroy');
});

Route::post('/booking/store', [App\Http\Controllers\SafariController::class, 'storeBooking'])->name('booking.store');

Route::get('/kilimanjaro', [App\Http\Controllers\KilimanjaroController::class, 'index'])->name('kilimanjaro');
Route::get('/kilimanjaro/why-us', function () { return view('pages.kilimanjaro.why-us'); })->name('kilimanjaro.why-us');
Route::get('/kilimanjaro/pricing', function () { return view('pages.kilimanjaro.pricing'); })->name('kilimanjaro.pricing');
Route::get('/kilimanjaro/group', function () { return view('pages.kilimanjaro.group'); })->name('kilimanjaro.group');
Route::get('/kilimanjaro/calculator', function () { return view('pages.kilimanjaro.calculator'); })->name('kilimanjaro.calculator');
Route::get('/kilimanjaro/other-mountains', function () { return view('pages.kilimanjaro.other-mountains'); })->name('kilimanjaro.other-mountains');
Route::get('/kilimanjaro/{slug}', [App\Http\Controllers\KilimanjaroController::class, 'show'])->name('kilimanjaro.show');
Route::get('/kilimanjaro/route/{slug}', [App\Http\Controllers\KilimanjaroController::class, 'routeShow'])->name('kilimanjaro.route.show');
Route::post('/kilimanjaro/{id}/enquire', [App\Http\Controllers\KilimanjaroController::class, 'enquire'])->name('kilimanjaro.enquire');

Route::get('/destinations', [App\Http\Controllers\SafariDestinationController::class, 'index'])->name('destinations');
Route::get('/destinations/{slug}', [App\Http\Controllers\SafariDestinationController::class, 'show'])->name('destinations.show');

Route::get('/safari', [App\Http\Controllers\SafariController::class, 'index'])->name('safari');
Route::get('/safari/{slug}', [App\Http\Controllers\SafariController::class, 'show'])->name('safari.show');
Route::post('/safari/{id}/enquire', [App\Http\Controllers\SafariController::class, 'enquire'])->name('safari.enquire');

Auth::routes(['register' => false]);

Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
