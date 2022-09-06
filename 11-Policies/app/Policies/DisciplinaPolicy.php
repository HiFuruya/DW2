<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Disciplina;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisciplinaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('disciplinas.index');
    }

    public function view(User $user, Disciplina $disciplina)
    {
        return UserPermissions::isAuthorized('disciplinas.show');
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('disciplinas.create');
    }

    public function update(User $user, Disciplina $disciplina)
    {
        return UserPermissions::isAuthorized('disciplinas.edit');
    }

    public function delete(User $user, Disciplina $disciplina)
    {
        return UserPermissions::isAuthorized('disciplinas.destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Disciplina $disciplina)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Disciplina $disciplina)
    {
        //
    }
}
