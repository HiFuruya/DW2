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
            @foreach ($disciplina as $item)
                <tr>
                    @php $cont=0; @endphp
                    @foreach($fields as $field)
                        @if($hide[$cont])
                            <td class="d-none d-md-table-cell">{{ $item[$field] }}</td>
                        @else
                            <td>{{ $item[$field] }}</td>
                        @endif
                        @php $cont=0; @endphp
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

</div>