@extends ('layouts.master')

@section ('content')
    <div class="col-md-8 blog-main">
        <h2 class="blog-post-title">{{ $post->title }}</h2>
        <p class="blog-post-meta">{{ $post->created_at->toDateTimeString() }}</p>
        <p>{{ $post->body }}</p>
        <hr>

        <div class="comments">
            @foreach($post->comments as $comment)
                <li class="list-group-item">
                    <i>
                        {{ $comment->created_at->diffForHumans() }}: &nbsp;
                    </i>

                    by: <strong>{{ $comment->user->name }}:</strong>
                    {{ $comment->body }}
                </li>
            @endforeach
        </div>


        {{-- Add comment --}}
        @if(Auth::check())
            <br>
            <div class="card-body">
                <div class="card-block">
                    <form method="POST" action="/posts/{{ $post->id }}/comments">
                        @csrf

                        <div class="form-group">
                            <textarea name="body" placeholder="Type here..." class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </div>
                    </form>

                    @include('layouts.errors')
                </div>
            </div>
        @endif
    </div>
@endsection