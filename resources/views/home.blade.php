@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-{{session('status')}}" role="alert">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="row justify-content-center">

            <div class="col">

                <div class="table-responsive">
                    <h1>Alumnos</h1>
                    <div class="my-2">
                        <a href="{{ route('alumno.create') }}" class="btn btn-primary">
                            Crear nuevo alumno
                        </a>
                    </div>

                    <div class="text-secondary">Página {{ $alumnos->currentPage() }} de {{ $alumnos->lastPage() }}</div>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre de alumno</th>
                                <th scope="col">Dni</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alumnos as $key=>$alumno)
                                <tr >
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $alumno->id }}</td>
                                    <td>{{ $alumno->nombre }}</td>
                                    <td>{{ $alumno->dni }}</td>
                                    <td>
                                        <a href="{{ route('alumno.show',['alumno'=>$alumno->id]) }}" class="btn btn-secondary">
                                            Ver
                                        </a>
                                    </td>
                                </tr>   
                            @empty
                                <tr>
                                    <td colspan="4">No hay registros de alumnos</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $alumnos->links() !!}
                </div>

            </div>
        </div>
    </div>
@endsection
