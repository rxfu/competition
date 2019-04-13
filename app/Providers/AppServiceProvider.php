<?php

namespace App\Providers;

use App\Entities\Permission;
use App\Repositories\UserRepository;
use Gate;
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
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            Gate::define($permission->slug, function ($user) use ($permission) {
                if ($user->is_super) {
                    return true;
                } else {
                    $userRepository = new UserRepository($user);
    
                    return $userRepository->hasPermission($user->id, $permission->slug);
                }
            });
        }
    }
}
