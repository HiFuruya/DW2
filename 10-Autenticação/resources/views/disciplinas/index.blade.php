@extends('templates.middleware', ['titulo' => "Disciplinas", 'rota' => "disciplinas.create"])

@section('titulo') Disciplinas @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistDisciplina 
                :title="'Disciplinas'"
                :crud="'disciplinas'"
                :header="['NOME', 'CURSO', 'AÇÕES']" 
                :fields="['nome', 'curso_id']"
                :data="$dados"
                :hide="[true, false, true, false]" 
                :info="['nome', 'curso']"
                :remove="'nome'"
            />
        </div>
    </div>
@endsection