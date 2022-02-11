<header id="header" class=”collapse navbar-collapse”>
    <div class="container-fluid">
      <div class="row">
        <div class="nav_logo col-lg-1  col-sm-2">
          <div>
            <a href=" {{ route('home') }}"><img src="/asset/image/logo/logo.jpg"></a>
          </div>
        </div>
        <div class="nav_left col-lg-5  col-sm-4">
            <div class="icon_menu" id="icon_menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
          <div class="nav_left_item">
            <div class="left-item">
                <a href= "{{ route('for-him.index') }}">Nam</a>

            </div>
            <div class="left-item"><a href="{{ route('for-her.index') }}">Nữ</a></div>
            <div class="left-item"><a href="{{ route('new-arrival.index') }}">new arrivals </a></div>
            <div class="left-item"><a href="{{ route('sale-off.index') }}" style="color: #be2c15; font-family: 'Condensed-Light'">sale off </a></div>
          </div>
        </div>
        <div class="nav_right col-lg-6 col-sm-6" style="font-size:25px;">
          <div class="search">
              <div class="icon_search">
                  <i id="icon_search" class="ti-search" style="font-size: 22px; padding: 0 10px"></i>
                  <a href="#"><i class="ti-shopping-cart" style="font-size: 28px;"></i></a>
              </div>
            <form class="" method="POST" action="{{ route('product.search') }}">
                @csrf
              <input name="keyword" class="form-control mt-3" type="search" placeholder="TÌM KIẾM" aria-label="Search" style="font-family: 'Condensed-Light'; color: #231f20" required>
            </form>
          </div>
            @php
                $user = Auth::user();
            @endphp
          <div class="login">
            <a href="{{ route('login.show') }}"> {{ !empty($user) ? $user->name :'Đăng nhập' }}</a>
              @php $count = !empty(\Cart::content()->count()) ? \Cart::content()->count() : 0 @endphp
            <a href="{{ route('cart.checkout') }}">Giỏ Hàng (<span id="cart_qty">{{ $count }}</span>)</a>
          </div>
        </div>
      </div>
        <div class="side_nav" id="side_nav">
            <ul class="nav_mobile">
                <li class="left-item"><a href="{{ route('for-him.index') }}">nam</a></li>
                <li class="left-item"><a href="{{ route('for-her.index') }}">Nữ</a></li>
                <li class="left-item"><a href="{{ route('new-arrival.index') }}">new arrivals</a></li>
                <li class="left-item"><a href="{{ route('sale-off.index') }}" style="color: #be2c15; font-family: 'Condensed-Light'">sale off</a></li>
            </ul>
            <button class="close_button" id="close_button">
                <i class="ti-close" style="font-size: 25px"></i>
            </button>
            <div class="bottom-menu">
                <a href="{{ route('login.show') }}">Đăng nhập</a>
                <a href="{{ route('cart.checkout') }}" style="margin-left: 70px;">giỏ hàng (<span id="cart_qty">{{ $count }}</span>)</a>
            </div>
        </div>
        <div id="search_nav">
            <button class="close_search" id="close_search">
                <i class="ti-close" style="font-size: 25px; "></i>
            </button>
            <form class="input-search" method="POST" action="index.php?page_layout=search">
                <input name="keyword" class="form-control mt-3" type="search" placeholder="TÌM KIẾM" aria-label="Search" style="font-family: 'Condensed-Light'; color: #231f20" required>
                <div class="icon_search">
                    <i class="ti-search" style="font-size: 22px; padding: 0 10px;position: absolute; right: 20px; top: 110px"></i>
                </div>
            </form>

        </div>
    </div>
  </header>
<script>
    let close = document.getElementById('close_button');
    let menu = document.getElementById('icon_menu');
    let side_nav = document.getElementById('side_nav');

    menu.addEventListener('click', function() {
        side_nav.style.left = "0%";
    });
    close.addEventListener('click', function () {
        side_nav.style.left = "-100%"
    });
    // search input
    let close_search = document.getElementById('close_search');
    let search = document.getElementById('icon_search');
    let search_nav = document.getElementById('search_nav');

    search.addEventListener('click', function() {
        search_nav.style.left = "0%";
    });
    close_search.addEventListener('click', function () {
        search_nav.style.left = "-100%"

    });


</script>
