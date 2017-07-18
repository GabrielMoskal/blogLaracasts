<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="/posts/{{ $post->id }}">
            {{ $post->title }}
        </a>

    </h2>
    <p class="blog-post-meta">
        <?php var_dump($post->name) ?>
        {{ $post->user }} DOESNT WORK
        {{ $post->created_at->toFormattedDateString() }}
    </p>

    {{ $post->body }}
</div>