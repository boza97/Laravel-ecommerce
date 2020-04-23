@extends('layouts.app')

@section('content')

<div class="px-4 py-4">
  <h4 class="text-center mb-5">Izmena proizvoda</h4>
  @include('layouts.partials.messages')
  <div class="w-50 mx-auto">
    <form action="{{ route('adminUpdateProduct', $product->id) }}" method="POST" enctype="multipart/form-data"> 
      @csrf   
      @method('PATCH')
      <div class="form-group">    
        <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" placeholder="Naziv proizvoda" value="{{ $product->product_name }}" autofocus>
        @error('product_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>  
    
      <div class="form-group">
        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Cena" value="{{ $product->price }}">
        @error('price')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>  

      <div class="form-group">
        <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Količina" value="{{ $product->quantity }}">
        @error('quantity')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>  

      <div class="form-group">
        <select type="text" name="category" class="form-control @error('category') is-invalid @enderror" placeholder="Kategorija">
          @foreach ($categories as $c)
            <option value="{{ $c->id }}" {{ ($c->id == $product->category_id) ? 'selected' : '' }}>{{ $c->category_name }}</option>
          @endforeach
        </select>
        @error('category')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div> 
      
      <div class="form-group">
        <textarea class="form-control @error('details') is-invalid @enderror" name="details" placeholder="Detalji">{{ $product->details }}</textarea>
        @error('details')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div> 

      @if ($product->image)
        <div class="form-group">
          <img height="150" width="150" src="{{ asset('img/products/'.$product->image) }}" class="image-responsive"/>
          <a href="{{ route('adminDeleteProductImage', $product->id) }}">
            Izbriši sliku
          </a>
        </div>    
      @else
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" id="image" accept="image/x-png,image/jpeg">
            <label class="custom-file-label selected" id="image-label" for="image" data-browse="Pretraži"></label>
            @error('image')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
      @endif

      <div class="form-group text-right mt-3">
        <input type="submit" class="btn btn-primary" value="Izmeni proizvod">    
      </div>
      
   </form>   
  </div>
  
</div>
@endsection

@push('scripts')
<script>
  $(document).ready( function () {   
    changeFile(); 
    $('#image').on('change', changeFile);
  });

  function changeFile () {
    if($('#image').get(0).files.length != 0) {
      var fileName = $("#image").val().split("\\").pop();
      $("#image").siblings("#image-label").addClass("selected").html(fileName);
    }
  }
</script>
@endpush