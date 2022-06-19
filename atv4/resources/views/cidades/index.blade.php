<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<h1>Lista de Cidades</h1>
<a href="{{ route('cidades.create') }}"><h4>Nova Cidade</h4></a>
<table>
   <thead>
       <tr>
           <th>ID</th>
           <th>NOME</th>
           <th>PORTE</th>
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
               <td><a href="{{ route('cidades.edit', $item['id']) }}">editar</a></td>
               <td>
                   <form action="{{ route('cidades.destroy', $item['id']) }}" method="POST">
                       <!-- Token de Segurança -->
                       <!-- Define o método de submissão como delete -->
                       @csrf
                       @method('DELETE')
                       <input type='submit' value='remover'>
                   </form>
               </td>
           </tr>
       @endforeach
   </tbody>
</table>