<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Veterinario;
use Illuminate\Http\Request;

class VeterinariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        Veterinario::create([
            'crmv' => $request->crmv,
            'nome' => $request->nome,
            'especialidade_id' => $request->especialidade,
        ]);
        
        return redirect()->route('veterinarios.index');
    }

    public function edit($id)
    {
        $dados = Veterinario::find($id);
        $esp = Especialidade::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('veterinarios.edit', compact(['dados','esp']));
    }

    public function update(Request $request, $id)
    {
        $obj = Veterinario::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

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
