<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\Admin;
use App\Policies\AdminPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Admin::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /*
        users.view
        */
        $modules = Module::all();

        if($modules->count() > 0){
            foreach($modules as $module){
                Gate::define($module->name, function(Admin $user) use($module) {
                    $roleJson = $user->group->permissions;

                    if(!empty($roleJson)){
                        $roleArr = json_decode($roleJson);

                        $check = isRole($roleArr, $module->name);

                        return $check;
                    }

                    return false;

                });

                Gate::define($module->name.'edit', function(Admin $user) use($module) {
                    $roleJson = $user->group->permissions;

                    if(!empty($roleJson)){
                        $roleArr = json_decode($roleJson);

                        $check = isRole($roleArr, $module->name, 'edit');

                        return $check;
                    }

                    return false;

                });

                Gate::define($module->name.'delete', function(Admin $user) use($module) {
                    $roleJson = $user->group->permissions;

                    if(!empty($roleJson)){
                        $roleArr = json_decode($roleJson);

                        $check = isRole($roleArr, $module->name, 'delete');

                        return $check;
                    }

                    return false;

                });
            }   
        }

    }
}
