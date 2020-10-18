<?php

namespace App\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

use App\User;
use App\Policies\UserPolicy;
use App\Client;
use App\Policies\ClientPolicy;
use App\Routine;
use App\Policies\RoutinePolicy;
use App\Call;
use App\Policies\CallPolicy;
use App\Config;
use App\Policies\ConfigPolicy;
use App\CallAttachment;
use App\Policies\CallAttachmentPolicy;
use App\Log;
use App\Policies\LogPolicy;
use App\Formality;
use App\Policies\FormalityPolicy;
use App\FormalityAttachment;
use App\Policies\FormalityAttachmentPolicy;
use App\EconomicGroup;
use App\Policies\EconomicGroupPolicy;
use App\Affiliate;
use App\Policies\AffiliatePolicy;
use App\Employee;
use App\Policies\EmployeePolicy;
use App\FrequencyQuestions;
use App\Policies\FrequencyQuestionsPolicy;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Basic Authentication
        $this->app['auth']->viaRequest('api', function ($request) {
            $username = $request->server('PHP_AUTH_USER');
            if ($username) {
                $user = User::where('username', $username)->first();
                if ($user) {
                    if (Hash::check($request->server('PHP_AUTH_PW'), $user->password)) {
                        if ($user->is_active) {
                            return $user;
                        }
                    }
                }
            }
        });

        // Permissões
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Client::class, ClientPolicy::class);
        Gate::policy(Routine::class, RoutinePolicy::class);
        Gate::policy(Call::class, CallPolicy::class);
        Gate::policy(Config::class, ConfigPolicy::class);
        Gate::policy(CallAttachment::class, CallAttachmentPolicy::class);
        Gate::policy(Log::class, LogPolicy::class);
        Gate::policy(Formality::class, FormalityPolicy::class);
        Gate::policy(FormalityAttachment::class, FormalityAttachmentPolicy::class);
        Gate::policy(EconomicGroup::class, EconomicGroupPolicy::class);
        Gate::policy(Affiliate::class, AffiliatePolicy::class);
        Gate::policy(Employee::class, EmployeePolicy::class);
        Gate::policy(FrequencyQuestions::class, FrequencyQuestionsPolicy::class);
    }
}
