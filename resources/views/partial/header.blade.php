<header id="header" class=”collapse navbar-collapse”>
    <div class="container-fluid">
      <div class="row">
        <div class="nav_logo col-lg-2 col-md-2 col-sm-2">
          <div>
            <a href=" {{ route('home') }}"><img style="height: 80px; width: 80px" src="/asset/image/logo/logo.jpg"></a>
          </div>
        </div>
        <div class="nav_left col-lg-4 col-sm-4">
          <div class="nav_left_item">
            <div class="left-item">
                <a href="#">Nam</a>

            </div>
            <div class="left-item"><a href="#">Nữ</a></div>
            <div class="left-item"><a href="#">new arrivals </a></div>
            <div class="left-item"><a href="#" style="color: #be2c15; font-family: 'Condensed-Light'">sale off </a></div>
          </div>
        </div>
        <div class="nav_right col-lg-6 col-sm-6" style="font-size:25px;">
          <div class="search">
            <form class="" method="POST" action="index.php?page_layout=search">
              <input name="keyword" class="form-control mt-3" type="search" placeholder="TÌM KIẾM" aria-label="Search" style="font-family: 'Condensed-Light'; color: #231f20" required>
            </form>
          </div>
          <div class="login">
            <a href="{{ route('login.show') }}">Đăng nhập</a>
            <a href="#">Giỏ Hàng (0)</a>
          </div>
        </div>
      </div>
    </div>
  </header>
