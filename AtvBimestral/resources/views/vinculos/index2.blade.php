@extends('templates.main', ['titulo' => "Docência(2022)", 'rota' => "vinculos.create"])

@section('titulo') Docência (2022) @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistVinculo 
                :title="'Docência'"
                :crud="'vinculos'"
                :header="['DISCIPLINA', 'PROFESSOR', 'AÇÕES']"
                :fields="['disciplina_id', 'professor_id']"
                :data="$vinculos"
                :professores="$professores"
                :disciplinas="$disciplinas"
                :hide="[true, false, true, false]" 
            />
        </div>
    </div>
@endsection