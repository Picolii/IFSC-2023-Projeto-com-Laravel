<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    function index()
    {
        $produto = Produto::All();
        // dd($produto);

        return view('ProdutoList')->with(['produtos' => $produto]);
    }

    function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('ProdutoForm')->with(['categorias' => $categorias]);
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required | max: 100',
                'preco' => 'required | max: 100',
                'descricao' => 'required | max: 100',
                'tamanho' => 'required | max: 100',
                'quantidade' => ' required | max: 100',
                'categoria_id' => ' nullable',
                'imagem' => ' nullable|image|mimes:jpeg,jpg,png|max:2048',
            ],
            [
                'nome.required' => 'O nome é obrigatório',
                'nome.max' => 'Só é permitido 120 caracteres',
                'preco.required' => 'O preco é obrigatório',
                'preco.max' => 'Só é permitido 100 caracteres',
                'descricao.required' => 'O descricao é obrigatório',
                'descricao.max' => 'Só é permitido 100 caracteres',
                'quantidade.required' => 'O quantidade é obrigatório',
                'quantidade.max' => 'Só é permitido 100 caracteres',
                'tamanho.required' => 'O tamanho é obrigatório',
                'tamanho.max' => 'Só é permitido 100 caracteres',
            ]
        );

        $dados = [
            'nome' => $request->nome,
            'preco' => $request->preco,
            'tamanho' => $request->tamanho,
            'quantidade' => $request->quantidade,
            'descricao' => $request->descricao,
            'categoria_id' => $request->categoria_id,
        ];

        $imagem = $request->file('imagem');
        $nome_arquivo = '';
        if ($imagem) {
            $nome_arquivo =
                date('YmdHis') . '.' . $imagem->getClientOriginalExtension();

            $diretorio = 'imagem/';
            $imagem->storeAs($diretorio, $nome_arquivo, 'public');
            $dados['imagem'] = $diretorio . $nome_arquivo;
        }

        //dd( $request->nome);
        Produto::create($dados);

        return \redirect()->action(
            'App\Http\Controllers\ProdutoController@index'
        );
    }

    function edit($id)
    {
        //select * from usuario where id = $id;
        $produto = Produto::findOrFail($id);
        //dd($usuario);
        $categorias = Categoria::orderBy('nome')->get();

        return view('ProdutoForm')->with([
            'produto' => $produto,
            'categorias' => $categorias,
        ]);
    }

    function show($id)
    {
        //select * from usuario where id = $id;
        $produto = Produto::findOrFail($id);
        //dd($usuario);
        $categorias = Categoria::orderBy('nome')->get();

        return view('ProdutoForm')->with([
            'produto' => $produto,
            'categorias' => $categorias,
        ]);
    }

    function update(Request $request)
    {
        //dd( $request->nome);
        $request->validate(
            [
                'nome' => 'required | max: 100',
                'preco' => 'required | max: 100',
                'descricao' => 'required | max: 100',
                'tamanho' => 'required | max: 100',
                'quantidade' => ' required | max: 100',
                'categoria_id' => ' nullable',
                'imagem' => ' nullable|image|mimes:jpeg,jpg,png|max:2048',
            ],
            [

                'nome.required' => 'O nome é obrigatório',
                'nome.max' => 'Só é permitido 120 caracteres',
                'preco.required' => 'O preco é obrigatório',
                'preco.max' => 'Só é permitido 100 caracteres',
                'descricao.required' => 'O descricao é obrigatório',
                'descricao.max' => 'Só é permitido 100 caracteres',
                'quantidade.required' => 'O quantidade é obrigatório',
                'quantidade.max' => 'Só é permitido 100 caracteres',
                'tamanho.required' => 'O tamanho é obrigatório',
                'tamanho.max' => 'Só é permitido 100 caracteres',
            ]
        );
        $dados = [
            'nome' => $request->nome,
            'preco' => $request->preco,
            'tamanho' => $request->tamanho,
            'quantidade' => $request->quantidade,
            'descricao' => $request->descricao,
            'categoria_id' => $request->categoria_id,
        ];

        $imagem = $request->file('imagem');
        $nome_arquivo = '';
        if ($imagem) {
            $nome_arquivo =
                date('YmdHis') . '.' . $imagem->getClientOriginalExtension();

            $diretorio = 'imagem/';
            $imagem->storeAs($diretorio, $nome_arquivo, 'public');
            $dados['imagem'] = $diretorio . $nome_arquivo;
        }

        Usuario::updateOrCreate(
            ['id' => $request->id],
            $dados
        );

        return \redirect()->action(
            'App\Http\Controllers\ProdutoController@index'
        );
    }
    //

    function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        $produto->delete();

        return \redirect()->action(
            'App\Http\Controllers\ProdutoController@index'
        );
    }

    function search(Request $request)
    {
        if ($request->campo == 'nome') {
            $produtos = Produto::where(
                'nome',
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $produtos = Produto::all();
        }

        //dd($usuarios);
        return view('ProdutoList')->with(['produtos' => $produtos]);
    }
}
// npm install --save-dev vite laravel-vite-plugin
// npm install --save-dev @vitejs/plugin-vue
// npm run build
