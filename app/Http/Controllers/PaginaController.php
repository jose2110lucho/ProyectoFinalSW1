<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
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
    public function index()
    {
        $paginas = Pagina::paginate();

        return view('pagina.index', compact('paginas'))
            ->with('i', (request()->input('page', 1) - 1) * $paginas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagina = new Pagina();
        return view('pagina.create', compact('pagina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Pagina::$rules);

        $pagina = Pagina::create($request->all());

        return redirect()->route('paginas.index')
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

        return view('pagina.edit', compact('pagina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pagina $pagina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagina $pagina)
    {
        request()->validate(Pagina::$rules);

        $pagina->update($request->all());

        return redirect()->route('paginas.index')
            ->with('success', 'Pagina updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pagina = Pagina::find($id)->delete();

        return redirect()->route('paginas.index')
            ->with('success', 'Pagina deleted successfully');
    }
}
