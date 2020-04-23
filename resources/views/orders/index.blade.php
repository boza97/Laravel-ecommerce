@extends('layouts.app')

@section('content')

<div class="px-4 py-4">
  <h4 class="text-center">Narudžbine</h4>    
 
  @include('layouts.partials.messages')

  <div class="table-responsive-md">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Šifra narudžbine</th>
          <th scope="col">Datum</th>
          <th scope="col">Ime i prezime</th>
          <th scope="col">Grad</th>
          <th scope="col">Adresa</th>
          <th scope="col">Telefon</th>
          <th scope="col">Proizvodi</th>
          <th scope="col">Ukupno</th>
          <th scope="col">Status</th>
          <th scope="col">Otkaži*</th>
        </tr>
      </thead>
      <tbody id="tableBody">
         
        @if (!$orders->isEmpty())
        @foreach ($orders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
          <td>{{ $order->name }}</td>
          <td>{{ $order->city }}</td>
          <td>{{ $order->address }}</td>
          <td>{{ $order->phone }}</td>
          <td>
            @foreach ($order->order_items as $k=>$oi)
              {{ $oi->product_name." x " .$oi->quantity. " = ".$oi->amount }}
              @if ($k < count($order->order_items)-1)
                  <br>
              @endif
            @endforeach
            </td>
          <td>{{ $order->total }}</td>
          <td>{{ $order->status }}</td>
            <td>
              <form action="{{ route('deleteOrder') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="orderid" value="{{ $order->id }}">
                <input type="hidden" name="date" value="{{ $order->created_at }}">
                <input type="submit" class="btn btn-danger" value="Otkazi" name="cancelOrder">
              </form>
            </td>
          </tr>     
          @endforeach                               
        @else       
        <tr><td colspan="9" class="text-center">Nemate ni jednu narudžbinu.</td></tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection

