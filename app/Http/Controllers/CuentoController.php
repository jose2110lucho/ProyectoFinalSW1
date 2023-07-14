<?php

namespace App\Http\Controllers;

use App\Models\Cuento;
use App\Models\Genero;
use App\Models\Pagina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

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
        $paginas = Pagina::where('cuento_id', $id)->paginate();;
        //dd($paginas);
        return view('cuento.show', compact('cuento','paginas'));
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
        
        $cuento->delete();
        return redirect()->route('cuento.index')
            ->with('success', 'Cuento eliminado');
    }

    public function descargar($id)
    {
        $cuento = Cuento::find($id);
        $usuario = User::find($cuento->user_id);
        $paginas = Pagina::where('cuento_id', $id)->paginate();;
        

        //Crea Instancia de Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnable', true); // Enable fetching remote images
        $dompdf = new Dompdf($options);
    
        // Load HTML content for the PDF
        $html = '<html><body>';
    
        // Loop through the paginas and add the information to the PDF
        foreach ($paginas as $pagina) {
            $html .= '<div><strong>Pagina:</strong> ' . $pagina->id . '</div>';
            $html .= '<div><strong>Text:</strong> ' . $pagina->text . '</div>';
            $html .= '<div><img src="' . $pagina->url . '" alt="Image"></div>';
            $html .= '<div><strong>Descripcion:</strong> ' . $pagina->descripcion . '</div>';
    
            // Add some space between each pagina
            $html .= '<br>';
        }
    
        $html .= '</body></html>';
    
        // Load HTML into Dompdf
        $dompdf->loadHtml($html);
    
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
    
        // Render the PDF
        $dompdf->render();
    
        // Output the PDF as a download
        $dompdf->stream('paginas.pdf');

        //return view('cuento.show', compact('cuento','paginas'));
    }
}
