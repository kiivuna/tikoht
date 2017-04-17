@extends('layouts.master')

@section('content')
    <div class="col-sm-8 blog-main">
        <h1>Register</h1>

        <hr>

        <form method="POST" action="/register">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required></input>
          </div>

          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required></input>
          </div>

          <div class="form-group">
            <label for="password_confirmation">Password Confirmation:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required></input>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>


          @include('layouts.errors')

        </form>



    </div>


@endsection
