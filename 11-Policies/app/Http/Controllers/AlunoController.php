<?php

namespace App\Http\Controllers;

use App\Facades\UserPermissions;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Matricula;
use Illuminate\Http\Request;

class AlunoController extends Controller
{

    public function __construct() {
        $this->authorizeResource(Aluno::class, 'aluno');
    }

    public function index()
    {
        $dados = Aluno::with(['curso'])->get();
        return view('alunos.index', compact('dados'));
    }

    public function create()
    {

        $cursos = Curso::all();
        return view('alunos.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj_curso = Curso::find($request->curso_id);

        $aluno = new Aluno;

        $aluno->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $aluno->curso()->associate($obj_curso);

        $aluno->save();

        return redirect()->route('alunos.index');
    }

    public function edit(Aluno $aluno)
    {
        $cursos = Curso::all();
        return view('alunos.edit', compact('aluno', 'cursos'));
    }

    public function update(Request $request, Aluno $aluno)
    {

        if(!isset($aluno)) { return "<h1>Aluno: $aluno->nome não encontrado!"; }

        $regras = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj_curso = Curso::find($request->curso_id);

        $aluno->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $aluno->curso()->associate($obj_curso);

        $aluno->save();

        return redirect()->route('alunos.index');
    }

    public function destroy(Aluno $aluno)
    {

        if(!isset($aluno)) { return "<h1>Aluno: $aluno->nome não encontrado!"; }

        $aluno->delete();

        return redirect()->route('alunos.index');
    }

    public function show(Aluno $aluno)
    {

        $disciplina = Disciplina::where('curso_id', $aluno->curso_id)->get();

        $matriculas = Matricula::where('aluno_id', $aluno->id)->get();

        return view('matriculas.matricula', compact('aluno', 'disciplina', 'matriculas'));
    }
}
