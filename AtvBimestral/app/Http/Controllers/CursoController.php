<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Eixo;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    public function index()
    {
        $dados = Curso::all();
        $eixos = Eixo::all();
        return view('cursos.index', compact('dados', 'eixos'));
    }

    public function create()
    {
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

        Curso::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'sigla' => mb_strtoupper($request->sigla, 'UTF-8'),
            'tempo' => $request->tempo,
            'eixo_id' => $request->eixo_id,
        ]);
        
        return redirect()->route('cursos.index');
    }

    public function show($id)
    {
        $dados = Curso::find($id);
    
        if(!isset($dados)) { return "<h1>ID: $id não encontrado!"; }

        $eixo = Eixo::all();

        return view('cursos.show', compact('dados', 'eixo'));

    }

    public function edit($id)
    {
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

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'sigla' => mb_strtoupper($request->sigla, 'UTF-8'),
            'tempo' => $request->tempo,
            'eixo_id' => $request->eixo_id,
        ]);

        $obj->save();

        return redirect()->route('cursos.index');
    }

    public function destroy($id)
    {
        $obj = Curso::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('cursos.index');
    }
}
