@extends('layouts.app')

@section('content')

<div class="px-4 py-4">
  <h4 class="text-center mb-5">Dodavanje administratora</h4>

  <div class="w-50 mx-auto">
    <form action="{{ route('adminStoreUser') }}" method="POST"> 
      @csrf   

      <div class="form-group">    
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Ime i prezime" value="{{ old('name') }}" autofocus>
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>  
    
      <div class="form-group">
        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" value="{{ old('email') }}">
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>  

      <div class="form-group">
        <select type="text" name="role" class="form-control @error('role') is-invalid @enderror" placeholder="Rola">
          <option value="ADMIN">ADMIN</option>
          <option value="EDITOR">EDITOR</option>
        </select>
        @error('role')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div> 

      <div class="form-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Lozinka">

        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>  
      
      <div class="form-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Potvrdite lozinku">
      </div> 
    
      <div class="form-group text-right mt-3">
        <input type="submit" class="btn btn-primary" value="Dodaj administratora">    
      </div>
      
   </form>   
  </div>
  
</div>
@endsection