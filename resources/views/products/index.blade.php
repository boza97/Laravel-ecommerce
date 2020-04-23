@extends('layouts.app')

@section('content')

  <div class="containter my-4">
    
    <div class="form-group row">
      <div class="col-md-4"></div>
      <label class="col-md-2 col-form-label font-weight-bold">Kategorija proizvoda: </label>
      <select class="form-control col-md-2" name="category" id="combo-category">
        <option value="*" selected = 'selected'>Sve</option>

        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach   

      </select>
    </div>
    
    <div class="row px-3" id="products">

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
              <button class="btn btn-warning mx-3" onclick="addToCart({{ $product->id }})">Dodaj u korpu</button>
            </div>
          </div>  
        </div>
          
      @endforeach
  
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

  $(document).ready(function () {    
    $('#combo-category').val('*');
    $('#combo-category').change(function(){
      var category = $('#combo-category').val();
      $.get(
        'products/category/'+category,
        function(data){
          $('#products').html(data);
      });
    });
  });

  function addToCart(productid)
  {
    $.ajax({
      url: "{{ route('addToCart') }}",
      method: 'POST',
      data: {
        _token: "{{ csrf_token() }}",
        id: productid
      },
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