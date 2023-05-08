@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            @if (session('status'))
                <div class="alert alert-{{ session('status') }}" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <h1>Editar alumno "{{ $alumno->nombre }}"</h1>
            <form method="post" action="{{ route('alumno.update', ['alumno' => $alumno]) }}">
                @csrf
                @method('put')
                <div class="row py-2">
                    <div class="form-group">
                        <label for="inputId">ID de alumno</label>
                        <input type="text" readonly class="form-control" name="id" id="inputId"
                            value="{{ $alumno->id }}">

                    </div>
                </div>
                <div class="row py-2">
                    <div class="form-group col">
                        <label for="inputName">Nombre completo</label>
                        <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }} "
                            id="inputName" name="nombre" placeholder="Nombre completo" required
                            value="{{ $alumno->nombre }}">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col">
                        <label for="inputDni">Dni</label>
                        <input type="text" class="form-control {{ $errors->has('dni') ? 'is-invalid' : '' }} "
                            id="inputDni" name="dni" placeholder="Dni" required value="{{ $alumno->dni }}">
                        @if ($errors->has('dni'))
                            <div class="invalid-feedback">
                                {{ $errors->first('dni') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row py-2">
                    <div class="form-group col">
                        <label for="inputCreateAt">Fecha de registro</label>
                        <input type="text" readonly class="form-control" name="create_at" id="inputCreateAt"
                            value="{{ $alumno->created_at }}">
                    </div>
                    <div class="form-group col">
                        <label for="inputUpdateAt">Fecha de modificación</label>
                        <input type="text" readonly class="form-control" name="update_at" id="inputUpdateAt"
                            value="{{ $alumno->updated_at }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group py-2">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('alumno.show',['alumno'=>$alumno->id]) }}" class="btn btn-dark">Cancelar</a>
                        
                    </div>

                </div>
            </form>
        </div>
    </section>
@endsection
