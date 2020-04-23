@extends('layouts.app')

@section('content')

<div class="px-4 py-4">
  <h4 class="text-center mb-4">Administratori</h4>    
 
  @include('layouts.partials.messages')

  <div class="mb-3">
    <a href="{{ route('adminAddUser') }}" class="btn btn-link"><i class="fas fa-plus"></i> Dodaj administratora</a>
  </div>

  <div class="table-responsive-md">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Ime</th>
          <th scope="col">Email</th>
          <th scope="col">Registrovan</th>
          <th scope="col">Rola</th>
          <th scope="col">Obriši</th>
        </tr>
      </thead>
      <tbody id="tableBody">
         
      @foreach ($users as $u)
        <tr>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td>{{ $u->created_at->format('d/m/Y H:i:s') }}</td>
          <td>{{ $u->role }}</td>
          <td>
            @if ($u->role == 'EDITOR')
              <form action="{{ route('adminDeleteUser', $u->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-link cursors-pointer p-0 m-0"><i class="fas fa-trash text-danger"></i></button>
              </form>
            @endif
          </td>
        </tr>     
      @endforeach        
      </tbody>
    </table>
  </div>
</div>
@endsection

