<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Eixo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EixoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('eixos.index');
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('eixos.create');
    }

    public function update(User $user, Eixo $eixo)
    {
        return UserPermissions::isAuthorized('eixos.edit');
    }

    public function delete(User $user, Eixo $eixo)
    {
        return UserPermissions::isAuthorized('eixos.destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eixo  $eixo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Eixo $eixo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Eixo  $eixo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Eixo $eixo)
    {
        //
    }
}
