<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\Announcement;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Global helpers (tr() for translating dynamic DB content).
        require_once app_path('helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Blade directives for translating DB strings in statement position.
        //   @t($model->title)   -> escaped   |   @traw($model->body) -> raw HTML
        Blade::directive('t', fn ($expr) => "<?php echo e(tr($expr)); ?>");
        Blade::directive('traw', fn ($expr) => "<?php echo tr($expr); ?>");

        View::composer('*', function ($view) {
            $announcement = Announcement::where('is_active', true)->latest()->first();
            $view->with('globalAnnouncement', $announcement);
        });
    }
}
