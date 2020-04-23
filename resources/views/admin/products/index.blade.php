@extends('layouts.app')

@section('content')

<div class="px-4 py-4">
  <h4 class="text-center mb-4">Proizvodi</h4>    
 
  @include('layouts.partials.messages')

  <div class="mb-3">
    <div class="row">
      <div class="col-md-3 col-sm-12">
        <a href="{{ route('adminAddProduct') }}" class="btn btn-link"><i class="fas fa-plus"></i> Dodaj proizvod</a>
      </div>
      <div class="col-md-3 ml-auto col-sm-12">
        <form action="{{ route('adminProducts') }}" method="get">
        <input type="text" class="form-control" id="search" name="search" placeholder="Pretraži" value="{{ request('search') }}">
        </form>
      </div>
    </div>
  </div>

  <div class="table-responsive-md">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Naziv proizvoda</th>
          <th scope="col">Kategorija</th>
          <th scope="col">Cena</th>
          <th scope="col">Količina</th>
          <th scope="col">Izdvojiti</th>
          <th scope="col">Izmeni</th>
        </tr>
      </thead>
      <tbody id="tableBody">
         
      @foreach ($products as $p)
        <tr class="{{ $p->quantity < 5 ? 'table-danger' : '' }}">
          <td>{{ $p->product_name }}</td>
          <td>{{ $p->category_name }}</td>
          <td>{{ $p->price }}</td>
          <td>{{ $p->quantity }}</td>
          <td>
            @php
              $f = ($p->featured == 1) ? 0 : 1;
            @endphp
            <a href="{{ route('adminProductFeatured', [$p->id, $f]) }}" class="text-dark btn-no-underline">
              <i class="far fa-{{ $p->featured == 1 ? 'minus' : 'plus' }}-square cursors-pointer"></i> {{ $p->featured == 1 ? 'Izdvojen proizvod' : '' }}
            </a>
          </td>
          <td>
            <a href="{{ route('adminEditProduct', $p->id) }}">
              <i class="fas fa-edit text-info cursors-pointer"></i>
            </a>
          </td>
        </tr>     
      @endforeach
        
      </tbody>
    </table> 
    <div class="pull-right">
      {{ $products->appends(request()->input())->links() }}
    </div> 
  </div>
</div>
@endsection

