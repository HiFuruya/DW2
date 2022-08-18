@extends('templates.middleware', ['titulo' => "Matriculas"])

@section('titulo') Matriculas @endsection


@section('conteudo')

<form action="{{ route('matriculas.update', $aluno->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <table class="table align-middle caption-top table-striped">
            <thead>
                <tr>
                    <th scope="col" class="d-none d-md-table-cell">Disciplina</th>
                    <th scope="col" class="d-none d-md-table-cell">Matriculado</th>
                </tr>
            </thead>
            <tbody>
                <!-- @php $cont=0; @endphp -->
                @foreach ($disciplina as $item)
                    <tr>
                        <td class="d-none d-md-table-cell">{{ $item->nome }}</td>
                        <td> <input type="checkbox"
                                    name="item{{$cont}}"
                                    value="{{$item->id}}"
                                    @foreach($matriculas as $matricula)
                                        @if($matricula->disciplina_id == $item->id)
                                            checked
                                        @endif
                                    @endforeach
                                    >
                        </td>
                    </tr>
                    @php $cont++; @endphp
                @endforeach
            </tbody>
        </table>

        <div class="col-lg-8 col-md-12">
                <button type="submit" class="btn btn-success btn-block align-content-center">
                    Confirmar &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </button>
        </div>
    </form>

    
@endsection