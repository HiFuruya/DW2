@extends('templates.main', ['titulo' => "Docência (2022)", 'rota' => "vinculos.index"])

@section('titulo') Docência (2022) @endsection

@section('conteudo')

<div class="row mb-3">
    <div class="col">
        <table class="table align-middle caption-top table-striped" id="tabela">
            <tbody>
                <form action="{{ route('vinculos.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col" >
                            <div class="form-floating mb-3 ">
                                <select name="disciplina_id" 
                                        class="form-control"
                                        disabled>
                                            <option value="{{$disciplina->id}}">
                                                {{$disciplina->nome}}
                                            </option>
                                </select>
                                @if($errors->has('disciplina_id'))
                                    <div class='invalid-feedback'>
                                        {{ $errors->first('disciplina_id') }}
                                    </div>
                                @endif
                                <label for="disciplina_id">Disciplina</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" >
                            <div class="form-floating mb-3 ">
                                <select name="professor_id" 
                                        class="form-control {{ $errors->has('professor_id') ? 'is-invalid' : '' }}">
                                    <option value=""></option>
                                    @foreach($professores as $i)
                                            <option value="{{$i->id}}">
                                                {{$i->nome}}
                                            </option>
                                    @endforeach
                                </select>
                                @if($errors->has('professor_id'))
                                    <div class='invalid-feedback'>
                                        {{ $errors->first('professor_id') }}
                                    </div>
                                @endif
                                <label for="professor_id">Professor</label>
                            </div>
                        </div>
                    </div>
                </form>
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <a href="{{route('vinculos.index')}}" class="btn btn-secondary btn-block align-content-center w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                    </svg>
                    &nbsp;<b>Sair</b>
                </a>
            </div>
            <div class="col-lg-8 col-md-12">
                <a href="javascript:document.querySelector('form').submit();" class="btn btn-success btn-block align-content-center">
                    Confirmar &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </a>
            </div>
        </div>
        </form>

    </div>
</div>



@endsection

@section('script')

<script type="text/javascript"></script>
@endsection