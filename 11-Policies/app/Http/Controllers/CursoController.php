<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Eixo;
use Illuminate\Http\Request;

class CursoController extends Controller {

    public function __construct() {
        $this->authorizeResource(Curso::class, 'curso');
    }

    public function index() {

        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
    }

    public function create() {
        $eixo = Eixo::all();
        return view('cursos.create', compact('eixo'));
    }

    public function store(Request $request) {
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

    public function edit(Curso $curso) {

        if(isset($curso)) {
            $eixo = Eixo::all();
            return view('cursos.edit', compact('curso', 'eixo'));
        }

        return "<h1>Curso não Encontrado!</h1>";  
    }

    public function update(Request $request, Curso $curso) {

        if(isset($curso)) {
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

            $curso->nome = mb_strtoupper($request->nome, 'UTF-8');
            $curso->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $curso->tempo = $request->tempo;
            $obj_eixo = Eixo::find($request->eixo_id);
            $curso->eixo()->associate($obj_eixo);   
            $curso->save();
            return redirect()->route('cursos.index');
        }

        return "<h1>Curso não Encontrado!</h1>";
    }

    public function destroy(Curso $curso) {

        if(isset($curso)) {
            $curso->delete();
            return redirect()->route('cursos.index');
        }

        return "<h1>Curso não Encontrado!</h1>";
    }
}
