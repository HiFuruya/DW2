<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Aluno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlunoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('alunos.index');
    }

    public function view(User $user, Aluno $aluno)
    {
        return UserPermissions::isAuthorized('alunos.show');
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('alunos.create');
    }

    public function update(User $user, Aluno $aluno)
    {
        return UserPermissions::isAuthorized('alunos.edit');
    }

    public function delete(User $user, Aluno $aluno)
    {
        return UserPermissions::isAuthorized('alunos.destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Aluno $aluno)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Aluno $aluno)
    {
        //
    }
}
