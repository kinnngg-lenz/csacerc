<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Alumini;
use App\Policies\AluminiPolicy;
use App\Question;
use App\Policies\QuestionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Question' => 'App\Policies\QuestionPolicy',
        'App\CodeWarQuestion' => 'App\Policies\CodeWarQuestionPolicy',
        'App\Quote' => 'App\Policies\QuotePolicy',
        'App\Alumini' => 'App\Policies\AluminiPolicy',
        'App\Message' => 'App\Policies\MessagePolicy',
        'App\Shout' => 'App\Policies\ShoutPolicy',
        'App\CodeWarAnswer' => 'App\Policies\CodeWarAnswerPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
