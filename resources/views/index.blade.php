@extends('main')

<title>Blog</title>

@section('content')

<div class="row">
  <div class="col-md-18 col-md-offset-2"
  <h1>Travell Adventures</h1>
</div>
</div>

@foreach ($posts as $post)
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h2>{{$post->title}}</h2>
    <h5> Published:{{ $post->created_at}}</h5>

    <p> {{ substr($post->body, 0, 250) }} {{strlen($post->body) > 250 ? "..." : ""}}</p>

    <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
  </div>
</div>
@endforeach



@endsection
