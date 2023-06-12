@extends('layouts.app')

@section('template_title')
    {{ $pagina->name ?? "{{ __('Show') Pagina" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pagina</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('paginas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Text:</strong>
                            {{ $pagina->text }}
                        </div>
                        <div class="form-group">
                            <strong>Numeracion:</strong>
                            {{ $pagina->numeracion }}
                        </div>
                        <div class="form-group">
                            <strong>Cuento Id:</strong>
                            {{ $pagina->cuento_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
