@extends('layouts.app')

@section('content')

<div class="px-4 py-4">
  <h4 class="text-center">Vaša korpa:</h4>
  @include('layouts.partials.messages')
<form action="{{ route('addQuantity') }}" method="POST"> 
  @csrf
  <div class="table-responsive-md">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Proizvod</th>
          <th scope="col">Cena</th>
          <th scope="col">Količina</th>
          <th scope="col">Ukupno</th>
          <th scope="col">Obriši</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @if (!empty(session('cart')))
        
          @foreach ($products as $product)
            <tr id="prod{{ $product[0]['id'] }}">
            <td>{{ $product[0]['product_name'] }}</td>
            <td id="price{{ $product[0]['id'] }}">{{ $product[0]['price'] }}</td>
            <td>
              <input type="hidden" name="productid[]" value="{{ $product[0]['id'] }}">
              <input class="form-control w-75" id="quantitiy" type="number" name="quantity[]" min='1' max='{{ $product[0]['quantity'] }}' value="1" onchange="calculateTotal(this, {{ $product[0]['id'] }});">
            </td>
            <td id="total{{ $product[0]['id'] }}">{{ $product[0]['price'] }}</td>          
            <td><button type="button" class="btn btn-link p-0 text-danger" onclick="removeFromCart({{ $product[0]['id'] }});">X</button></td>
            </tr>   
          @endforeach
        @else    

          <tr>
            <td class="text-center" colspan="5">Vaša korpa je prazna.</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>

  @if (!empty(session('cart')))

    <div class="form-group text-right">
      <input class="btn btn-primary" type="submit" name="orderCart" id="orderCart" value="Nastavi">
    </div>  
  @endif
  </form> 

</div>

@endsection

@push('scripts')

<script>
  
  function removeFromCart(pid) {
    $.ajax({
      url: 'cart/'+pid,
      method: 'POST',
      data: {
        _token: "{{ csrf_token() }}",
        _method: "DELETE"        
      },
      success: function (data) {
        $('#prod'+pid).remove();
        if(data == 0) {
          $('#orderCart').remove();
          $('#tableBody').html('<tr><td class="text-center" colspan="5">Vaša korpa je prazna.</td></tr>');
        }
      }
    });
    
  }
  
  function calculateTotal(el, pid) {
    let quantitiy = el.value;
    let price = $('#price'+pid).text();
    let total = quantitiy * price;   
    $('#total'+pid).html(total);
  }
</script>
    
@endpush

