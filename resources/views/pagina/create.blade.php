
@extends('adminlte::page')


@section('template_title')
    {{ __('Create') }} Pagina
@endsection

@section('content')
    
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Pagina</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pagina.store', ['id' => $id]) }}" role="form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="cuento_id" value="{{ $id }}"> <!-- Agregar un campo oculto para enviar el $id -->
                            
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    
                                    <div class="row">
                                        <label for="numeracion" class="col-sm-2 col-form-label"> Pagina </label>
                                        <input type="text" id="numeracion" class="form-control " style="width: 50px;" name="numeracion" required>
                                    </div>

                                    <div class="row">
                                        <label for="text" class="col-sm-2 col-form-label"> Texto </label>
                                        <textarea type="text" id="text" class="form-control" style="height: 300px;"  name="text"></textarea>
                                    </div>  
                                    <div class="row">
                                        <div id="imagen" style="display: flex; justify-content: center; align-items: center; border: 1px solid grey; margin: 10px auto;" name="imagen" ></div>
                                        <input type="hidden" name="imageUrl" id="imageUrl" value="">
                                        <input type="hidden" name="descripcion" id="descripcion" value="">
                                    </div>  
                                </div>
                                <div class="center" style="text-align: center; margin-top:20px;">
                                    <button  class="btn btn-success">
                                        <img src="{{ asset('img/crear_cuento1.jpg') }}" alt="Imagen"> 
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Generar') }} Imagen</span>
                    </div>
                    <div class="card-body">
                        <input type="text" name="id" id="id" value="{{$id}}" hidden>
                        <!-- Prompt input form -->
                        <form id="prompt-form">
                            <input type="text" name="prompt" id="prompt-input" placeholder="Ingrese descripcion">
                            <button type="submit">Generar</button>
                        </form>

                        <!-- Generated images -->
                        <div id="images-container" style="display: flex; margin: 10px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const promptForm = document.getElementById('prompt-form');
        const promptInput = document.getElementById('prompt-input');
        const imagesContainer = document.getElementById('images-container');
        const firstFormImagesContainer  = document.getElementById('imagen');


        const id = document.getElementById('id').value;

        promptForm.addEventListener('submit', async (event) => {
        event.preventDefault();

    const prompt = promptInput.value;

    try {
        const response = await axios.get(`/pagina/${id}/generar/${prompt}`);

        const images = response.data.images;
        console.log(images);
        imagesContainer.innerHTML = '';

        images.forEach(image => {
            const imgElement = document.createElement('img');
            imgElement.src = image;
            imgElement.alt = 'Generated Image';

            imgElement.addEventListener('click', () => {
                selectedImage = image;
                firstFormImagesContainer.innerHTML = '';

                const imgElement = document.createElement('img');
                imgElement.src = selectedImage;
                imgElement.alt = 'Selected Image';

                firstFormImagesContainer.appendChild(imgElement);

                document.getElementById('imageUrl').value = selectedImage;
            });
            document.getElementById('descripcion').value = promptInput.value;
            imagesContainer.appendChild(imgElement);
        });
    } catch (error) {
        console.error('Error:', error);
    }
});
    </script>
@endsection

