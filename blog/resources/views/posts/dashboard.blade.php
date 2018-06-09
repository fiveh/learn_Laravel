@extends ('layouts.master')

@section('content')
    <div class="col-md-8 blog-main">
        @foreach($posts as $post)
            @if(Auth::user()->id == $post->user_id)
                <div class="blog-post">
                    <h2 class="blog-post-title">
                        <a href="/posts/{{ $post->id }}" style="color: #002752">{{ $post->title }}</a>
                    </h2>
                    <p class="blog-post-meta">
                        by:<b> {{ $post->user->name }} </b>
                        <i>({{ $post->created_at->toDateTimeString() }})</i>
                    </p>
                    {{ $post->body }}
                    <br>
                    <form action="/posts/{{ $post->id }}/edit">
                        @csrf
                        <button class="btn btn-outline-warning btn-block">Edit</button>
                    </form>

                    {!! Form::open(['route' => ['destroy', $post->id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-block']) !!}
                    {!! Form::close() !!}
                    <hr>
                </div>
            @endif
        @endforeach
    </div>
@endsection