@extends('layouts.master')

@section('content')
    <div class="col-sm-8">
        <h1>Sign IN</h1>

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>

            @extends('layouts.errors')
        </form>
    </div>

@endsection