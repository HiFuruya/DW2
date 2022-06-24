<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VeterinariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $veterinarios = [[
        "crmv" => 1,
        "nome" => "Gil Eduardo",
        "especialidade" => "Geral"
    ]];

    public function __construct() {
        $aux = session('veterinarios');

        if(!isset($aux)) {
            session(['veterinarios' => $this->veterinarios]);
        }
    }

    public function index()
    {
        $dados = session('veterinarios');
        $clinica = "VetClin DWII";

        return view('veterinarios.index', compact(['dados', 'clinica']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veterinarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aux = session('veterinarios');
        $crmvs = array_column($aux, 'crmv');

        if(count($crmvs) > 0) {
            $new_crmv = max($crmvs) + 1;
        }
        else {
            $new_crmv = 1;   
        }

        $novo = [
            "crmv" => $new_crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade
        ];

        array_push($aux, $novo);
        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($crmv)
    {
        $aux = session('veterinarios');
        
        $index = array_search($crmv, array_column($aux, 'crmv'));

        $dados = $aux[$index];

        return view('veterinarios.show', compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($crmv)
    {
        $aux = session('veterinarios');
            
        $index = array_search($crmv, array_column($aux, 'crmv'));

        $dados = $aux[$index];    

        return view('veterinarios.edit', compact('dados')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $crmv)
    {
        $aux = session('veterinarios');
        
        $index = array_search($crmv, array_column($aux, 'crmv'));

        $novo = [
            "crmv" => $crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade,
        ];

        $aux[$index] = $novo;
        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($crmv)
    {
        $aux = session('veterinarios');
        
        $index = array_search($crmv, array_column($aux, 'crmv')); 

        unset($aux[$index]);

        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }
}
