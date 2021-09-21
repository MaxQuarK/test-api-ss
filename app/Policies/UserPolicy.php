<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $user)
    {
        if ($user->hasRole('manager')) {
            return true;
        } else {
            return false;
        }
    }

    public function create(User $user)
    {
        if ($user->hasRole('employer')) {
            return true;
        } else {
            return false;
        }
    }

    public function create_user(User $user)
    {
        if ($user->hasRole('manager')) {
            return true;
        } else {
            return false;
        }
    }

    public function edit(User $user)
    {
        return $user->hasRole($user->role->title);
    }

    public function update(User $user)
    {
        return $user->hasRole($user->role->title);
    }

    public function delete(User $user)
    {
        return $user->hasRole($user->role->title);
    }
}
