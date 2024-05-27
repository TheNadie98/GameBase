@extends('layouts.layout')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card mt-5">
      <div class="card-header text-center">
        <h2>Registro</h2>
      </div>
      <div class="card-body">
        <form action="/register" method="POST">
          @csrf
          <div class="form-group mb-3">
            <label for="name">Nombre</label>
            <input name="name" type="text" class="form-control" placeholder="Kratos">
          </div>
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Kratos@atreus.com">
          </div>
          <div class="form-group mb-3">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control" placeholder="Soyundios123">
          </div>
          <button type="submit" class="btn btn-primary w-100">Registrate</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
