<?php

namespace App\Http\Controllers;

use App\Facades\UserPermissions;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{

    public function update(Request $request, $id)
    {
        $aluno = Aluno::find($id);

        $matriculas = new Matricula;

        $matriculas->where('aluno_id', $id)->delete();

        $disciplinas = Disciplina::where('curso_id', $aluno->curso_id)->get();

        for ($i=0; $i < sizeof($disciplinas); $i++) { 
            $item = 'item'.$i;
            $disciplina_id = $request->$item;

            if ($disciplina_id != null) {
                $disciplina = Disciplina::find($disciplina_id);

                $matricula = new Matricula;

                $matricula->aluno()->associate($aluno);
                $matricula->disciplina()->associate($disciplina);
                $matricula->save();
            }
        }

        return redirect()->route('alunos.index');
    }

}
