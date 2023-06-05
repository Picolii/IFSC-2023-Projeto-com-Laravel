<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Models\Categoria;

class FornecedorController extends Controller
{
    function index()
    {
        $fornecedor = Fornecedor::All();
        // dd($produto);

        return view('FornecedorList')->with(['fornecedores' => $fornecedor]);
    }

    function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('FornecedorForm')->with(['categorias' => $categorias]);
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required | max: 100',
                'contato' => 'required | max: 500',
                'assunto' => 'required | max: 1000',
                'data' => 'required',
            ],
            [
                'nome.required' => 'O nome é obrigatório',
                'nome.max' => 'Só é permitido 120 caracteres',
                'contato.required' => 'O preco é obrigatório',
                'contato.max' => 'Só é permitido 500 caracteres',
                'assunto.required' => 'O assunto é obrigatório',
                'assunto.max' => 'Só é permitido 1000 caracteres',
                'data.required' => 'A data é obrigatória',
            ]
        );

        //dd( $request->nome);
        Fornecedor::create([
            'nome' => $request->nome,
            'contato' => $request->contato,
            'assunto' => $request->assunto,
            'data' => $request->data,
            'categoria_id' => $request->categoria_id,
        ]);

        return \redirect()->action(
            'App\Http\Controllers\FornecedorController@index'
        );
    }

    function edit($id)
    {
        //select * from usuario where id = $id;
        $fornecedor = Fornecedor::findOrFail($id);
        //dd($usuario);
        $categorias = Categoria::orderBy('nome')->get();

        return view('FornecedorForm')->with([
            'fornecedor' => $fornecedor,
            'categorias' => $categorias,
        ]);
    }

    function show($id)
    {
        //select * from usuario where id = $id;
        $fornecedor = Fornecedor::findOrFail($id);
        //dd($usuario);
        $categorias = Categoria::orderBy('nome')->get();

        return view('FornecedorForm')->with([
            'fornecedor' => $fornecedor,
            'categorias' => $categorias,
        ]);
    }

    function update(Request $request)
    {
        //dd( $request->nome);
        $request->validate(
            [
                'nome' => 'required | max: 100',
                'contato' => 'required | max: 500',
                'assunto' => 'required | max: 1000',
                'data' => 'required',
                'categoria_id' => ' nullable',
            ],
            [

                'nome.required' => 'O nome é obrigatório',
                'nome.max' => 'Só é permitido 120 caracteres',
                'contato.required' => 'O preco é obrigatório',
                'contato.max' => 'Só é permitido 500 caracteres',
                'assunto.required' => 'O assunto é obrigatório',
                'assunto.max' => 'Só é permitido 1000 caracteres',
                'data.required' => 'A data é obrigatória',
            ]
        );


            Fornecedor::updateOrCreate(
            ['id' => $request->id],
            [

                'nome' => $request->nome,
                'contato' => $request->contato,
                'assunto' => $request->assunto,
                'data' => $request->data,
            ]
        );

        return \redirect()->action(
            'App\Http\Controllers\FornecedorController@index'
        );
    }
    //

    function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->delete();

        return \redirect()->action(
            'App\Http\Controllers\FornecedorController@index'
        );
    }

    function search(Request $request)
    {
        if ($request->campo == 'nome') {
            $fornecedores = Fornecedor::where(
                'nome',
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $fornecedores = Fornecedor::all();
        }

        //dd($usuarios);
        return view('FornecedorList')->with(['fornecedor' => $fornecedores]);
    }
}
// npm install --save-dev vite laravel-vite-plugin
// npm install --save-dev @vitejs/plugin-vue
// npm run build
