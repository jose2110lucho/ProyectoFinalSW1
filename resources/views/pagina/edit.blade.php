@extends('adminlte::page')

@section('template_title')
    {{ __('Editar') }} Pagina 
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-left " >
                            <span class="card-title">{{ __('Escribir') }} Nueva Pagina</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pagina.index', ['id' => $pagina->cuento_id]) }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="{{ route('pagina.update', [$pagina->id, $pagina->cuento_id]) }}" role="form" enctype="multipart/form-data">

                            {{ method_field('PATCH') }}
                            @csrf
                            
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="row">
                                        {{--Edita el texto de la pagina--}}
                                        <label for="text" class="col-sm-2 col-form-label"> Texto </label>
                                        <textarea type="text" id="text" class="form-control" style="height: 300px;"  name="text">{{ $pagina->text }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    {{--Edita el texto de la pagina--}}
                                    <div id="imagen" style="display: flex; justify-content: center; align-items: center; border: 1px solid grey; margin: 10px auto;" name="imagen" ></div>
                                    <input type="hidden" name="imageUrl" id="imageUrl" value="{{ $pagina->url }}">
                                    <input type="hidden" name="descripcion" id="descripcion" value="{{ $pagina->descripcion }}">
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
                        <input type="text" name="id" id="id" value="{{$pagina->cuento_id}}" hidden>
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
        const imageUrl = document.getElementById('imageUrl').value;
       
        const id = document.getElementById('id').value;


        console.log(imageUrl);

        const defaultImgElement = document.createElement('img');
        defaultImgElement.src = imageUrl;
        defaultImgElement.alt = 'Default Image';

        firstFormImagesContainer.innerHTML = '';
        firstFormImagesContainer.appendChild(defaultImgElement);


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
