<div class="row px-3">
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
          {{-- TODO --}}
          <a href="{{ route('product', $product->id) }}" class="btn btn-primary">Detalji</a>
          <button class="btn btn-warning mx-3" onclick="addToCart({{ $product->id }})">Dodaj u korpu</button>
        </div>
      </div>  
    </div>
  @endforeach
</div>  