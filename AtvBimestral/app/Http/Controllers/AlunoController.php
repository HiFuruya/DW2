<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\Request;

class AlunoController extends Controller
{

    public function index()
    {
        $dados = Aluno::all();
        $cursos = Curso::all();
        return view('alunos.index', compact('dados', 'cursos'));
    }

    public function create()
    {
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

    public function show($id)
    {
        $dados = Aluno::with(['curso'])->find($id);

        echo $dados->getAttribute('nome');
    }

    public function edit($id)
    {
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
        $obj = Aluno::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('alunos.index');
    }
}
