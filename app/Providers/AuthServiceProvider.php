<?php

namespace App\Providers;

use App\Enums\Can;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    public function boot(): void
    {
        foreach (Can::cases() as $can) {
            Gate::define(
                str($can->value)->snake('-')->toString(),
                fn ($user) => $user->hasPermissionTo($can)
            );
        }
    }
}
