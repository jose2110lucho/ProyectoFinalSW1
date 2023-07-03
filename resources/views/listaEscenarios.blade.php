@extends('adminlte::page')

@section('content_header')

@stop

@section('content')


<link rel="stylesheet" href="app.css">

<div class="card text-center">
    <div class="card-header" style="background-color: rgb(251, 208, 128)">
        <h1 style="font-weight: bolder">Lista de escenarios</h1>
    </div>

    <div class="center" style="text-align: right; margin-top:20px; margin-right: 50px">
        <button  id="btn-abrir-modal" class="btn btn-success">
            <img src="{{ asset('img/crear_escenario.png') }}" alt="Imagen" width="50px" height="50px">
        </button>
        <p><strong>Crear nuevo escenario</strong></p>
    </div>

    
    

</div>



<dialog id="modal" style="background-color: beige; width: 500px">
    <form method="dialog">
        <div class="form-group">
          <label for="formGroupExampleInput">nombre</label>
          <input type="text" class="form-control" id="formGroupExampleInput" placeholder="nombre del escenario">
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">descripcion</label>
          <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="descripcion del escenario">
        </div>
    </form>
    <button id="btn-cerrar-modal" type="submit" class="btn btn-primary">guardar</button>
    
</dialog>

<script>

   const btnAbrirModal = document.querySelector("#btn-abrir-modal");
   const btnCerrarModal = document.querySelector("#btn-cerrar-modal");
   const modal = document.querySelector("#modal");

   btnAbrirModal.addEventListener("click",()=>{
        modal.showModal();
   });

   btnCerrarModal.addEventListener("click",()=>{
        modal.close();
   });


</script>


@stop