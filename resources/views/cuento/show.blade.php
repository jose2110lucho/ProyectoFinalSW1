@extends('layouts.app')

@section('template_title')
    {{ $cuento->name ?? "{{ __('Show') Cuento" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Cuento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cuentos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>
                    @foreach ($cuentos as $cuento)
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $cuento->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Titulo:</strong>
                            {{ $cuento->titulo }}
                        </div>

                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>
@endsection
