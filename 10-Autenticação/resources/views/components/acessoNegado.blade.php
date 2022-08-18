@extends('templates.main', ['titulo' => "Acesso Restrito"])

@section('titulo') Acesso Restrito @endsection

@section('conteudo')

    <h2 class= "text-center" >Um momento, amigo. Você não possui permissão para passar.</h2>
    <img src="https://pbs.twimg.com/media/CLGV66dUMAALhjv?format=jpg&name=900x900" class="mx-auto d-block" width="250" >
@endsection
