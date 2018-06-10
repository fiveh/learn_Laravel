@extends ('layouts.master')

@section('content')
    <div class="col-md-8 blog-main">
        @csrf

        <div class="form-group">
            <form method="POST" action="/posts/update/{{ $post->id }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body" name="body">{{ $post->body }}</textarea>
                </div>
                @if($post->image != NULL)
                    <div class="form-group">
                        <img style="max-width: 400px; max-height: 400px;" src="{{ asset('images/' . $post->image) }}"
                             alt="{{ $post->image }}">
                        <p>Image info: {{$post->image}}</p>
                    </div>
                @endif
                <div class="form-group">
                    {!! Form::label('featured_image', 'Update image:') !!}
                    {!! Form::file('featured_image') !!}
                </div>

                <button type="submit" class="btn btn-primary">Send Updates</button>
                @include('layouts.errors')
            </form>
        </div>
    </div>
@endsection