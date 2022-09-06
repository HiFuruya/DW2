<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Professores;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessoresPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('professores.index');
    }

    public function view(User $user, Professores $professores)
    {
        return UserPermissions::isAuthorized('professores.show');
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('professores.create');
    }

    public function update(User $user, Professores $professores)
    {
        return UserPermissions::isAuthorized('professores.edit');
    }

    public function delete(User $user, Professores $professores)
    {
        return UserPermissions::isAuthorized('professores.destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professores  $professores
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Professores $professores)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professores  $professores
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Professores $professores)
    {
        //
    }
}
