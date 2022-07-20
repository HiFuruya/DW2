<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Professores;
use Illuminate\Http\Request;

class VinculoController extends Controller
{

    public function index()
    {
        $disciplinas = Disciplina::all();
        $professores = Professores::all();

        return view("vinculos.index", compact('disciplinas', 'professores'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }
}
