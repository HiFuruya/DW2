<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="row">
    <div class="col">
    <h1>Lista de Cidades</h1>
    </div>
    <div class="col d-flex justify-content-end">
    <form action="{{ route('cidades.create') }}">
        <button type="submit" class="btn btn-primary btn-lg float-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
        </button>
    </form>
    </div>
</div>
<table class="table align-middle caption-top table-striped">
   <thead>
       <tr>
           <th>ID</th>
           <th>NOME</th>
           <th>PORTE</th>
           <th>EDITAR</th>
           <th>REMOVER</th>
       </tr>
   </thead>
   <tbody>
       <!-- Funcionalidade Blade / Laço Repetição -->
       <!-- Percorre o array cidades enviado pela Controller -->
       @foreach ($cidades as $item)
           <tr>
               <!-- Acessa os campos de cada item do array -->
               <td>{{ $item['id'] }}</td>
               <td>{{ $item['nome'] }}</td>
               <td>{{ $item['porte'] }}</td>
               <td>
                    <form action="{{ route('cidades.edit', $item['id']) }}">
                        <button type='submit' class='btn btn-success'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </button>
                    </form> 
                </td>
               <td>
                   <form action="{{ route('cidades.destroy', $item['id']) }}" method="POST">
                      <button type='submit' class='btn btn-danger'>
                        @csrf
                        @method('DELETE')
                        <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='#FFF' class='bi bi-trash-fill' viewBox='0 0 16 16'>
							<path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
						</svg>
                      </button>
                   </form>
               </td>
           </tr>
       @endforeach
   </tbody>
</table>