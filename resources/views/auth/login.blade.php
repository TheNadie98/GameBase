@extends('layouts.layout')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card mt-5">
      <div class="card-header text-center">
        <h2>Login</h2>
      </div>
      <div class="card-body">
        <form action="/login" method="POST">
          @csrf
          <div class="form-group mb-3">
            <label for="loginname">Nombre de Usuario</label>
            <input name="loginname" type="text" class="form-control" placeholder="Introduce tu nombre de usuario">
          </div>
          <div class="form-group mb-3">
            <label for="loginpassword">Contraseña</label>
            <input name="loginpassword" type="password" class="form-control" placeholder="Introduce tu contraseña">
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
