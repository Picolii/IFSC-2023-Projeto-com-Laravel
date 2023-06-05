@extends('base.app')
@section('conteudo')
@section('tituloPagina', 'Fornecedor Formulário')

<form action="{{ route('fornecedor.search') }}" method="post" style="margin-right:150px;">
    @csrf
<div class="col">
    <div class="row">
        <div class="col-12"  style="text-align: center">
            <h1>Controle de Fornecedores</h1><br>
            <div class="search">
                <form action="FornecedorList.php" method="post">
                    <select name="campo">
                        <option value="id">Id</option>
                        <option value="nome">Nome</option>
                    </select>
                    <input type="text" name="valor" />
                    <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                    <a class="btn btn-success" href='{{ action('App\Http\Controllers\FornecedorController@create') }}'><i
                            class="fa-solid fa-plus"></i> Cadastrar</a>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div>
            <table style="margin-left:190px;">
                <tr >
                    <th>ID</th>
                        <th>Nome</th>
                        <th>Contato</th>
                        <th>Assunto</th>
                        <th>Data</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                </tr>


                @foreach ($fornecedores as $item)
                        <tr>
                            <td scope='row'>{{ $item->id }}</td>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->contato }}</td>
                            <td>{{ $item->assunto }}</td>
                            <td>{{ $item->data }}</td>


                            <td><a href="{{ action('App\Http\Controllers\FornecedorController@edit', $item->id) }}"><i
                                        class='fa-solid fa-pen-to-square' style='color:orange;'></i></a></td>
                            <td>
                                <form method="POST"
                                    action="{{ action('App\Http\Controllers\FornecedorController@destroy', $item->id) }}">
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
