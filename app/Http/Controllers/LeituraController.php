<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leitura;
use App\Models\Mac;
use App\Models\Sensor;

class LeituraController extends Controller
{
    function index()
    {
        $leitura = Leitura::All();
        // dd($produto);


        return view('LeituraList')->with(['leituras' => $leitura]);
    }

    function create()
{
    $_macs_bejo = Mac::orderBy('Nome')->get();
    $_sensors_bejo = Sensor::orderBy('Nome')->get();


    //dd($_sensors_bejo);
    return view('LeituraForm')->with([
        '_macs_bejo' => $_macs_bejo,
        '_sensors_bejo' => $_sensors_bejo,
    ]);
}


    function store(Request $request)
    {
        $request->validate(
            [
                'DataLeitura' => 'required',
                'HoraLeitura' => 'required | max: 500',
                '_mac_bejo_id' => ' nullable',
                '_sensor_bejo_id' => ' nullable',
            ],
            [
                'DataLeitura.required' => 'A data é obrigatória',
                'HoraLeitura.required' => 'O preco é obrigatório',
                'HoraLeitura.max' => 'Só é permitido 500 caracteres',
            ]
        );

        //dd( $request->nome);
        Leitura::create([
            'DataLeitura' => $request->DataLeitura,
            'HoraLeitura' => $request->HoraLeitura,
            '_mac_bejo_id' => $request->_mac_bejo_id,
            '_sensor_bejo_id' => $request->_sensor_bejo_id,
        ]);

        return \redirect()->action(
            'App\Http\Controllers\LeituraController@index'
        );
    }

    function edit($id)
    {
        //select * from usuario where id = $id;
        $leitura = Leitura::findOrFail($id);
        //dd($usuario);
        $_sensors_bejo = Sensor::orderBy('_sensor_id')->get();

        $_macs_bejo = Mac::orderBy('_mac_id')->get();

        return view('LeituraForm')->with([
            'leitura' => $leitura,
            '_macs_bejo' => $_macs_bejo,
            '_sensors_bejo' => $_sensors_bejo,
        ]);
    }

    function show($id)
    {
        //select * from usuario where id = $id;
        $leitura = Leitura::findOrFail($id);
        //dd($usuario);
        $_sensors_bejo = Sensor::orderBy('_sensor_id')->get();

        $_macs_bejo = Mac::orderBy('_mac_id')->get();

        return view('LeituraForm')->with([
            'leitura' => $leitura,
            '_macs_bejo' => $_macs_bejo,
            '_sensors_bejo' => $_sensors_bejo,
        ]);
    }

    function update(Request $request)
    {
        //dd( $request->nome);
        $request->validate(
            [
                'DataLeitura' => 'required',
                'HoraLeitura' => 'required | max: 500',
                '_mac_bejo_id' => ' nullable',
                '_sensor_bejo_id' => ' nullable',
            ],
            [
                'DataLeitura.required' => 'A data é obrigatória',
                'HoraLeitura.required' => 'O preco é obrigatório',
                'HoraLeitura.max' => 'Só é permitido 500 caracteres',
            ]
        );


            Leitura::updateOrCreate(
            ['id' => $request->id],
            [

                'DataLeitura' => $request->DataLeitura,
                'HoraLeitura' => $request->HoraLeitura,
                '_mac_bejo_id' => $request->_mac_bejo_id,
                '_sensor_bejo_id' => $_sensor_bejo_id,
            ]
        );

        return \redirect()->action(
            'App\Http\Controllers\LeituraController@index'
        );
    }
    //

    function destroy($id)
    {
        $leitura = leitura::findOrFail($id);

        $leitura->delete();

        return \redirect()->action(
            'App\Http\Controllers\LeituraController@index'
        );
    }

    function search(Request $request)
    {
        if ($request->campo == 'nome') {
            $leitura = Leitura::where(
                'nome',
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $leituras = Leitura::all();
        }

        //dd($usuarios);
        return view('LeituraList')->with(['leitura' => $leituras]);
    }
}
// npm install --save-dev vite laravel-vite-plugin
// npm install --save-dev @vitejs/plugin-vue
// npm run build
