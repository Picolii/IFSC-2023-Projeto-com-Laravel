@extends('base.app')
@section('conteudo')
@section('tituloPagina', 'Produto Formulário')

@php
    if (!empty($produto->id)) {
        $route = route('produto.update', $produto->id);
    } else {
        $route = route('produto.store');
    }
@endphp
<form action='{{ $route }}' method="POST" enctype="multipart/form-data">
    @csrf
    @if (!empty($produto->id))
        @method('PUT')
    @endif
    @php
        $nome_imagem = !empty($produto->imagem) ? $produto->imagem : 'sem_imagem.jpg';
    @endphp
    <br>
    <div class="col">
        <div class="row">
            <div class="col-6">
                <img class="" src="/storage/{{ $nome_imagem }}" style="margin-top: 44px; width:400px; height:400px;" /><br>
                <input type="file" class="imgadd" name="imagem"
                    style="margin-top: 50px; width: 471px; height: 50px; margin-left: -20px; margin-right: 204px;}" />
            </div>
            <div class="col-6">


                <div class="aside" style="margin-top: -100px">
                    <input type="hidden" name="id"
                        value="@if (!empty(old('id'))) {{ old('id') }} @elseif(!empty($produto->id)) {{ $produto->id }} @else {{ '' }} @endif" /><br>

                    <h4>Nome</h4>
                    <input type="text" class="editrs_input" name="nome" placeholder="Nome produto.."
                        value="@if (!empty(old('nome'))) {{ old('nome') }} @elseif(!empty($produto->nome)) {{ $produto->nome }} @else {{ '' }} @endif" /><br>

                    <h4>Preço</h4>
                    <input type="text" class="editrs_input" name="preco" placeholder="R$"
                        value="@if (!empty(old('nome'))) {{ old('nome') }} @elseif(!empty($produto->preco)) {{ $produto->preco }} @else {{ '' }} @endif" /><br>

                    <h4>Quantidade</h4>
                    <input type="text" class="editrs_input" name="quantidade"
                        value="@if (!empty(old('nome'))) {{ old('nome') }} @elseif(!empty($produto->quantidade)) {{ $produto->quantidade }} @else {{ '' }} @endif" /><br>

                    <h4>Adicionar Tamanho</h4>
                    <input type="text" class="editrs_input" name="tamanho" placeholder="P, M, G, GG"
                        value="@if (!empty(old('nome'))) {{ old('nome') }} @elseif(!empty($produto->tamanho)) {{ $produto->tamanho }} @else {{ '' }} @endif" /><br>


                    <h3>Descrição</h3>
                    <input type="text" class="editdesc_input" name="descricao" placeholder="Descrição..."
                        value="@if (!empty(old('nome'))) {{ old('nome') }} @elseif(!empty($produto->descricao)) {{ $produto->descricao }} @else {{ '' }} @endif" />
                    <br>
                    <br>
                    <button class="btn btn-success" type="submit">
                        <i class="fa-solid fa-save"></i> Salvar
                    </button>
                    <a href='{{ route('produto.index') }}' class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left"></i>
                        Voltar</a>

                </div>
            </div>
        </div>
    </div>




</form>
@endsection
