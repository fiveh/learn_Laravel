@extends ('layouts.master')

@section('content')


    <div class="col-md-8 blog-main">

        @foreach($posts as $post)
            @include('posts.post')
        @endforeach
        <div class="blog-pagination" align="center">
            {!! $posts->links() !!}
        </div>
    </div>

@endsection



