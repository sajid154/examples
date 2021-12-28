<?php

namespace App\Providers;

use App\Post;
use App\RecordAudio;
use App\Observers\PostObserver;
use App\Observers\CaptureScreenshotObserver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
               // Post::observe(PostObserver::class);
        RecordAudio::observe(CaptureScreenshotObserver::class);
    }
}
