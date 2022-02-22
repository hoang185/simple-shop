<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('page.title')</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="icon" href="{!! asset('/asset/image/logo/logo.jpg', true) !!}"/>
  <link rel="stylesheet" href="{{ asset('asset/css/home.css', true)}}">
  <link rel="stylesheet" href="{{ asset('asset/css/partial.css', true)}}">
  <link rel="stylesheet" href="{{ asset('css/app.css', true)}}">

  <!-- <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="{{ asset('asset/plugin/fontawesome/css/font-awesome.min.css', true)}}">
  <link rel="stylesheet" href="{{ asset('asset/plugin/owlcarousel/dist/assets/owl.carousel.min.css', true)}}">
  <link rel="stylesheet" href="{{ asset('asset/plugin/owlcarousel/dist/assets/owl.theme.default.min.css', true)}}">
    <link rel="stylesheet" href="{{ asset('asset/plugin/themify/themify-icons.css', true)}}">

    <script src="{{ asset('asset/plugin/jquery-3.5.1.min.js', true)}}"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <!-- <script src="asset/bootstrap/js/bootstrap.min.js"></script>
    <script src="asset/bootstrap/js/jquery-3.3.1.js"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

</head>

<body>
  <!-- header here-->
  @include('partial.header')

  @yield('content')

  <!-- footer-->
  @include('partial.footer')

  @yield('scripts')

  {{-- <script src="asset/plugin/owlcarousel/dist/owl.carousel.min.js"></script> --}}
  {{-- <script src="asset/js/home.js"></script> --}}
  <!-- Messenger Plugin chat Code -->
  <div id="fb-root"></div>

  <!-- Your Plugin chat code -->
  <div id="fb-customer-chat" class="fb-customerchat">
  </div>

  <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "102069652418447");
      chatbox.setAttribute("attribution", "biz_inbox");
  </script>

  <!-- Your SDK code -->
  <script>
      window.fbAsyncInit = function() {
          FB.init({
              xfbml            : true,
              version          : 'v13.0'
          });
      };

      (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
  </script>
</body>

</html>
