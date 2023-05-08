@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h4>Datos del alumno</h4>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('alumno.edit', ['alumno' => $alumno->id]) }}" class="btn btn-primary">Editar</a>
                        </div>
                    </div>
                    <form action="">
                        <div class="form-row">
                            <label for="inputNombre">Código</label>
                            <input disabled type="text" class="form-control" value="{{ $alumno->id }}">
                        </div>
                        <div class="form-row">
                            <label for="inputNombre">Nombre Completo</label>
                            <input disabled type="text" class="form-control" value="{{ $alumno->nombre }}">
                        </div>
                        <div class="form-row">
                            <label for="inputNombre">Documento de identidad y/o Carnet de extranjería</label>
                            <input disabled type="text" class="form-control" value="{{ $alumno->dni }}">
                        </div>
                    </form>
                </div>
                <div class="col">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="text-end row">
                        <div class="col">
                            <form action="" method="get">
                                @csrf
                                <div class="row justify-content-start">

                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Buscar" />
                                    </div>
                                    <div class="col-md-4 text-start">
                                        <button class="btn btn-light" type="submit"> Buscar </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-secondary"
                                href="{{ route('certificado.create', ['alumno' => $alumno->id]) }}">+
                                nuevo certificado</a>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Alumno</th>
                                    <th scope="col">Curso o Diplomado</th>
                                    <th scope="col">Documento PDF</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($alumno->certificados as $key=> $certificado)
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td>{{ $certificado->id }}</td>
                                        <td>{{ $alumno->nombre }}</td>
                                        <td>{{ $certificado->nombre }}</td>
                                        <td>
                                            <a href="{{ asset('public/' . $certificado->file) }}" target="_blank"
                                                class="btn btn-light shadow-sm"> Ver </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('certificado.edit', ['certificado' => $certificado->id, 'alumno' => $alumno->id]) }}"
                                                class="btn btn-outline-secondary">Editar</a>
                                            <button class="btn btn-outline-danger btn-delete-cert" 
                                            data-id="{{$certificado->id}}"
                                            >Eliminar</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">El alumno no tiene ningun documento registrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>




        </div>
    </section>

    <div class="modal" id="modalDelete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">¿Está seguro de eliminar el registro?</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Eliminar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
@endsection
