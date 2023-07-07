<?php

namespace App\Http\Controllers;

use App\Models\Cuento;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Orhanerday\OpenAi\OpenAi;

class PaginaController extends Controller
{
 
    public function index($id)
    {
        $cuento = Cuento::find($id);
        $paginas = Pagina::where('cuento_id', $id)->paginate();
    
        return view('pagina.index', compact('paginas', 'id','cuento'))
            ->with('i', (request()->input('page', 1) - 1) * $paginas->perPage());
    }
    


    public function create($id)
    {
        $pagina = new Pagina();
        return view('pagina.create', compact('pagina', 'id'));
    }

   
    public function store(Request $request, $id)
    {

        $request->validate([
            'text' => 'required|string',
            'numeracion' => 'required|integer',
            'imageUrl' => 'required|url'
        ]);

        $selectedImageUrl = $request->imageUrl;

        // Download the image from the URL and store it locally
        $imageContents = file_get_contents($selectedImageUrl);
        $imageName = 'imageUrl_' . time() . '.jpg'; // Generate a unique image name
        Storage::disk('public')->put($imageName, $imageContents);
    
        // Access the stored image URL
        $imagePath = asset('storage/' . $imageName);
    
        /*$pagina = new Pagina();
        $pagina->id = $request->numeracion;
        $pagina->text = $request->text;
        $pagina->cuento_id = $id;
        
        $pagina->save();*/

        return redirect()->route('pagina.index', ['id' => $id])
            ->with('success', 'Pagina created successfully.');
    }


    public function show($id,$cuento_id)
    {
        $cuento = Cuento::find($cuento_id);
        $query = Pagina::where('id', $id)->where('cuento_id', $cuento_id)->get();
        $pagina = $query[0];

        return view('pagina.show', compact('pagina','cuento'));
    }

    
    public function edit($id,$cuento_id)
    {
        $query = Pagina::where('id', $id)->where('cuento_id', $cuento_id)->get();
        $pagina = $query[0];
        return view('pagina.edit', compact('pagina'));
    }

    
    public function update(Request $request, $id, $cuento_id)
    {
        
        $request->validate([
            'text' => 'required|string',
        ]);

        DB::table('pagina')
        ->where('id', $id)
        ->where('cuento_id',  $cuento_id)
        ->update(['text' => $request->text]);
    
        return redirect()->route('pagina.index', ['id' => $cuento_id])
            ->with('success', 'Pagina updated successfully');
    }

    public function destroy($id,$cuento_id)
    {

        $resultado = Pagina::where('id', $id)->where('cuento_id', $cuento_id);

        $resultado->delete();
    
        return redirect()->route('pagina.index', ['id' => $cuento_id])
            ->with('success', 'Pagina deleted successfully.');
    }

    public function generar($id,$prompt)
    {
        $open_ai_key = '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';

        $open_ai = new OpenAi($open_ai_key);

        $images = $open_ai->image(
            [
                "prompt" => $prompt,
                "n" => 2,
                "size" => "512x512",
             ]
        );
        $responseData = json_decode($images, true);
        $urls = [];
        foreach ($responseData['data'] as $item) {
            $urls[] = $item['url'];
        }

        return response()->json([
            'images' => $urls
        ]);
    }

    public function guardarImagen(Request $request, $id)
    {
        $imageUrl = $request->input('selectedImage');
        $fileName = uniqid('image_') . '.jpg';

        // Guarda la imagen en el almacenamiento (storage) de Laravel
        Storage::put($fileName, file_get_contents($imageUrl));

        // Aquí puedes guardar el enlace de la imagen en la base de datos
        // Utiliza tu lógica para almacenar la URL de la imagen en la base de datos

        return 'hi';
    }


}
