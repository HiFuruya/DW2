@extends('templates.main', ['titulo' => "Informações do Professor"])

@section('titulo') Professores @endsection

@section('conteudo')

        <div class="row">
            <div class="col" >
                    @if($dados->ativo == 1)
                        <label class="btn btn-primary"> Ativo </label>
                    @else
                        <label class="btn btn-danger"> Inativo </label>
                    @endif
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input 
                        type="text" 
                        class="form-control" 
                        name="nome" 
                        placeholder="Nome"
                        value="{{$dados['nome']}}"
                        disabled
                    />
                    <label for="nome">Nome do Professor</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input 
                        type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email"
                        value="{{$dados['email']}}"
                        disabled
                    />
                    <label for="email">E-mail do Professor</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input 
                        type="text" 
                        class="form-control" 
                        name="siape" 
                        placeholder="SIAPE"
                        value="{{$dados['siape']}}"
                        disabled
                    />
                    <label for="siape">SIAPE do Professor</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3 ">
                    <select name="eixo_id" 
                            id="eixos"
                            class="form-control"
                            disabled>
                        @foreach($eixo as $i)
                            @if($i->id == $dados->eixo_id){
                                <option value="{{$i->id}}" selected>
                                    {{$i->nome}}
                                </option>}
                            @endif
                        @endforeach
                    </select>
                    <label for="eixo_id">Eixo/Área</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{route('professores.index')}}" class="btn btn-secondary btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    &nbsp; Voltar
                </a>
            </div>
        </div>

@endsection