<?php

namespace App\Http\Controllers;

use App\Models\Cuento;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuentoController extends Controller
{
   
    public function index()
    {
        $cuentos = Auth::user()->miscuentos()->paginate(10);
        
        return view('cuento.index', compact('cuentos'))
            ->with('i', (request()->input('page', 1) - 1) * $cuentos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generos = Genero::all();
        return view('cuento.create', compact('generos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'fecha' => ['required'],
            'genero_id' => ['required']
        ]);

        $cuento  = new Cuento();

        $cuento->titulo = $request->titulo;
        $cuento->fecha = $request->fecha;
        $cuento->genero_id = $request->genero_id;
        $cuento->user_id = Auth::user()->id;
        
        $cuento->save();

        return redirect()->route('cuento.index')
            ->with('success', 'Una nueva historia nacio Vuela');
    }


    public function show($id)
    {
        $cuento = Cuento::find($id);

        return view('cuento.show', compact('cuento'));
    }

    public function edit($id)
    {
        $cuento = Cuento::find($id);
        $generos = Genero::all();
        return view('cuento.edit', compact('cuento','generos'));
    }

    public function update(Request $request, Cuento $cuento)
    {
        $request->validate([
            'titulo' => 'required|string',
            'genero_id' => ['required']
        ]);

        $cuento->titulo = $request->titulo;
        $cuento->genero_id = $request->genero_id;
      
        $cuento->update();

        return redirect()->route('cuento.index')
            ->with('success', 'Cuento actualizado');
    }


    public function destroy($id)
    {
        $cuento = Cuento::find($id);
        dd($cuento);
        $cuento->delete();
        return redirect()->route('cuento.index')
            ->with('success', 'Cuento eliminado');
    }
}
