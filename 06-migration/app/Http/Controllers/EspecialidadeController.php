<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
    public function index() {

        $dados = Especialidade::all();
        return view('especialidades.index', compact('dados'));
    }

    public function create() {
        return view('especialidades.create');
    }

   public function store(Request $request) {
        
        Especialidade::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);
        
        return redirect()->route('especialidades.index');
    }

    public function edit($id) {

        $dados = Especialidade::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('especialidades.edit', compact('dados'));            
    }

    public function update(Request $request, $id) {
        
        $obj = Especialidade::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->fill([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);

        $obj->save();

        return redirect()->route('especialidades.index');
    }

    public function destroy($id) {
        $obj = Especialidade::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('especialidades.index');
    }
}
