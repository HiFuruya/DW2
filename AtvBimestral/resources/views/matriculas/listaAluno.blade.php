@extends('templates.main', ['titulo' => "Alunos Matriculados"])

@section('titulo') Matriculas @endsection


@section('conteudo')

    <table class="d-none d-md-table-cell">
        <thead>
            <tr>
                <th scope="col" class="d-none d-md-table-cell">ALUNOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $item)
                <tr>
                    <td class="d-none d-md-table-cell">{{ $item->aluno->nome }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection