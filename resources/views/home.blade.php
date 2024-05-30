@extends('layouts.layout')

@section('title', 'Home')

@section('content')
@auth
  <!-- Barra de búsqueda de usuarios -->
  <div class="card mt-3 position-fixed" style="top: 10px; right: 10px;">
    <div class="card-header">Buscar usuario</div>
    <div class="card-body">
      <form action="{{ route('users.search') }}" method="GET">
        <div class="input-group">
          <input type="text" name="query" class="form-control" placeholder="Kratos...">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </form>
    </div>
  </div>

  <div class="bg-dark bg-opacity-75 p-3 rounded">
    <h2 class="text-white">Bienvenido a GameBase tu biblioteca de videojuegos.</h2>
</div>

  <form action="/logout" method="POST">
    @csrf
    <button class="btn btn-danger mt-3">Log out</button>
  </form>

  <!-- Creacion de nuevo post-->
  <div class="card mt-5">
    <div class="card-header">
      <h2>Añade un nuevo titulo</h2>
    </div>
    <div class="card-body">
      <form action="/create-post" method="POST">
        @csrf
        <div class="form-group mb-3">
          <label for="title">Titulo</label>
          <input type="text" name="title" class="form-control" placeholder="Escribe el titulo">
        </div>
        <div class="form-group mb-3">
          <label for="body">Resumen</label>
          <textarea name="body" class="form-control" placeholder="Contenido..."></textarea>
        </div>
        <div class="form-group mb-3">
          <label for="status">Estado</label>
          <select name="status" class="form-control">
            <option value="Completado">Completado</option>
            <option value="Drop">Drop</option>
            <option value="Platinado">Platinado</option>
            <option value="On-Hold">On-Hold</option>
          </select>
        </div>
        <div class="form-group mb-3">
          <label for="platform">Plataforma</label>
          <select name="platform" id="platform" class="form-control" required>
              <option value="PS1">PS1</option>
              <option value="PS2">PS2</option>
              <option value="PS3">PS3</option>
              <option value="PS4">PS4</option>
              <option value="PS5">PS5</option>
              <option value="XBOX">XBOX</option>
              <option value="XBOX360">XBOX360</option>
              <option value="XBOX One">XBOX One</option>
              <option value="XBOX Series X|S">XBOX Series X|S</option>
              <option value="Nintendo SW">Nintendo SW</option>
              <option value="Nintendo DS">Nintendo DS</option>
              <option value="Nintendo 3DS">Nintendo 3DS</option>
              <option value="PC">PC</option>
          </select>
      </div>
        <button type="submit" class="btn btn-primary">Guardar Titulo</button>
      </form>
    </div>
  </div>

  <div class="card mt-5">
    <div class="card-header">
      <h2>Todos los titulos</h2>
    </div>
    <div class="card-body">
      @foreach($posts as $post)
        <div class="card mb-3">
          <div class="card-body">
            <h3 class="card-title">{{$post['title']}} by {{$post->user->name}}</h3>
            <p class="card-text">Estado: {{$post['status']}}</p>
            <p class="card-text">{{$post['body']}}</p>
            <p class="card-text">Plataforma: {{$post['platform']}}</p>
            <a href="/edit-post/{{$post->id}}" class="btn btn-secondary">Editar</a>
            <form action="/delete-post/{{$post->id}}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger">Borrar</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  </div>


@else
  <div class="alert alert-warning mt-5" role="alert">
    Tu biblioteca personal de Videojuegos.
  </div>
   <!-- Aquí mostramos la imagen de GameBase y los botones de Login y Register y el fondo de pantalla -->
   <style>
    body {
        background-image: url('{{ asset('imagenes/mosaicofondo.jpeg') }}');
        background-size: cover;
        background-position: center;
        min-height: 100vh; 
        margin: 0; 
        padding: 0; 
    }

    .button-container {
        background-color: rgba(255, 255, 255, 0.7); /* Fondo blanco con opacidad */
        padding: 20px; /* Espacio alrededor de los botones */
        border-radius: 10px; /* Bordes redondeados */
    }
</style>

<div class="background-image d-flex justify-content-center align-items-center">
    <div class="mt-5 text-center">
        <div class="container" style="max-width: 500px;">
            <img src="{{ asset('imagenes/GameBase.png') }}" alt="GameBase Image" class="img-fluid" style="max-width: 100%; height: auto;">
            <div class="mt-3 button-container">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-block mb-6">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success btn-lg btn-block mb-6">Registrate</a>
            </div>
        </div>
    </div>
</div>


</div>

@endauth
@endsection
