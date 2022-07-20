@extends('templates.main', ['titulo' => "Professores", 'rota' => "professores.create"])

@section('titulo') Professores @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistProfessores 
                :title="'Professores'"
                :crud="'professores'"
                :header="['NOME', 'EIXO', 'STATUS', 'AÇÕES']" 
                :fields="['nome', 'eixo_id', 'ativo']"
                :data="$dados"
                :eixos="$eixos"
                :hide="[true, false, true, false]" 
                :info="['nome', 'eixo', 'status']"
                :remove="'nome'"
            />
        </div>
    </div>
@endsection