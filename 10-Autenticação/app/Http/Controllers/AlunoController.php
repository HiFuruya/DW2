<?php

namespace App\Http\Controllers;

use App\Facades\UserPermissions;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Matricula;
use Illuminate\Http\Request;

class AlunoController extends Controller
{

    public function index()
    {
        if(!UserPermissions::isAuthorized('alunos.index')) {
            abort(403);
        }

        $dados = Aluno::with(['curso'])->get();
        return view('alunos.index', compact('dados'));
    }

    public function create()
    {
        if(!UserPermissions::isAuthorized('alunos.create')) {
            abort(403);
        }

        $cursos = Curso::all();
        return view('alunos.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj_curso = Curso::find($request->curso_id);

        $aluno = new Aluno;

        $aluno->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $aluno->curso()->associate($obj_curso);

        $aluno->save();

        return redirect()->route('alunos.index');
    }

    public function edit($id)
    {
        if(!UserPermissions::isAuthorized('alunos.edit')) {
            abort(403);
        }

        $dados = Aluno::find($id);
        $cursos = Curso::all();
        return view('alunos.edit', compact('dados', 'cursos'));
    }

    public function update(Request $request, $id)
    {
        $obj = Aluno::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $regras = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj_curso = Curso::find($request->curso_id);

        $obj->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $obj->curso()->associate($obj_curso);

        $obj->save();

        return redirect()->route('alunos.index');
    }

    public function destroy($id)
    {
        if(!UserPermissions::isAuthorized('alunos.destroy')) {
            abort(403);
        }

        $obj = Aluno::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('alunos.index');
    }

    public function show($id)
    {
        if(!UserPermissions::isAuthorized('alunos.show')) {
            abort(403);
        }

        $aluno = Aluno::find($id);

        $disciplina = Disciplina::where('curso_id', $aluno->curso_id)->get();

        $matriculas = Matricula::where('aluno_id', $id)->get();

        return view('matriculas.matricula', compact('aluno', 'disciplina', 'matriculas'));
    }
}
