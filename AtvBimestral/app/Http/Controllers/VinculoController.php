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
        $disciplinas = Disciplina::all();
        $professores = Professores::all();
        $vinculos = Vinculo::all();

        return view("vinculos.index2", compact('disciplinas', 'professores', 'vinculos'));
    }

    // public function store(Request $request)
    // {
    //     $regras = [
    //         'PROFESSOR_ID_SELECTED' => 'required',
    //         'DISCIPLINA' => 'required',
    //     ];
    //     $msgs = [
    //         "required" => "O preenchimento do campo [:attribute] é obrigatório!",
    //     ];

    //     $request->validate($regras, $msgs);

    //     $ids_prof = $request->PROFESSOR_ID_SELECTED;
    //     $disciplina = $request->DISCIPLINA;


    //     for ($i = 0; $i < count($request->DISCIPLINA); $i++) {
    //         $doc = new Vinculo();
    //         $doc->professor_id = $ids_prof[$i];
    //         $doc->disciplina_id = $disciplina[$i];
    //         $doc->save();
    //     }

    //     return redirect()->route('index');
    // }

    public function store(Request $request){
        $regras = [
            'professor_id' => 'required',
            'disciplina_id' => 'required',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        ];

        $request->validate($regras, $msgs);

        Vinculo::create([
            'disciplina_id' => $request->disciplina_id,
            'professor_id' => $request->professor_id
        ]);

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

    public function update(Request $request)
    {
        $regras = [
            'professor_id' => 'required',
            'disciplina_id' => 'required',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        ];

        $request->validate($regras, $msgs);

        $request->fill([
            'disciplina_id' => $request->disciplina_id,
            'professor_id' => $request->professor_id
        ]);

        return redirect()->route('vinculos.index');
    }
}
