<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple</title>
    <!-- <link rel="stylesheet" href="style.css"> -->

    <link rel="stylesheet" href="asset/css/home.css">
    <link rel="stylesheet" href="asset/css/partial.css">
    <link rel="stylesheet" href="asset/css/auth.css">

    <!-- <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/plugin/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="asset/plugin/owlcarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="asset/plugin/owlcarousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="asset/plugin/themify/themify-icons.css">

    <script src="asset/plugin/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
            crossorigin="anonymous"></script>
    <!-- <script src="asset/bootstrap/js/bootstrap.min.js"></script>
      <script src="asset/bootstrap/js/jquery-3.3.1.js"></script> -->
</head>

<body>
<!-- header here-->
@include('partial.header')

<!-- slider-banner here-->
@include('layout.home.slider-banner')

<!-- category here-->
@include('layout.home.categories__banner')

<!-- new arrival here-->
@include('layout.home.new-arrival')

<!-- weekly product-->
@include('layout.home.weekly-best')

<!-- blog -->
@include('layout.home.blog')

<!-- footer-->
@include('partial.footer')

<script src="asset/plugin/owlcarousel/dist/owl.carousel.min.js"></script>
<script src="asset/js/home.js"></script>
</body>

</html>
