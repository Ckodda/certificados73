@extends('layouts.app')
@section('content')
    <section>
        <div class="container">
            
            @if (session('status'))
                <div class="alert alert-{{ session('status') }}" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <h3>Editar Certificado para el alumno de ID: {{ $alumno->id }}</h3>
            <form method="post" enctype="multipart/form-data" action="{{ route('certificado.store') }}">
                @csrf
                @method('post')
                <div class="row py-2">
                    <div class="form-group col">
                        <label for="inputIdAlumno">Id Alumno</label>
                        <input type="text" class="form-control {{ $errors->has('alumno') ? 'is-invalid' : '' }} "  value="{{ $alumno->id }}" name="alumno" readonly id="alumno"/>
                        @if ($errors->has('alumno'))
                            <div class="invalid-feedback">
                                {{ $errors->first('alumno') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col">
                        <label for="inputAlumno">Alumno</label>
                        <input readonly type="text" id="inputAlumno" class="form-control"
                            value="{{ $alumno->nombre }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputName">Nombre de Curso o Diplomado</label>
                        <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid':'' }}" id="inputName" name="nombre" required value="{{ $certificado->nombre }}" />
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputFile">Subir nuevo PDF (Reemplazará el anterior)</label>
                        <input type="file" class="form-control {{ $errors->has('file') ? 'is-invalid':'' }}" id="inputFile" name="file" required
                            placeholder="Suba un solo archivo">
                        @if ($errors->has('file'))
                            <div class="invalid-feedback">
                                {{ $errors->first('file') }}
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group py-2">
                        <div><strong>Archivo actual</strong> <a href="{{ asset('public/'.$certificado->file) }}" class="btn btn-link" target="_blank" >Ver</a> </div>
                        <embed src="{{ asset('public/'.$certificado->file) }}" width="400px">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group py-2">
                        <button type="submit" class="btn btn-primary">Crear</button>
                        <a href="{{ route('alumno.show',['alumno'=>$alumno->id]) }}" class="btn btn-dark">Cancelar</a>
                        
                    </div>

                </div>
            </form>
        </div>
    </section>
@endsection
