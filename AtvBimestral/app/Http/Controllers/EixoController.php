<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use Illuminate\Http\Request;

class EixoController extends Controller
{

    public function index()
    {
        $dados = Eixo::all();
        return view('eixos.index', compact('dados'));
    }

    public function create()
    {
        return view('eixos.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:50|min:10',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);
        
        Eixo::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
        ]);
        
        return redirect()->route('eixos.index');
    }

    public function edit($id)
    {
        $dados = Eixo::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('eixos.edit', compact('dados')); 
    }

    public function update(Request $request, $id)
    {
        $obj = Eixo::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $regras = [
            'nome' => 'required|max:50|min:10',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
        ]);

        $obj->save();

        return redirect()->route('eixos.index');
    }

    public function destroy($id)
    {
        $obj = Eixo::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('eixos.index');
    }
}
