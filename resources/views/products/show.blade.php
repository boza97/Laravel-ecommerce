@extends('layouts.app')

@section('content')

<div class="container my-4">
  <div class="row">

    <div class="col-md-6 col-sm-12 border-right">
      @if ($product->image)
        <img height="500" width="500" src="{{ asset('img/products/'.$product->image) }}" alt="{{ $product->product_name }}" class="image-responsive"/> 
      @else
        <img height="500" width="500" src="{{ asset('img/products/no-image.png') }}"class="image-responsive"/>
      @endif
      
    </div>
    <div class="col-md-6 col-sm-12">      
      <h3 class="text-center">{{ $product->product_name }}</h3>
      <h5 class="mt-4 ">
        <span class="font-weight-bold"> Kategorija: </span>
        {{ $product->category_name }}
      </h5>
      <h5 >
        <span class="font-weight-bold">Cena: </span>
        <span class="text-danger">{{ $product->price }}</span>
      </h5>
      <h5 class="mb-0 font-weight-bold">Karakteristike: </h5>
      <p>{!! $product->details !!}</p>

      <div>
        <button class="btn btn-warning" onclick="addToCart({{ $product->id }})">Dodaj u korpu</button>
      </div>

    </div>

  </div>

</div>

<!-- Message modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Korpa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalMsg"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')

<script>
  
  function addToCart(productid)
    {
      $.ajax({
        url: '{{ route('addToCart') }}',
        method: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          id: productid},
        success: function (data) {        
          $('#modalMsg').html(data);
          $('#messageModal').modal();
        },
        error: function (data) {        
          $('#modalMsg').html('Došlo je do greške');
          $('#messageModal').modal();
        }          
      });
    }
  
</script>

    
@endpush