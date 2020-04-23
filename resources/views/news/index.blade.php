@extends('layouts.app')

@section('content')

<h3 id="main-h2" class="text-center font-weight-bold mt-5">Najnovije vesti</h3>

<div class="containter px-3">
  <div class="row mb-5">

    @foreach ($news as $n)
        <div class="col-lg-4 col-md-6 col-sm-12 mt-5">
            <div class="card">
              <a href="{{ $n->url }}" class="px-3" target="_blank"><img class="card-img-top news-image mx-auto my-3" src="{{ $n->urlToImage }}"></a>
            <div class="card-body border-top">
                <h5 class="card-title">{{ $n->title }}</h5>
                <p class="card-text ">{{ $n->description }}</p>
                <a href="{{ $n->url }}" class="btn btn-primary" target="_blank">Detalji</a>
            </div>
            </div>  
        </div>
    @endforeach

  </div>
</div>

@endsection