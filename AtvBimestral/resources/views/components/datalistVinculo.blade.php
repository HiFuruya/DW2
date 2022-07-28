<div>
    
    <table class="table align-middle caption-top table-striped">
        <caption>Tabela de <b>{{ $title }}</b></caption>
        <thead>
        <tr>
            @php $cont=0; @endphp
            @foreach ($header as $item)

                @if($hide[$cont])
                    <th scope="col" class="d-none d-md-table-cell">{{ $item }}</th>
                @else
                    <th scope="col">{{ $item }}</th>
                @endif
                @php $cont++; @endphp

            @endforeach
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    @php $cont=0; @endphp

                    @foreach($fields as $field)
                        @if(trim($field) == trim('disciplina_id'))
                            @foreach($disciplinas as $disciplina)
                                @if($disciplina->id == $item->disciplina_id)
                                    @if($hide[$cont])
                                        <td class="d-none d-md-table-cell">{{ $disciplina->nome }}</td>
                                    @else
                                        <td>{{ $disciplina->nome }}</td>
                                    @endif
                                @endif
                            @endforeach
                        @else   
                            @foreach($professores as $professor)
                                @if($professor->id == $item->professor_id)
                                    @if($hide[$cont])
                                        <td class="d-none d-md-table-cell">{{ $professor->nome }}</td>
                                    @else
                                        <td>{{ $professor->nome }}</td>
                                    @endif
                                @endif
                            @endforeach
                        @endif

                        @php $cont=0; @endphp
                    @endforeach

                    <td>
                        <a href= "{{ route($crud.'.edit', $item['disciplina_id']) }}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>