<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="/posts/{{ $post->id }}" style="color: #002752">{{ $post->title }}</a>
    </h2>
    <p class="blog-post-meta">
        by:<b> {{ $post->user->name }} </b>
        <i>({{ $post->created_at->toDateTimeString() }})</i>
    </p>
    {{ $post->body }}
    <hr>
</div>