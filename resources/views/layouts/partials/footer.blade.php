</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.nivo.slider.pack.js') }}" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/a162b2b578.js" crossorigin="anonymous"></script>
@stack('scripts')

<footer class="p-4">

  <ul>
    <li><a href="index.php">Početna</a></li>
    <li><a href="products.php">Proizvodi</a></li>
    @if (auth()->user())
      <li><a href="cart.php">Korpa</a></li>
    @endif
  </ul>

  <p>Copyright &copy; 2020 Btechnology</p>

</footer>

</div>

</body>

</html>