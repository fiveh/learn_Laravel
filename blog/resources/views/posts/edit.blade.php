@extends ('layouts.master')

@section('content')
    <div class="col-md-8 blog-main">
        @csrf

        <div class="form-group">
            <form method="POST" action="/posts/update/{{ $post->id }}">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body" name="body">{{ $post->body }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Updates</button>
            </form>
        </div>
    </div>
@endsection