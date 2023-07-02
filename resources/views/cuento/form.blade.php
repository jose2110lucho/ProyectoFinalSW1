<div class="box box-info padding-1">
    <div class="box-body">
        <div class="card-header card-header-rose">
            <h4 class="card-title">Formulario de Edición</h4>
        </div>
        {{--Fecha--}}
        <div class="row">
            <label for="fecha" class="col-sm-2 col-form-label"> Fecha </label>
            <div class="col-sm-7">
                <input type="date" class="form-control" name="fecha" value="{{ old('fecha',$cuento->fecha) }}">
                @if ($errors->has('fecha'))
                <span class="error text-danger" for="input-fecha">
                    {{ $errors->first('fecha') }}
                </span>
                @endif
            </div>
        </div>
        {{--Titulo--}}
        <div class="row">
            <label for="titulo" class="col-sm-2 col-form-label"> TÍtulo </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="titulo" value="{{ old('titulo',$cuento->titulo) }}" autofocus>
                @if ($errors->has('titulo'))
                <span class="error text-danger" for="input-titulo">
                    {{ $errors->first('titulo') }}
                </span>
                @endif
            </div>
        </div>
        
        <!--  <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::text('fecha', $cuento->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>  -->
        
        <!-- <div class="form-group">
            {{ Form::label('titulo') }}
            {{ Form::text('titulo', $cuento->titulo, ['class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Titulo']) }}
            {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
        </div> -->

    </div>

    <div class="box-footer mt20">

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>