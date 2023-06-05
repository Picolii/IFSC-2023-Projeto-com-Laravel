@extends('base.app')
@section('conteudo')
@section('tituloPagina', 'Leitura Formulário')


<form action="{{ route('leitura.search') }}" method="post" style="margin-right:150px;">
@csrf
<div class="col" >
    <div class="row">
        <div class="col-12"  style="text-align: center">
            <h1>Listagem de leitura</h1><br>
            <div class="search">
                <form action="UsuarioList.php" method="post">
                    <select name="campo">
                        <option value="id">Id</option>
                    </select>
                    <input type="text" name="valor" />
                    <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                    <a class="btn btn-success" href='{{ action('App\Http\Controllers\LeituraController@create') }}'><i
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
                        <th scope="col">Data da Leitura</th>
                        <th scope="col">Hora da Leitura</th>
                        <th scope="col">ID Mac</th>
                        <th scope="col">ID Sensor</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>


                    @foreach ($leituras as $item)

                    <tr>
                        <td scope='row'>{{ $item->id }}</td>
                        <td>{{ $item->DataLeitura }}</td>
                        <td>{{ $item->HoraLeitura }}</td>
                        <td>{{ $item->_mac_bejo->Nome ?? ''}}</td>
                        <td>{{ $item->_sensor_bejo->Nome ?? ''}}</td>
                        <td><a href="{{ action('App\Http\Controllers\LeituraController@edit', $item->id) }}"><i
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
