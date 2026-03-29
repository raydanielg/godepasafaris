<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{id}/comment', [App\Http\Controllers\BlogController::class, 'comment'])->name('blog.comment');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/destinations', [App\Http\Controllers\DestinationController::class, 'index'])->name('destinations');
Route::get('/destinations/{slug}', [App\Http\Controllers\DestinationController::class, 'show'])->name('destinations.show');

Auth::routes();

Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
