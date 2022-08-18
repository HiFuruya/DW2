@extends('templates.middleware', ['titulo' => "Eixos e Áreas", 'rota' => "eixos.create"])

@section('titulo') Eixos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistEixo 
                :title="'Eixos'"
                :crud="'eixos'"
                :header="['NOME', 'AÇÕES']"
                :fields="['nome']"
                :data="$dados"
                :hide="[true, false, true, false]" 
                :remove="'nome'"
            />
        </div>
    </div>
@endsection