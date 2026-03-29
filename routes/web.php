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

Route::post('/booking/store', [App\Http\Controllers\SafariController::class, 'storeBooking'])->name('booking.store');

Route::get('/kilimanjaro', [App\Http\Controllers\KilimanjaroController::class, 'index'])->name('kilimanjaro');
Route::get('/kilimanjaro/{slug}', [App\Http\Controllers\KilimanjaroController::class, 'show'])->name('kilimanjaro.show');
Route::get('/kilimanjaro/route/{slug}', [App\Http\Controllers\KilimanjaroController::class, 'routeShow'])->name('kilimanjaro.route.show');
Route::post('/kilimanjaro/{id}/enquire', [App\Http\Controllers\KilimanjaroController::class, 'enquire'])->name('kilimanjaro.enquire');

Route::get('/destinations', [App\Http\Controllers\DestinationController::class, 'index'])->name('destinations');
Route::get('/destinations/{slug}', [App\Http\Controllers\DestinationController::class, 'show'])->name('destinations.show');

Route::get('/safari', [App\Http\Controllers\SafariController::class, 'index'])->name('safari');
Route::get('/safari/{slug}', [App\Http\Controllers\SafariController::class, 'show'])->name('safari.show');
Route::post('/safari/{id}/enquire', [App\Http\Controllers\SafariController::class, 'enquire'])->name('safari.enquire');

Auth::routes();

Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
