<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use Illuminate\Http\Request;

class EixoController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Eixo::class, 'eixo');
    }

    public function index()
    {
        $eixos = Eixo::all();
        return view('eixos.index', compact('eixos'));
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

    public function edit(Eixo $eixo)
    {

        if(!isset($eixo)) { return "<h1>ID: $eixo->nome não encontrado!</h1>"; }

        return view('eixos.edit', compact('eixo')); 
    }

    public function update(Request $request, Eixo $eixo)
    {

        if(!isset($eixo)) { return "<h1>ID: $eixo->nome não encontrado!"; }

        $regras = [
            'nome' => 'required|max:50|min:10',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $eixo->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
        ]);

        $eixo->save();

        return redirect()->route('eixos.index');
    }

    public function destroy(Eixo $eixo)
    {

        if(!isset($eixo)) { return "<h1>Nome: $eixo->nome não encontrado!"; }

        $eixo->delete();

        return redirect()->route('eixos.index');
    }
}