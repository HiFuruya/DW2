<?php

namespace App\Http\Controllers;

use App\Facades\UserPermissions;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Matricula;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{

    public function index()
    {
        if(!UserPermissions::isAuthorized('disciplinas.index')) {
            abort(403);
        }

        $dados = Disciplina::with(['curso'])->get();
        return view('disciplinas.index', compact('dados'));
    }

    public function create()
    {
        if(!UserPermissions::isAuthorized('disciplinas.create')) {
            abort(403);
        }

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

        $obj_curso = Curso::find($request->curso_id);

        $disciplina = new Disciplina;

        $disciplina->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $disciplina->carga = $request->carga;

        $disciplina->curso()->associate($obj_curso);

        $disciplina->save();

        return redirect()->route('disciplinas.index');
    }

    public function show($id)
    {
        if(!UserPermissions::isAuthorized('disciplinas.show')) {
            abort(403);
        }

        $dados = Matricula::with(['aluno'])->where('disciplina_id', $id)->get();

        return view('matriculas.listaAluno', compact('dados'));
    }

    public function edit($id)
    {
        if(!UserPermissions::isAuthorized('disciplinas.edit')) {
            abort(403);
        }

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

        $obj_curso = Curso::find($request->curso_id);

        $obj->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $obj->carga = $request->carga;

        $obj->curso()->associate($obj_curso);

        $obj->save();

        return redirect()->route('disciplinas.index');
    }

    public function destroy($id)
    {
        if(!UserPermissions::isAuthorized('disciplinas.destroy')) {
            abort(403);
        }

        $obj = Disciplina::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('disciplinas.index');
    }
}
