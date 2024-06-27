<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" id="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  @yield('seo')

  <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('frontend/img/favicon.ico') }}" type="image/x-icon">

  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery-ui.css?v='.time()) }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick.css?v='.time()) }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick-theme.css?v='.time()) }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.scrollbar.min.css?v='.time()) }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css?v='.time()) }}" />
</head>

<!-- for server -->
<!-- <link rel="stylesheet" type="text/css" href="./css/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/slick-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="./css/jquery.modal.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/jquery.scrollbar.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/magnific-popup.css" /> -->
</head>
    <body>
        @php
            $isAuth    = false;
            $authMember = null;
            if(auth()->guard('member')->check()) {
                $isAuth = true;
                $authMember = auth()->guard('member')->user();
            }
        @endphp
        <div class="bg-white @if(Route::currentRouteName() == 'front.product.detail') rem-productdetail @endif">  <!-- container mx-auto -->
            @include('frontend.layouts.header')
            
            @yield('content')

            @include('frontend.layouts.footer')

            <!-- NewLetter Popup Modal -->
            <x-frontend.newletter-popup />
            <!-- Region Popup Modal -->
            <x-frontend.region-popup />

        </div>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery-3.6.0.min.js?v='.time()) }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery-ui.js?v='.time()) }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/slick.min.js?v='.time()) }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/multiselect-dropdown.js?v='.time()) }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.scrollbar.js?v='.time()) }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/scripts.js?v='.time()) }}"></script>
        <!-- end -->
        <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <!-- for remove -->

        <!-- for server -->
        <!-- <script src="./js/jquery-3.6.0.min.js"></script>
        <script src="./js/jquery.magnific-popup.min.js"></script>
        <script src="./js/pdfobject.min.js"></script>
        <script src="./js/slick.min.js"></script>
        <script src="./js/jquery.dataTables.js"></script>
        <script src="./js/jquery.modal.min.js"></script>
        <script src="./js/jquery.scrollbar.js"></script> -->
        <!-- <script src="https://devhtml.visibleone.io/prem/multiselect-dropdown.js"></script> -->
        <!-- <script src="../js/libs/multiselect-dropdown.js"></script> -->
        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <!-- <script src="./js/libs/jquery.magnific-popup.js"></script> -->
        <!-- <script src="./js/slick.js"></script> -->
        @stack('scripts')

        <!-- Custom JS -->
        <script src="{{ asset('frontend/custom/area-switch.js?v='.time()) }}"></script>
        <script src="{{ asset('frontend/custom/cart-header.js?v='.time()) }}"></script>
        <script>
            var lngKey = "{{ lngKey() }}"
        </script>
    </body> 
</html>
