<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="/posts/{{ $post->id }}" style="color: #002752">{{ $post->title }}</a>
    </h2>
    <p class="blog-post-meta">{{ $post->created_at->toDateTimeString() }}</p>
    <p>{{ $post->body }}</p>
    <hr>
</div>