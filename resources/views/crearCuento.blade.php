
@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

<div class="card text-center">
    <div class="card-header">
        <h1 style="font-weight: bolder"> Titulo del cuento</h1>
    </div>

    

    <div class="container">
        <div class="row">
          <div class="col-sm">
            {{--  columna 1 --}}
          </div>
          <div class="col-sm">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="col-sm">
            {{-- columna 3 --}}
          </div>
        </div>
      </div>
    

      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
          Genero
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Terror</a>
          <a class="dropdown-item" href="#">Drama</a>
          <a class="dropdown-item" href="#">Infantil</a>
          <a class="dropdown-item" href="#">Fantasia</a>
        </div>
      </div>



    <div class="center" style="text-align: center; margin-top:20px;">
        <button  class="btn btn-success" onclick="confirmarHorario()">
            <img src="{{ asset('img/crear_cuento1.jpg') }}" alt="Imagen"> 
        </button>
    </div>

</div>



@stop