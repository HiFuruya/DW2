<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Veterinários", 'rota' => "veterinarios.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Veterinários @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <!-- Utiliza o componente "datalist" criado -->
            <x-datalist 
            :title="'Veterinarios'"
                :crud="'veterinarios'"
                :header="['ID', 'CRMV', 'NOME',  'AÇÕES']" 
                :fields="['id', 'crmv', 'nome']"
                :data="$dados"
                :hide="[true, false, true, false]" 
                :info="['id', 'crmv', 'nome', 'especialidade_id']"
                :remove="'nome'"
            />

        </div>
    </div>
@endsection