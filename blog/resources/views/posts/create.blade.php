@extends('layouts.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h1>Create post</h1>

        <form method="POST" action="/posts">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

            @include('layouts.errors')
        </form>

    </div>
@endsection