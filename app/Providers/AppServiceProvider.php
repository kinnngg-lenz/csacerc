<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Pusher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $options = array(
            'cluster' => 'eu',
            'encrypted' => false
        );
        $this->app->singleton('pusher',function() use($options){
            return new Pusher(env('PUSHER_KEY'),env('PUSHER_SECRET'),env('PUSHER_APP_ID'),$options);
        });
    }
}
