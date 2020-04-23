@extends('layouts.app')

@section('content')

<div class="px-4 py-4">
  <h4 class="text-center mb-4">Naručeni proizvodi</h4>    
 
  @include('layouts.partials.messages')

  <div class="table-responsive-md">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Naziv proizvoda</th>
          <th scope="col">Kategorija</th>
          <th scope="col">Količina</th>
          <th scope="col">Ukupno</th>
        </tr>
      </thead>
      <tbody id="tableBody">
         
      @foreach ($orderItems as $item)
        <tr>
          <td>{{ $item->product_name }}</td>
          <td>{{ $item->category_name }}</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ $item->amount }}</td>
        </tr>     
      @endforeach
        
      </tbody>
    </table> 
  </div>

  <h4 class="text-center mb-4">Detalji narudžbine</h4>    

  <div class="table-responsive-md">
    <table class="table table-striped">
      <thead class="">
        <tr>
          <th scope="col">Šifra narudžbine</th>
          <th scope="col">Datum</th>
          <th scope="col">Ime i prezime</th>
          <th scope="col">Grad</th>
          <th scope="col">Adresa</th>
          <th scope="col">Telefon</th>
          <th scope="col">Ukupno</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ $order->created_at }}</td>
          <td>{{ $order->name }}</td>
          <td>{{ $order->city }}</td>
          <td>{{ $order->address }}</td>
          <td>{{ $order->phone }}</td>
          <td>{{ $order->total }}</td>
          <td>
            <form action="{{ route('adminOrderUpdate', $order->id) }}" method="POST">
              @csrf
              @method('PATCH')
              
              <div class="row">
                <div class="col-md-6">
                  <select class="custom-select custom-select-sm" name="status" id="status">
                    @foreach (config('constants.order_statuses') as $s)
                      <option value="{{ $s }}" {{ ($s == $order->status) ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach                
                  </select>
                </div>

                <div class="col-md-6">
                  <input type="submit" class="btn btn-sm btn-outline-primary" value="Sačuvaj">
                </div>
              </div>
            </form>
          </td>
        </tr>
      </tbody>
    </table> 
  </div>
</div>
@endsection

