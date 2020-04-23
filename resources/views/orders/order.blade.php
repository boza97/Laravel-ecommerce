@extends('layouts.app')

@section('content')
<div class="w-50 mx-auto pt-5 mb-5">
  <form action="{{ route('addOrder') }}" method="POST">
    @csrf
    <h2 class="text-center mb-4">Naručivanje</h2>

    <div class="form-group">    
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Ime i prezime" value="{{ old('name') }}">
      @error('name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror      
    </div>
    
    <div class="form-group">    
      <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="Grad" value="{{ old('city') }}">
      @error('city')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group">    
      <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Adresa" value="{{ old('address') }}">
      @error('address')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group">    
      <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Telefon" value="{{ old('phone') }}">
      @error('phone')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group text-right">
      <input type="submit" name="order" class="btn btn-primary" value="Naruči">
      <div class="invalid-feedback"></div>
    </div>

  </form>

</div>
@endsection
