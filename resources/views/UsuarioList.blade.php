@extends('base.app')
@section('conteudo')
@section('tituloPagina', 'Usuario Formulário')


<form action="{{ route('usuario.search') }}" method="post" style="margin-right:150px;">
@csrf
<div class="col" >
    <div class="row">
        <div class="col-12"  style="text-align: center">
            <h1>Listagem de usuario</h1><br>
            <div class="search">
                <form action="UsuarioList.php" method="post">
                    <select name="campo">
                        <option value="id">Id</option>
                        <option value="nome">Nome</option>
                    </select>
                    <input type="text" name="valor" />
                    <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                    <a class="btn btn-success" href='{{ action('App\Http\Controllers\UsuarioController@create') }}'><i
                            class="fa-solid fa-plus"></i> Cadastrar</a>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div>
            <table style="margin-left:100px;">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>


                    @foreach ($usuarios as $item)
                    @php
                        $nome_imagem = !empty($item->imagem) ? $item->imagem : 'sem_imagem.jpg';
                    @endphp
                    <tr>
                        <td scope='row'>{{ $item->id }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->telefone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->categoria->nome ?? ''}}</td>
                        <td><a href="{{ action('App\Http\Controllers\UsuarioController@edit', $item->id) }}"><i
                                    class='fa-solid fa-pen-to-square' style='color:orange;'></i></a></td>
                        <td>
                            <form method="POST"
                                action="{{ action('App\Http\Controllers\UsuarioController@destroy', $item->id) }}">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <button type="submit" onclick='return confirm("Deseja Excluir?")'
                                    style='all: unset;'><i class='fa-solid fa-trash' style='color:red;'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>
</form>

@endsection
