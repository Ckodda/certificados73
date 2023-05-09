@extends('layouts.app')
@section('content')
<section>
  <div class="container">
    @if (session('status'))
      <div class="alert alert-{{session('status')}}" role="alert">
          {{ session('message') }}
      </div>
    @endif
    <h1>Crear nuevo alumno</h1>
    <form method="post" action="{{route('alumno.store')}}" enctype="multipart/form-data">
      @csrf
      @method('post')
      <div class="row py-4">
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Crear</button>
          <a href="{{ route('home') }}" class="btn btn-dark">Cancelar</a>
        </div>
      </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="inputName">Nombre completo</label>
            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid':'' }}" id="inputName" name="nombre" placeholder="Nombre completo">
            @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
          </div>
          <div class="form-group col-md-6">
            <label for="inputDni">Dni</label>
            <input type="text" class="form-control {{ $errors->has('dni') ? 'is-invalid':''}} " id="inputDni" name="dni" placeholder="Dni">
            @if ($errors->has('dni'))
                        <div class="invalid-feedback">
                            {{ $errors->first('dni') }}
                        </div>
            @endif
          </div>
        </div>
        <hr>
        <div class="row py-2">
          <div class="form-group">
            <strong>Agregar certificado</strong>
            <button id="btnAddCertificado" class="btn btn-outline-primary" type="button">+</button>
          </div>
        </div>
        <hr>
        <div id="box-certificados">
          <div class="row py-2">
            <div class="form-group col">
              <label for="">Nombre de Curso o Diplomado</label>
              <input type="text" name="nombreCertificado[]" placeholder="Nombre de Curso o Diplomado" class="form-control" id="" value="">
            </div>
            <div class="form-group col">
              <label for="">Archivo PDF</label>
              <input type="file" name="file[]" placeholder="Suba un solo archivo" class="form-control" id="">
            </div>
            <div class="text-center col-md-2">
              <button type="button" class="btn btn-sm btn-outline-danger btnDeleteRowCert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
              </button>
            </div>
          </div>
        </div>
        
      </form>
  </div>
</section>
    
@endsection