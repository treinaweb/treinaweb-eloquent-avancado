@extends('layout.app')

@section('title')
  {{ $post->title }}
@endsection

@section('header')
  <p>{{ $post->title }}</p>

  @parent
@endsection

@section('content')
   <!-- Post Content -->
   <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          {{ $post->content }}
        </div>
      </div>
    </div>
  </article>

  <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>
            @foreach($post->categories as $category)
              <a href="#">{{ $category->name }}</a>
            @endforeach
          </p>
        </div>
      </div>
  </div>


  <hr>

  <div class="container">
    
    <form action="{{ route('ratings.store', $post) }}" method="post">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>A média de avaliação desse post é: {{ $post->ratings()->avg('value') }}</p>
            <label for="value">Avaliar</label>
            <input class="form-control" type="range" min="0" max="10" name="value" list="marcadores">

            <datalist id="marcadores">
              <option value="0"></option>
              <option value="1"></option>
              <option value="2"></option>
              <option value="3"></option>
              <option value="4"></option>
              <option value="5"></option>
              <option value="6"></option>
              <option value="7"></option>
              <option value="8"></option>
              <option value="9"></option>
              <option value="10"></option>
            </datalist>
        </div>

        <div class="col-lg-8 col-md-10 mx-auto text-right">
          <button type="submit">Enviar</button>
        </div>
      </div>
    </form>
  </div>

  <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <h3>Comentários</h3>
        </div>

        @foreach($post->comments as $comment)
          <div class="col-lg-8 col-md-10 mx-auto">
          <h6>{{ $comment->title }}</h6>
            <p style="font-size: 15px; margin-top: 5px">
              {{ $comment->content }}
            </p>
          </div>
        @endforeach  

      </div>
  </div>

  <div class="container">
    <form action="{{ route('comments.store', $post) }}" method="post">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <label for="title">Comentar</label>
            <input class="form-control" type="text" name="title" placeholder="Assunto">
        </div>
      
        <div class="col-lg-8 col-md-10 mx-auto">
          <textarea class='form-control' name="content" cols="30" rows="5" placeholder="Mensagem"></textarea>
        </div>

        <div class="col-lg-8 col-md-10 mx-auto text-right">
          <button type="submit">Enviar</button>
        </div>
      </div>
    </form>
  </div>



@endsection
