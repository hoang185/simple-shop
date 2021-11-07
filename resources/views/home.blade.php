<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Simple</title>
  <!-- <link rel="stylesheet" href="style.css"> -->

  <link rel="stylesheet" href="asset/css/home.css">
  <!-- <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="asset/fontawesome/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <!-- <script src="asset/bootstrap/js/bootstrap.min.js"></script>
    <script src="asset/bootstrap/js/jquery-3.3.1.js"></script> -->
</head>

<body>
  <!-- header here-->
  <header id="header">
    <div class="container">
      <div class="row">
      <div class="nav_logo col-lg-2">
        <div>
        <a href="#">Simple</a>
        </div>
      </div>
      <div class="nav_left col-lg-4">
        <div class="nav_left_item">
          <div><a href="#">Nam</a></div>
          <div><a href="#">Nữ</a></div>
          <div><a href="#">Daily Better</a></div>
        </div>
      </div>
      <div class="nav_right col-lg-6" style="font-size:25px;">
        <div class="search">
          <form class="" method="POST" action="index.php?page_layout=search">
            <input name="keyword" class="form-control mt-3" type="search" placeholder="Tìm kiếm" aria-label="Search" required>
          </form>
        </div>
        <div class="login">
          <a href="#">Đăng nhập</a>
          <a href="#">Giỏ Hàng (0)</a>
        </div>
      </div>
      </div>
    </div>
  </header>

  <!-- slider-banner here-->
  <div id="slider-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="asset/image//home/banner-slider/1634107728711.jpeg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="asset/image//home/banner-slider/1634532448566.jpeg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="asset/image//home/banner-slider/1634548963721.jpeg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="asset/image//home/banner-slider/1634609351422.jpeg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </button>
    </div>
  </div>
  <!-- category here-->
  <section id="categories__banner">
    <div><a href="#" class="categories__banner--left" style=" background-image: url(asset/image/home/for-him/dCwJedM.jpg)"></a></div>
    <div><a href="#" class="categories__banner--right" style=" background-image: url(asset/image/home/for-her/Bqa03SH.jpg)"></a></div>
  </section>

  <!-- new product here-->
  <section id="new-arrivals__slider">
    <h2><a href="#">WHAT'S NEW</a></h2>
    <div class="gender__toggle">
      <button class="btns active-toggle">For Him</button>
      <button class="btns">For Her</button>
    </div>
    <div class="products__slider">
      <p class="slider">boy slide</p>
      <p class="slider active-slider">girl slide</p>
    </div>
  </section>

  <!-- best product-->
  <section id="best-product"></section>

  <!-- story -->
  <section id="story"></section>

  <!-- footer-->
  <footer id="footer"></footer>
  <script src="asset/js/home.js"></script>
</body>

</html>