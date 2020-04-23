@extends('layouts.app')

@section('content')

<div class="slider-wrapper theme-default">
  <div id="slider" class="nivoSlider">
    <img src="{{ asset('img/slide1.png') }}" data-thumb="{{ asset('img/slide1.png') }}">
    <img src="{{ asset('img/slide2.jpg') }}" data-thumb="{{ asset('img/slide2.jpg') }}">
    <img src="{{ asset('img/slide4.1.jpg') }}" data-thumb="{{ asset('img/slide4.jpg') }}">
    <img src="{{ asset('img/slide5.2.jpg') }}" data-thumb="{{ asset('img/slide5.jpg') }}">
  </div>
</div>

<hr>

<h3 id="main-h2" class="text-center font-weight-bold mt-5">IZDVAJAMO IZ PONUDE</h3>

<div class="containter px-3">
  <div class="row mb-5">

    @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-12 mt-5">
            <div class="card">
              @if ($product->image)
                <img class="card-img-top index-prod-image mx-auto my-3" src="{{ asset('img/products/'.$product->image) }}" alt="{{ $product->product_name }}">
              @else
                <img class="card-img-top index-prod-image mx-auto my-3" src="{{ asset('img/products/no-image.png') }}">              
              @endif
            <div class="card-body border-top">
                <h5 class="card-title">{{ $product->product_name }}</h5>
                <p class="card-text ">
                <strong>Cena: </strong>
                <span class="text-danger">{{ $product->price }}</span>
                </p>
                <a href="{{ route('product', $product->id) }}" class="btn btn-primary">Detalji</a>
            </div>
            </div>  
        </div>
    @endforeach

  </div>
</div>

@endsection

@push('scripts')
    <script>
        $(window).on('load', function() {
            $('#slider').nivoSlider(); 
            animSpeed: 500
        });
    </script>
@endpush