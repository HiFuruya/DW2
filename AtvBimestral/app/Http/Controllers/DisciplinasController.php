<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{

    public function index()
    {
        $dados = Disciplina::all();
        $cursos = Curso::all();
        return view('disciplinas.index', compact('dados', 'cursos'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('disciplinas.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'carga' => 'required|max:12|min:1',
            'curso_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        Disciplina::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'carga' => $request->carga,
            'curso_id' => $request->curso_id,
        ]);
        
        return redirect()->route('disciplinas.index');
    }

    public function show($id)
    {
        $dados = Disciplina::find($id);
        $cursos = Curso::all();
        return view('disciplinas.show', compact('dados', 'cursos'));
    }

    public function edit($id)
    {
        $dados = Disciplina::find($id);
        $cursos = Curso::all();
        return view('disciplinas.edit', compact('dados', 'cursos'));
    }

    public function update(Request $request, $id)
    {
        $obj = Disciplina::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $regras = [
            'nome' => 'required|max:100|min:10',
            'carga' => 'required|max:12|min:1',
            'curso_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'carga' => $request->carga,
            'curso_id' => $request->curso_id,
        ]);

        $obj->save();

        return redirect()->route('disciplinas.index');
    }

    public function destroy($id)
    {
        $obj = Disciplina::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('disciplinas.index');
    }
}
