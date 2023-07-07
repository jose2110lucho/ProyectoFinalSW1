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
                        <span class="card-title">{{ __('Editar') }} Pagina {{ $pagina->id }}</span>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="{{ route('pagina.update', [$pagina->id, $pagina->cuento_id]) }}" role="form" enctype="multipart/form-data">

                            {{ method_field('PATCH') }}
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="row">
                                        <label for="text" class="col-sm-2 col-form-label"> Texto </label>
                                        <textarea type="text" id="text" class="form-control" style="height: 300px;"  name="text">{{ $pagina->text }}</textarea>
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
        </div>
    </section>
@endsection
