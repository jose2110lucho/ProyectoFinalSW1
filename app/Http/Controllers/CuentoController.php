<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Cuento;
use Illuminate\Http\Request;

/**
 * Class CuentoController
 * @package App\Http\Controllers
 */
class CuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentos = Cuento::paginate();

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
        $cuento = new Cuento();
        return view('cuento.create', compact('cuento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* request()->validate(Cuento::$rules);
        $cuento = Cuento::create($request->all());*/
        
         request()->validate([
            'fecha' => 'required',
            'titulo' => 'required',
        ]);
        $cuento  = new Cuento();
        $cuento->fecha = $request->fecha;
        $cuento->titulo = $request->titulo;
        

        return redirect()->route('cuentos.index')
            ->with('success', 'Cuento created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuento = Cuento::find($id);

        return view('cuento.show', compact('cuento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuento = Cuento::find($id);

        return view('cuento.edit', compact('cuento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cuento $cuento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuento $cuento)
    {
        request()->validate(Cuento::$rules);

        $cuento->update($request->all());

        return redirect()->route('cuentos.index')
            ->with('success', 'Cuento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cuento = Cuento::find($id)->delete();

        return redirect()->route('cuentos.index')
            ->with('success', 'Cuento deleted successfully');
    }
}
