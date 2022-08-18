<?php

namespace App\Http\Controllers;

use App\Facades\UserPermissions;
use App\Models\Curso;
use App\Models\Eixo;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    public function index()
    {
        if(!UserPermissions::isAuthorized('cursos.index')) {
            abort(403);
        }

        $dados = Curso::with(['eixo'])->get();
        return view('cursos.index', compact('dados'));
    }

    public function create()
    {
        if(!UserPermissions::isAuthorized('cursos.create')) {
            abort(403);
        }

        $eixo = Eixo::all();
        return view('cursos.create', compact('eixo'));
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:50|min:10',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1',
            'eixo_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj_eixo = Eixo::find($request->eixo_id);

        $curso = new Curso;

        $curso->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $curso->sigla = mb_strtoupper($request->sigla, 'UTF-8');

        $curso->tempo = $request->tempo;

        $curso->eixo()->associate($obj_eixo);

        $curso->save();
        
        return redirect()->route('cursos.index');
    }

    public function edit($id)
    {
        if(!UserPermissions::isAuthorized('cursos.edit')) {
            abort(403);
        }

        $dados = Curso::find($id);
        $eixo = Eixo::all();
        return view('cursos.edit', compact('dados','eixo'));
    }

    public function update(Request $request, $id)
    {
        $obj = Curso::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $regras = [
            'nome' => 'required|max:50|min:10',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1',
            'eixo_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj_eixo = Eixo::find($request->eixo_id);

        $obj->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $obj->sigla = mb_strtoupper($request->sigla, 'UTF-8');

        $obj->tempo = $request->tempo;

        $obj->eixo()->associate($obj_eixo);

        $obj->save();

        return redirect()->route('cursos.index');
    }

    public function destroy($id)
    {
        if(!UserPermissions::isAuthorized('cursos.destroy')) {
            abort(403);
        }

        $obj = Curso::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('cursos.index');
    }
}
