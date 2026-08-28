<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| SEO 301 redirects
|--------------------------------------------------------------------------
| Old/removed safari URLs that still show up in Google Search Console as
| "Not found (404)". These send leftover links (and Google) to the closest
| live page instead of a dead end. Declared first so they win over the
| dynamic /blog/{slug} and /destinations/{slug} routes below.
|
| NOTE: the many old travel-template URLs (/hotel/*, /car/*, /boat/*,
| /flight, /event/*, /news/*, /location/*, /tour/*, /space) are deliberately
| NOT redirected — a 404 is the correct answer for content that never
| belonged to this site, and Google drops them automatically over time.
*/
Route::redirect('/ngorongoro-safari', '/all-tours', 301);
Route::redirect('/lake-manyara-safari', '/all-tours', 301);
// Old destination slug -> the specific live destination page (better than the index).
Route::redirect('/destinations/ngorongoro', '/destinations/ngorongoro-crater', 301);
Route::redirect('/blog/the-big-five-tanzanias-iconic-wildlife', '/blog', 301);
Route::redirect('/blog/the-great-migration-natures-greatest-show', '/blog', 301);
// Old "/pages/*" footer paths -> their current top-level routes.
Route::redirect('/pages/help-center', '/help-center', 301);

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

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
    Route::get('/safari-styles/lgbtq', function () { return view('pages.styles.lgbtq'); })->name('styles.lgbtq');

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
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
        // Bulk booking tools — declared before the {booking} wildcard so their
        // static paths aren't swallowed as a booking ID.
        Route::delete('/admin/bookings-delete-all', [App\Http\Controllers\Admin\DashboardController::class, 'deleteAllBookings'])->name('admin.bookings.delete-all');
        Route::post('/admin/bookings-restart', [App\Http\Controllers\Admin\DashboardController::class, 'restartBookingSystem'])->name('admin.bookings.restart');
        Route::post('/admin/bookings-test-email', [App\Http\Controllers\Admin\DashboardController::class, 'sendTestBookingEmail'])->name('admin.bookings.test-email');
        Route::get('/admin/bookings/{booking}', [App\Http\Controllers\Admin\DashboardController::class, 'viewBooking'])->name('admin.bookings.show');
        Route::patch('/admin/bookings/{booking}/status', [App\Http\Controllers\Admin\DashboardController::class, 'updateBookingStatus'])->name('admin.bookings.status');
        Route::get('/admin/bookings/{booking}/invoice', [App\Http\Controllers\Admin\DashboardController::class, 'generateInvoice'])->name('admin.bookings.invoice');
        Route::delete('/admin/bookings/{booking}', [App\Http\Controllers\Admin\DashboardController::class, 'deleteBooking'])->name('admin.bookings.delete');
        Route::post('/admin/bookings/{booking}/send-email', [App\Http\Controllers\Admin\DashboardController::class, 'sendBookingEmail'])->name('admin.bookings.send-email');
    
    // Safari Packages
    Route::get('/admin/safari-packages', [App\Http\Controllers\Admin\DashboardController::class, 'safariPackages'])->name('admin.safaris');
    Route::get('/admin/safari-packages/create', [App\Http\Controllers\Admin\DashboardController::class, 'createSafari'])->name('admin.safaris.create');
    Route::post('/admin/safari-packages', [App\Http\Controllers\Admin\DashboardController::class, 'storeSafari'])->name('admin.safaris.store');
    Route::get('/admin/safari-packages/{package}/edit', [App\Http\Controllers\Admin\DashboardController::class, 'editSafari'])->name('admin.safaris.edit');
    Route::put('/admin/safari-packages/{package}', [App\Http\Controllers\Admin\DashboardController::class, 'updateSafari'])->name('admin.safaris.update');
    Route::delete('/admin/safari-packages/{package}', [App\Http\Controllers\Admin\DashboardController::class, 'deleteSafari'])->name('admin.safaris.delete');
    Route::post('/admin/safari-packages/{package}/duplicate', [App\Http\Controllers\Admin\DashboardController::class, 'duplicateSafari'])->name('admin.safaris.duplicate');
    
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

    // Page Backgrounds
    Route::get('/admin/backgrounds', [App\Http\Controllers\Admin\BackgroundController::class, 'index'])->name('admin.backgrounds');
    Route::post('/admin/backgrounds', [App\Http\Controllers\Admin\BackgroundController::class, 'update'])->name('admin.backgrounds.update');

    // Customer Testimonials — real, consent-given reviews entered by staff
    Route::get('/admin/testimonials', [App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('admin.testimonials');
    Route::post('/admin/testimonials', [App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('admin.testimonials.store');
    Route::put('/admin/testimonials/{testimonial}', [App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('admin.testimonials.update');
    Route::delete('/admin/testimonials/{testimonial}', [App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
    Route::post('/admin/testimonials/{testimonial}/toggle', [App\Http\Controllers\Admin\TestimonialController::class, 'toggle'])->name('admin.testimonials.toggle');

    // Navigation — Mega Menu Manager (feature card + shortcut links per nav item)
    Route::get('/admin/mega-menu', [App\Http\Controllers\Admin\MegaMenuController::class, 'index'])->name('admin.mega-menu');
    Route::post('/admin/mega-menu/{section}', [App\Http\Controllers\Admin\MegaMenuController::class, 'updateSection'])->name('admin.mega-menu.section.update');
    Route::post('/admin/mega-menu/{section}/links', [App\Http\Controllers\Admin\MegaMenuController::class, 'storeLink'])->name('admin.mega-menu.links.store');
    Route::put('/admin/mega-menu/links/{link}', [App\Http\Controllers\Admin\MegaMenuController::class, 'updateLink'])->name('admin.mega-menu.links.update');
    Route::delete('/admin/mega-menu/links/{link}', [App\Http\Controllers\Admin\MegaMenuController::class, 'destroyLink'])->name('admin.mega-menu.links.destroy');
    Route::post('/admin/mega-menu/links/{link}/toggle', [App\Http\Controllers\Admin\MegaMenuController::class, 'toggleLink'])->name('admin.mega-menu.links.toggle');
    Route::post('/admin/mega-menu/links/{link}/move', [App\Http\Controllers\Admin\MegaMenuController::class, 'moveLink'])->name('admin.mega-menu.links.move');

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

    // Zanzibar Content Management
    Route::get('/admin/zanzibar', [App\Http\Controllers\Admin\ZanzibarController::class, 'index'])->name('admin.zanzibar.index');
    Route::get('/admin/zanzibar/create', [App\Http\Controllers\Admin\ZanzibarController::class, 'create'])->name('admin.zanzibar.create');
    Route::post('/admin/zanzibar', [App\Http\Controllers\Admin\ZanzibarController::class, 'store'])->name('admin.zanzibar.store');
    Route::get('/admin/zanzibar/{zanzibar}/edit', [App\Http\Controllers\Admin\ZanzibarController::class, 'edit'])->name('admin.zanzibar.edit');
    Route::put('/admin/zanzibar/{zanzibar}', [App\Http\Controllers\Admin\ZanzibarController::class, 'update'])->name('admin.zanzibar.update');
    Route::delete('/admin/zanzibar/{zanzibar}', [App\Http\Controllers\Admin\ZanzibarController::class, 'destroy'])->name('admin.zanzibar.destroy');

    // Cultural Safari Management
    Route::get('/admin/cultural', [App\Http\Controllers\Admin\CulturalController::class, 'index'])->name('admin.cultural.index');
    Route::get('/admin/cultural/create', [App\Http\Controllers\Admin\CulturalController::class, 'create'])->name('admin.cultural.create');
    Route::post('/admin/cultural', [App\Http\Controllers\Admin\CulturalController::class, 'store'])->name('admin.cultural.store');
    Route::get('/admin/cultural/{cultural}/edit', [App\Http\Controllers\Admin\CulturalController::class, 'edit'])->name('admin.cultural.edit');
    Route::put('/admin/cultural/{cultural}', [App\Http\Controllers\Admin\CulturalController::class, 'update'])->name('admin.cultural.update');
    Route::delete('/admin/cultural/{cultural}', [App\Http\Controllers\Admin\CulturalController::class, 'destroy'])->name('admin.cultural.destroy');
    Route::post('/admin/cultural/{cultural}/reviews', [App\Http\Controllers\Admin\CulturalController::class, 'storeReview'])->name('admin.cultural.reviews.store');
    Route::delete('/admin/cultural-reviews/{review}', [App\Http\Controllers\Admin\CulturalController::class, 'destroyReview'])->name('admin.cultural.reviews.destroy');
    Route::post('/admin/cultural/{cultural}/activities', [App\Http\Controllers\Admin\CulturalController::class, 'storeActivity'])->name('admin.cultural.activities.store');
    Route::post('/admin/cultural-activities/{activity}', [App\Http\Controllers\Admin\CulturalController::class, 'updateActivity'])->name('admin.cultural.activities.update');
    Route::delete('/admin/cultural-activities/{activity}', [App\Http\Controllers\Admin\CulturalController::class, 'destroyActivity'])->name('admin.cultural.activities.destroy');
});

Route::post('/booking/store', [App\Http\Controllers\SafariController::class, 'storeBooking'])->middleware(['throttle:8,1', 'block.suspicious'])->name('booking.store');

Route::get('/kilimanjaro', [App\Http\Controllers\KilimanjaroController::class, 'index'])->name('kilimanjaro');
Route::get('/kilimanjaro/why-us', function () { return view('pages.kilimanjaro.why-us'); })->name('kilimanjaro.why-us');
Route::get('/kilimanjaro/private-tours', function () { return view('pages.kilimanjaro.pricing'); })->name('kilimanjaro.private-tours');
Route::get('/kilimanjaro/group-departures', function () { return view('pages.kilimanjaro.group'); })->name('kilimanjaro.group-departures');
Route::get('/kilimanjaro/routes', function () { return view('pages.kilimanjaro.routes'); })->name('kilimanjaro.routes');
Route::get('/kilimanjaro/packing-list', function () { return view('pages.kilimanjaro.packing-list'); })->name('kilimanjaro.packing-list');
Route::get('/kilimanjaro/success-calculator', function () { return view('pages.kilimanjaro.calculator'); })->name('kilimanjaro.success-calculator');
Route::get('/kilimanjaro/articles', function () { return view('pages.kilimanjaro.articles'); })->name('kilimanjaro.articles');
Route::get('/kilimanjaro/other-mountains', function () { return view('pages.kilimanjaro.other-mountains'); })->name('kilimanjaro.other-mountains');
Route::get('/kilimanjaro/{slug}', [App\Http\Controllers\KilimanjaroController::class, 'show'])->name('kilimanjaro.show');
Route::get('/kilimanjaro/route/{slug}', [App\Http\Controllers\KilimanjaroController::class, 'routeShow'])->name('kilimanjaro.route.show');
Route::post('/kilimanjaro/{id}/enquire', [App\Http\Controllers\KilimanjaroController::class, 'enquire'])->middleware(['throttle:8,1', 'block.suspicious'])->name('kilimanjaro.enquire');

Route::get('/destinations', [App\Http\Controllers\SafariDestinationController::class, 'index'])->name('destinations');
Route::get('/destinations/{slug}', [App\Http\Controllers\SafariDestinationController::class, 'show'])->name('destinations.show');

// Safari circuits (Northern / Southern / Eastern) with maps
Route::get('/safari-circuits', [App\Http\Controllers\CircuitController::class, 'index'])->name('circuits.index');
Route::get('/safari-circuits/{slug}', [App\Http\Controllers\CircuitController::class, 'show'])->name('circuits.show');

// Zanzibar destination landing page
Route::get('/zanzibar', [App\Http\Controllers\ZanzibarController::class, 'index'])->name('zanzibar');

// Cultural Safari (public)
Route::get('/cultural-safari', [App\Http\Controllers\CulturalController::class, 'index'])->name('cultural.index');
Route::get('/cultural-safari/{cultural}', [App\Http\Controllers\CulturalController::class, 'show'])->name('cultural.show');

Route::get('/safari', [App\Http\Controllers\SafariController::class, 'index'])->name('safari');
Route::get('/safari/{slug}', [App\Http\Controllers\SafariController::class, 'show'])->name('safari.show');
Route::post('/safari/{id}/enquire', [App\Http\Controllers\SafariController::class, 'enquire'])->middleware(['throttle:8,1', 'block.suspicious'])->name('safari.enquire');

Auth::routes(['register' => false]);

Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Laravel's stock post-login landing page ("You are logged in!"). It is only
// ever reached by an authenticated user (the auth controllers redirect here),
// but the auth middleware had been commented out, leaving a thin scaffold page
// publicly crawlable — exactly the kind of near-empty page that drags down
// site quality signals. Gate it so it can never be indexed.
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');
