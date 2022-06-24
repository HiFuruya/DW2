<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.mainVet', ['titulo' => "Veterinários", 'rota' => "veterinarios.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Veterinários @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <!-- Utiliza o componente "datalist" criado -->
            <x-datalistVet 
                :header="['CRMV', 'NOME', 'ESPECIALIDADE', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, false, true, false]" 
            />

        </div>
    </div>
@endsection