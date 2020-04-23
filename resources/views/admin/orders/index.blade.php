@extends('layouts.app')

@section('content')

<div class="px-4 py-4">
  <h4 class="text-center mb-4">Narudžbine</h4>    
 
  @include('layouts.partials.messages')

  <div class="mb-3">
    <div class="row">
      <div class="col-md-3 ml-auto">
        <form action="{{ route('adminOrders') }}" method="get">
        <input type="text" class="form-control" id="search" name="search" placeholder="Pretraži" value="{{ request('search') }}">
        </form>
      </div>
    </div>
  </div>

  <div class="table-responsive-md">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Šifra narudžbine</th>
          <th scope="col">Datum</th>
          <th scope="col">Ime i prezime</th>
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
            <td>{{ $order->total }}</td>
            <td>{{ $order->status }}</td>
            <td><a href="{{ route('adminOrderShow', $order->id) }}" class="btn btn-primary">Detalji</a></td>
          </tr>     
        @endforeach                               
      @else       
        <tr><td colspan="6" class="text-center">Nema narudžbina.</td></tr>
      @endif
      </tbody>
    </table>  
    <div class="pull-right">
      {{ $orders->appends(request()->input())->links() }}
    </div> 
  </div>
</div>
@endsection

