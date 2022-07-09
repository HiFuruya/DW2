<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Veterinario;
use Illuminate\Http\Request;

class VeterinariosController extends Controller
{

    public function index()
    {
        $dados = Veterinario::all();
        return view('veterinarios.index', compact('dados'));
    }

    
    public function create()
    {
        $esp = Especialidade::all();
        return view('veterinarios.create', compact('esp'));
    }

    public function store(Request $request)
    {
        $regras = [
            'crmv' => 'required|max:10|min:5|unique:veterinarios',
            'nome' => 'required|max:100|min:10',
            'especialidade_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um Veterinário cadastrado com esse [:attribute]!"
        ];

        echo $request->especialidade_id;

        $request->validate($regras, $msgs);

        Veterinario::create([
            'crmv' => $request->crmv,
            'nome' => $request->nome,
            'especialidade_id' => $request->especialidade_id,
        ]);
        
        return redirect()->route('veterinarios.index');
    }

    public function edit($id)
    {
        $dados = Veterinario::find($id);
        $esp = Especialidade::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        // dd($dados);

        echo($dados->id);

        return view('veterinarios.edit', compact(['dados','esp']));
    }

    public function update(Request $request, $id)
    {
        $obj = Veterinario::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        if ($request->crmv == $obj->crmv) {
            $regras = [
                'crmv' => 'required|max:10|min:5',
                'nome' => 'required|max:100|min:10',
                'especialidade_id' => 'required'
            ];
        }else{
            $regras = [
                'crmv' => 'required|max:10|min:5|unique:veterinarios',
                'nome' => 'required|max:100|min:10',
                'especialidade_id' => 'required'
            ];
        }

        $msgs = [
            "required" => "O preenchimento do campo Especialidade é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um Veterinário cadastrado com esse [:attribute]!"
        ];

        $request->validate($regras, $msgs);

        $obj->fill([
            'crmv' => $request->crmv,
            'nome' => $request->nome,
            'especialidade' => $request->especialidade,
        ]);

        $obj->save();

        return redirect()->route('veterinarios.index');
    }

    public function destroy($id)
    {
        $obj = Veterinario::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('veterinarios.index');
    }
}
