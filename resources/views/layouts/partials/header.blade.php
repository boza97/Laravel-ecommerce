<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/nivo-slider.css') }}">
  <link rel="stylesheet" href="{{ asset('themes/nivo-slider/default.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>BTechnology</title>
</head>

<body class="h-100">

  <div class="wraper">

    <nav class="navbar navbar-expand-lg color-primary">
      <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" height="40"></a>
      <button class="navbar-dark navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Početna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('products') }}">Proizvodi</a>
          </li>

          @if (auth()->user() && auth()->user()->role == 'USER')
            <li class="nav-item">
              {{-- TODO --}}
              <a class="nav-link" href="{{ route('cart') }}">Korpa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('orders') }}">Narudžbine</a>
            </li>   
          @endif
          
          
          @if (auth()->user() && in_array(auth()->user()->role, ['ADMIN', 'EDITOR']))
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin
              </a>
              <div class="dropdown-menu admin-dropdown color-primary" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('adminOrders') }}">Narudžbine</a>
                <a class="dropdown-item" href="{{ route('adminProducts') }}">Proizvodi</a>
                @if (auth()->user()->role == 'ADMIN')
                  <a class="dropdown-item" href="{{ route('adminUsers') }}">Administratori</a>
                @endif
              </div>
            </li>
          @endif

          <li class="nav-item">
            <a class="nav-link" href="{{ route('news') }}">Vesti</a>
          </li>
        </ul>       

        <ul class="navbar-nav">
          @if (auth()->user())
            <li class="nav-item">
              <a class="nav-link text-white">Zdravo <strong class="text-warning">{{ auth()->user()->name }}</strong></a>
            </li>
            <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST" id="logout">
                @csrf
                <a class="nav-link" type="submit" onclick="document.getElementById('logout').submit();">Odjavi se</a>
              </form>
            </li>    
          @else        
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Registruj se</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Prijavi se</a>
            </li>
          @endif  
        </ul>

      </div>
    </nav>

    <div class="main">