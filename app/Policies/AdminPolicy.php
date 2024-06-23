<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    public function viewAny(Admin $admin): bool
    {
        $roleJson = $admin->group->permissions;

        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson);

            $check = isRole($roleArr, 'users');

            return $check;
        }

        return false;
    }


    public function create(Admin $admin): bool
    {
        $roleJson = $admin->group->permissions;

        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson);

            $check = isRole($roleArr, 'users', 'add');

            return $check;
        }

        return false;
    }

    public function update(Admin $admin): bool
    {
        $roleJson = $admin->group->permissions;

        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson);

            $check = isRole($roleArr, 'users', 'edit');

            return $check;
        }

        return false;
    }

    public function delete(Admin $admin): bool
    {
        $roleJson = $admin->group->permissions;

        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson);

            $check = isRole($roleArr, 'users', 'delete');

            return $check;
        }

        return false;
    }

    public function active(Admin $admin): bool
    {
        $roleJson = $admin->group->permissions;

        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson);

            $check = isRole($roleArr, 'users', 'active');

            return $check;
        }

        return false;
    }
}
