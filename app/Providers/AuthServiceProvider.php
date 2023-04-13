<?php

namespace App\Providers;

use App\Mail\VerfiyMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Mail\VerifyMail;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        VerifyEmail::toMailUsing(function($notifiable, $url){
            return new VerfiyMail($notifiable, $url);
        });

        // VerifyEmail::createUrlUsing(function(){
        //     // logic here to create your own custom Verfication Url
        //     // I prefer to use what laravel has already provided us
        // });
    }
}
