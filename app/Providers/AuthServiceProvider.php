<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Motto::class => \App\Policies\MottoPolicy::class,
		 \App\Models\Reply::class => \App\Policies\ReplyPolicy::class,
		 \App\Models\Article::class => \App\Policies\ArticlePolicy::class,
        'App\Model' => 'App\Policies\ModelPolicy',
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Message::class => \App\Policies\MessagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Horizon::auth(function ($request) {
            // 是否是站长
            return \Auth::user()->is_admin;
        });
    }
}
