<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Cuento;
use Illuminate\Http\Request;

/**
 * Class PaginaController
 * @package App\Http\Controllers
 */
class PaginaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $cuento = Cuento::find($id);
        $paginas = Pagina::where('cuento_id', $id)->paginate();
    
        return view('pagina.index', compact('paginas', 'id','cuento'))
            ->with('i', (request()->input('page', 1) - 1) * $paginas->perPage());
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create($id)
    {

        $pagina = new Pagina();
        return view('pagina.create', compact('pagina', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
{
    request()->validate(Pagina::$rules);

    $pagina = new Pagina();
    $pagina->cuento_id = $id;
    $pagina->fill($request->except('cuento_id'));
    $pagina->save();

    return redirect()->route('paginas.index', ['id' => $id])
        ->with('success', 'Pagina created successfully.');
}






    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagina = Pagina::find($id);

        return view('pagina.show', compact('pagina'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagina = Pagina::find($id);

        return view('pagina.edit', compact('pagina','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pagina $pagina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $cuento_id)
    {
        request()->validate(Pagina::$rules);
    
        $pagina = Pagina::find($id);
    
        if (!$pagina) {
            return redirect()->route('paginas.index')
                ->with('error', 'Pagina not found');
        }
    
        $pagina->update($request->all());
    
        return redirect()->route('paginas.index', ['id' => $cuento_id])
            ->with('success', 'Pagina updated successfully');
    }

    

    

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pagina = Pagina::find($id);
        $cuento_id = $pagina->cuento_id; // Guarda el valor antes de eliminar
    
        $pagina->delete();
    
        return redirect()->route('paginas.index', ['id' => $cuento_id])
            ->with('success', 'Pagina deleted successfully.');
    }
    
}
