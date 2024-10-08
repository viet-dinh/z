<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::setLocale('vi'); // Switch to Vietnamese
        Relation::enforceMorphMap([
            'comment' => Comment::class,
            'reply' => Reply::class,
        ]);
    }
}
