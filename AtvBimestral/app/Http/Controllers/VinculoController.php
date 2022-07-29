<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Professores;
use App\Models\Vinculo;
use Illuminate\Http\Request;

class VinculoController extends Controller
{

    public function index()
    {
        $vinculos = Vinculo::with(['disciplina'])
                            ->with(['professor'])
                            ->get();

        return view("vinculos.index2", compact('vinculos'));
    }

    public function store(Request $request){
        $regras = [
            'professor_id' => 'required',
            'disciplina_id' => 'required',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        ];

        $request->validate($regras, $msgs);

        $professor = Professores::find($request->professor_id);

        $disciplina = Disciplina::find($request->disciplina_id);

        $vinculo = new Vinculo;

        $vinculo->professor()->associate($professor);

        $vinculo->disciplina()->associate($disciplina);

        $vinculo->save();

        return redirect()->route('vinculos.index');
    }

    public function create()
    {
        $disciplinas = Disciplina::all();
        $professores = Professores::all();
        $vinculos = Vinculo::all();

        return view("vinculos.create", compact('disciplinas', 'professores', 'vinculos'));
    }

    public function edit($id)
    {
        $disciplina = Disciplina::find($id);
        $professores = Professores::all();
        $dados = Vinculo::all();

        return view('vinculos.edit', compact('dados','professores', 'disciplina')); 
    }

    public function update(Request $request, $id)
    {
        $obj = Vinculo::where('disciplina_id', $id)->first();

        $regras = [
            'professor_id' => 'required',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        ];

        $request->validate($regras, $msgs);

        $obj->where('disciplina_id', $id)->update(['professor_id'=> $request->professor_id]);

        return redirect()->route('vinculos.index');
    }
}
