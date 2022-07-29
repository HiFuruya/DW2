<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use App\Models\Professores;
use Illuminate\Http\Request;

class ProfessoresController extends Controller
{

    public function index()
    {
        $dados = Professores::all();
        $eixos = Eixo::all();
        return view('professores.index', compact('dados', 'eixos'));
    }

    public function create()
    {
        $eixo = Eixo::all();
        return view('professores.create', compact('eixo'));
    }

    public function store(Request $request)
    {
        $regras = [
            'ativo' => 'required',
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15|unique:professores',
            'siape' => 'required|max:10|min:8|unique:professores',
            'eixo_id' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já possui um [:attribute] cadastrado"
        ];

        $request->validate($regras, $msgs);

        $obj_eixo = Eixo::find($request->eixo_id);

        $professor = new Professores;

        $professor->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $professor->email = $request->email;

        $professor->siape = $request->siape;

        $professor->ativo = $request->ativo;

        $professor->eixo()->associate($obj_eixo);

        $professor->save();
        
        // Professores::create([
        //     'nome' => mb_strtoupper($request->nome, 'UTF-8'),
        //     'email' => $request->email,
        //     'siape' => $request->siape,
        //     'eixo_id' => $request->eixo_id,
        //     'ativo' => $request->ativo
        // ]);
        
        return redirect()->route('professores.index');
    }

    public function show($id)
    {
        $dados = Professores::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }
        
        $eixo = Eixo::all();

        return view('professores.show', compact('dados','eixo')); 
    }

    public function edit($id)
    {
        $dados = Professores::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }
        
        $eixo = Eixo::all();

        return view('professores.edit', compact('dados','eixo')); 
    }

    public function update(Request $request, $id)
    {
        $obj = Professores::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        if (trim($obj->email) == trim($request->email) && trim($obj->siape) == trim($request->siape)) {
            $regras = [
                'ativo' => 'required',
                'nome' => 'required|max:100|min:10',
                'eixo_id' => 'required',
            ];
    
            $msgs = [
                "required" => "O preenchimento do campo [:attribute] é obrigatório!",
                "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
                "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
            ];
        }elseif(trim($obj->email) == trim($request->email)){
            $regras = [
                'ativo' => 'required',
                'nome' => 'required|max:100|min:10',
                'siape' => 'required|max:10|min:8|unique:professores',
                'eixo_id' => 'required',
            ];
    
            $msgs = [
                "required" => "O preenchimento do campo [:attribute] é obrigatório!",
                "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
                "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
                "unique" => "Já possui um [:attribute] cadastrado"
            ];
        }elseif (trim($obj->siape) == trim($request->siape)) {
            $regras = [
                'ativo' => 'required',
                'nome' => 'required|max:100|min:10',
                'email' => 'required|max:250|min:15|unique:professores',
                'eixo_id' => 'required',
            ];
    
            $msgs = [
                "required" => "O preenchimento do campo [:attribute] é obrigatório!",
                "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
                "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
                "unique" => "Já possui um [:attribute] cadastrado"
            ];
        }else{
            $regras = [
                'ativo' => 'required',
                'nome' => 'required|max:100|min:10',
                'email' => 'required|max:250|min:15|unique:professores',
                'siape' => 'required|max:10|min:8|unique:professores',
                'eixo_id' => 'required',
            ];

            $msgs = [
                "required" => "O preenchimento do campo [:attribute] é obrigatório!",
                "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
                "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
                "unique" => "Já possui um [:attribute] cadastrado"
            ];
        }

        $request->validate($regras, $msgs);

        $obj_eixo = Eixo::find($request->eixo_id);

        $obj->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $obj->email = $request->email;

        $obj->siape = $request->siape;

        $obj->ativo = $request->ativo;

        $obj->eixo()->associate($obj_eixo);

        // $obj->fill([
        //     'nome' => mb_strtoupper($request->nome, 'UTF-8'),
        //     'email' => $request->email,
        //     'siape' => $request->siape,
        //     'eixo_id' => $request->eixo_id,
        //     'ativo' => $request->ativo
        // ]);

        $obj->save();

        return redirect()->route('professores.index');
    }

    public function destroy($id)
    {
        $obj = Professores::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('professores.index');
    }
}
