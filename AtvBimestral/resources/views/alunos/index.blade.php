@extends('templates.main', ['titulo' => "Alunos", 'rota' => "alunos.create"])

@section('titulo') Alunos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistDisciplina 
                :title="'Alunos'"
                :crud="'alunos'"
                :header="['NOME', 'CURSO', 'AÇÕES']" 
                :fields="['nome', 'curso_id']"
                :data="$dados"
                :cursos="$cursos"
                :hide="[true, false, true, false]" 
                :info="['nome', 'curso']"
                :remove="'nome'"
            />
        </div>
    </div>
@endsection