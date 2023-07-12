@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  <!-- Wrapper for carousel items -->
  <div class="carousel-inner">
    @foreach ($sliders as $key=>$slider)
      <div class="carousel-item {{$key == 0 ? 'active':''}}">
        @if ($slider->url)
          <img src="{{asset("$slider->url")}}" class="d-block w-100" height="230" alt="...">
        @endif
          <div class="carousel-caption d-none d-md-block">
              <h2>{{$slider->title}}</h2>
              <p>{{$slider->description}}</p>
          </div>
      </div>
    @endforeach
  </div>

  <!-- Carousel controls -->
  <a class="carousel-control-prev" href="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
  </a>
</div>
@endsection