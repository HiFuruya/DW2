<?php

namespace App\Http\Controllers;

use App\Facades\UserPermissions;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Matricula;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{

    public function __construct() {
        $this->authorizeResource(Disciplina::class, 'disciplina');
    }

    public function index()
    {
        $dados = Disciplina::with(['curso'])->get();
        return view('disciplinas.index', compact('dados'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('disciplinas.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'carga' => 'required|max:12|min:1',
            'curso_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj_curso = Curso::find($request->curso_id);

        $disciplina = new Disciplina;

        $disciplina->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $disciplina->carga = $request->carga;

        $disciplina->curso()->associate($obj_curso);

        $disciplina->save();

        return redirect()->route('disciplinas.index');
    }

    public function show(Disciplina $disciplina)
    {
        $dados = Matricula::with(['aluno'])->where('disciplina_id', $disciplina->id)->get();

        return view('matriculas.listaAluno', compact('dados'));
    }

    public function edit(Disciplina $disciplina)
    {
        $cursos = Curso::all();
        return view('disciplinas.edit', compact('disciplina', 'cursos'));
    }

    public function update(Request $request, Disciplina $disciplina)
    {

        if(!isset($disciplina)) { return "<h1>Disciplina: $disciplina->nome não encontrado!"; }

        $regras = [
            'nome' => 'required|max:100|min:10',
            'carga' => 'required|max:12|min:1',
            'curso_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj_curso = Curso::find($request->curso_id);

        $disciplina->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $disciplina->carga = $request->carga;

        $disciplina->curso()->associate($obj_curso);

        $disciplina->save();

        return redirect()->route('disciplinas.index');
    }

    public function destroy(Disciplina $disciplina)
    {

        if(!isset($disciplina)) { return "<h1>Disciplina: $disciplina->id não encontrado!"; }

        $disciplina->delete();

        return redirect()->route('disciplinas.index');
    }
}
