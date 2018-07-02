<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
		\App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Work::observe(\App\Observers\WorkObserver::class);
        \App\Models\Bookmark::observe(\App\Observers\BookmarkObserver::class);
		\App\Models\BookmarkCategory::observe(\App\Observers\BookmarkCategoryObserver::class);
		\App\Models\Motto::observe(\App\Observers\MottoObserver::class);
		\App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
		\App\Models\Article::observe(\App\Observers\ArticleObserver::class);

        \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('app.debug')) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }
}
