@extends('adminlte::page')

@section('title', 'Dashboard')
@section('template_title')
Pagina
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card text-center">
                        <P></P>
                        <h6 class="card-title">{{ $cuento->titulo }}</h6>
                        <P></P>
                    </div>
           

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        

                        <div class="float-left">
                            
                            <a href="{{ route('paginas.create', ['id' => $id]) }}" class="btn  btn-sm float-right shadow sm" style="background-color: #12CB55; width:300px"
                                data-placement="left">
                                {{ __('Crear Pagina') }}
                            </a>
                            
                        </div>
                    
                    <a class="float-right" href="{{ route('home') }}" type="buttom" >
                    <div class=float-right>
                        <img width="60" height="60" src="https://img.icons8.com/external-vitaliy-gorbachev-lineal-color-vitaly-gorbachev/60/external-mountain-landscape-vitaliy-gorbachev-lineal-color-vitaly-gorbachev.png" alt="external-mountain-landscape-vitaliy-gorbachev-lineal-color-vitaly-gorbachev"/>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" >
    +</span>
                        <img width="64" height="64" src="https://img.icons8.com/cute-clipart/64/standing-man.png" alt="standing-man"/>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    +</span>
                    </div>
    </a>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Fecha</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                    <th>Pagina</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> </th>
                                    <th>Eliminar</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-secondary table-hover">
                            <tbody>
                                @foreach ($paginas as $pagina)
                                <tr>
                                    <!--  <td>{{ ++$i }}</td>-->
                                    <td>{{$pagina->created_at}}</td>

                                    <td>
                                        @csrf
                                        <a class="table" type="submit"
                                            href="{{ route('paginas.show',$pagina->id) }}">Pagina
                                            {{$pagina->numeracion}}</a>
                                    </td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <form action="{{ route('paginas.destroy',$pagina->id) }}" method="POST">


                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-success btn-sm float-none "><i
                                                    class="fa fa-fw fa-trash"></i></button>

                                        </form>
                                    </td>

                                    <td><a class="btn btn-dark btn-sm float-none"
                                            href="{{ route('paginas.edit',$pagina->id) }}"><i
                                                class="fa fa-fw fa-edit"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $paginas->links() !!}
        </div>
    </div>
</div>
@endsection