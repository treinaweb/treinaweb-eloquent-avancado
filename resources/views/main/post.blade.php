<div class="post-preview">
  <a href="{{ route('posts.public.show', $post) }}">
    <h2 class="post-title">
      {{ $post->title }}
    </h2>
    <h3 class="post-subtitle">
        {{ $post->content }}
    </h3>
  </a>
  <p class="post-meta">
    Postado por <a href="#">Treinaweb</a> em @datebr($post->created_at)
    possui {{ $post->comments_count }} comentário(s)
  </p>

  @if (request()->query('categories'))
    <p class="post-meta">
        Categorias: 
        @foreach($post->categories as $category)
          <a href="#">{{ $category->name }}</a>
        @endforeach
    </p>
  @endif  
</div>
<hr>