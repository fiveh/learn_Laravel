<header class="blog-header">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
            @if(Auth::check())
                <a href="/posts/create/">
                    <button class="btn btn-default">Create</button>
                </a>
                <a href="/posts/dashboard/{{ Auth::user()->id }}">
                    <button class="btn btn-default">MyPosts</button>
                </a>
            @endif
        </div>
        <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="/">Main</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            @if(Auth::check())
                <a class="btn btn-sm btn-outline-secondary" href="#">{{ Auth::user()->name}}</a>&nbsp;
                <a class="btn btn-sm btn-outline-info" href="#">$: {{ Auth::user()->score}}</a>&nbsp;
                <a class="btn btn-sm btn-outline-danger" href="/logout">Logout</a>&nbsp;
            @else
                <a class="btn btn-sm btn-outline-success" href="/login">Sign In</a>&nbsp;
                <a class="btn btn-sm btn-outline-info" href="/register">Register</a>&nbsp;
            @endif
        </div>
    </div>
</header>