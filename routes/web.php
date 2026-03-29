<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

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
        
        // Bookings
    Route::get('/admin/bookings', [App\Http\Controllers\Admin\DashboardController::class, 'bookings'])->name('admin.bookings');
    
    // Safari Packages
    Route::get('/admin/safari-packages', [App\Http\Controllers\Admin\DashboardController::class, 'safariPackages'])->name('admin.safaris');
    
    // Kilimanjaro Packages
    Route::get('/admin/kili-packages', [App\Http\Controllers\Admin\DashboardController::class, 'kiliPackages'])->name('admin.kilimanjaro');
    
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
    Route::post('/admin/settings/update', [App\Http\Controllers\Admin\DashboardController::class, 'updateSettings'])->name('admin.settings.update');
});

Route::post('/booking/store', [App\Http\Controllers\SafariController::class, 'storeBooking'])->name('booking.store');

Route::get('/kilimanjaro', [App\Http\Controllers\KilimanjaroController::class, 'index'])->name('kilimanjaro');
Route::get('/kilimanjaro/{slug}', [App\Http\Controllers\KilimanjaroController::class, 'show'])->name('kilimanjaro.show');
Route::get('/kilimanjaro/route/{slug}', [App\Http\Controllers\KilimanjaroController::class, 'routeShow'])->name('kilimanjaro.route.show');
Route::post('/kilimanjaro/{id}/enquire', [App\Http\Controllers\KilimanjaroController::class, 'enquire'])->name('kilimanjaro.enquire');

Route::get('/destinations', [App\Http\Controllers\SafariController::class, 'destinations'])->name('destinations');
Route::get('/destinations/{slug}', [App\Http\Controllers\SafariController::class, 'destinationShow'])->name('destinations.show');

Route::get('/safari', [App\Http\Controllers\SafariController::class, 'index'])->name('safari');
Route::get('/safari/{slug}', [App\Http\Controllers\SafariController::class, 'show'])->name('safari.show');
Route::post('/safari/{id}/enquire', [App\Http\Controllers\SafariController::class, 'enquire'])->name('safari.enquire');

Auth::routes();

Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
