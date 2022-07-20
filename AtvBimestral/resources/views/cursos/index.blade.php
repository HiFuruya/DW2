@extends('templates.main', ['titulo' => "Cursos", 'rota' => "cursos.create"])

@section('titulo') Cursos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalist 
                :title="'Cursos'"
                :crud="'cursos'"
                :header="['NOME', 'SIGLA', 'AÇÕES']" 
                :fields="['nome', 'sigla']"
                :data="$dados"
                :hide="[true, false, true, false]" 
                :info="['nome', 'sigla', 'tempo', 'eixo_id']"
                :remove="'nome'"
            />
        </div>
    </div>
@endsection