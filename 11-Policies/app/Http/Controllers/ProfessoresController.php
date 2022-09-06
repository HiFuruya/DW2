<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use App\Models\Professores;
use Illuminate\Http\Request;

class ProfessoresController extends Controller
{

    public function __construct() {
        $this->authorizeResource(Professores::class, 'professore');
    }

    public function index()
    {
        $professores = Professores::with(['eixo'])->get();
        return view('professores.index', compact('professores'));
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
        
        return redirect()->route('professores.index');
    }

    public function edit(Professores $professore)
    {
        if(!isset($professore)) { return "<h1>Professor: $professore->nome não encontrado!</h1>"; }
        
        $eixo = Eixo::all();

        return view('professores.edit', compact('professore','eixo')); 
    }

    public function update(Request $request, Professores $professore)
    {

        if(!isset($professore)) { return "<h1>Professor: $professore->nome não encontrado!"; }

        if (trim($professore->email) == trim($request->email) && trim($professore->siape) == trim($request->siape)) {
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
        }elseif(trim($professore->email) == trim($request->email)){
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
        }elseif (trim($professore->siape) == trim($request->siape)) {
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

        $professore->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $professore->email = $request->email;

        $professore->siape = $request->siape;

        $professore->ativo = $request->ativo;

        $professore->eixo()->associate($obj_eixo);

        $professore->save();

        return redirect()->route('professores.index');
    }

    public function destroy(Professores $professore)
    {

        if(!isset($professore)) { return "<h1>Professor: $professore não encontrado!"; }

        $professore->delete();

        return redirect()->route('professores.index');
    }
}
