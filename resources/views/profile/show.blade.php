@extends('adminlte::page')

@section('content')
    <h1>Perfil de usuario</h1>
    <p>Nombre: {{ $user->name }}</p>
    <p>NombreUser: {{ $user->name_user }}</p>
    <p>Email: {{ $user->email }}</p>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Editar</a>

    <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">Eliminar</button>
    </form>
@endsection
