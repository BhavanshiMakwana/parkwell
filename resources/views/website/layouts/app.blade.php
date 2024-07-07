<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" href="{{ URL::asset('assets/website/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/website/plugins/themefisher-font/style.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/website/plugins/slick/slick.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/website/plugins/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/website/css/style.css')}}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/website/images/favicon.png')}}">
    <style>.help-block{color: #ff0000;}</style>
</head>
@php $class = $menu == 'Home' ? 'scrollTo' : ''; @endphp
<body class="body-wrapper">
<nav class="navbar main-nav fixed-top navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('assets/website/images/logo1.png')}}" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="tf-ion-android-menu"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{$class}}" href="@if($menu == 'Home') #home @else {{url('/')}} @endif">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$class}}" href="@if($menu == 'Home') #about @else {{url('/')}} @endif">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$class}}" href="@if($menu == 'Home') #pricing @else {{url('/')}} @endif">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$class}}" href="@if($menu == 'Home') #contact @else {{url('/')}} @endif">Contact</a>
                </li>

                @if(session()->has('logged_user'))
                    <li class="nav-item">
                        <a class="nav-link @if($menu == 'My Account') btn btn-main-rounded other-btn @endif" href="{{url('my-account')}}">My Account</a>
                    </li>
                @else
                    <li class="nav-item mr-3">
                        <a class="nav-link btn btn-main-rounded other-btn" href="{{url('login')}}">Login / Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="footer-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mr-auto">
                <div class="footer-logo">
                    <img src="{{url('assets/website/images/logo1.png')}}" alt="footer-logo">
                </div>
                <div class="copyright">
                    <p>@ {{ date('Y') }} QR Code All Rights Reserved</p>
                </div>
            </div>
            <div class="col-lg-6 text-lg-right">
                <ul class="social-icons list-inline">
                    <li class="list-inline-item">
                        <a href=""><i class="tf-ion-social-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href=""><i class="tf-ion-social-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href=""><i class="tf-ion-social-linkedin"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href=""><i class="tf-ion-social-instagram-outline"></i></a>
                    </li>
                </ul>
                <ul class="footer-links list-inline">
                    <li class="list-inline-item">
                        <a href="@if($menu == 'Home') #about @else {{url('/')}} @endif" class="{{$class}}">ABOUT</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="@if($menu == 'Home') #pricing @else {{url('/')}} @endif" class="{{$class}}">PRICING</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="@if($menu == 'Home') #contact @else {{url('/')}} @endif" class="{{$class}}">CONTACT</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{url('privacy-policy')}}" target="_blank">PRIVACY POLICY</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI14J_PNWVd-m0gnUBkjmhoQyNyd7nllA" async defer></script>
<script src="{{ URL::asset('assets/website/plugins/jquery/jquery.js')}}"></script>
<script src="{{ URL::asset('assets/website/plugins/popper/popper.min.js')}}"></script>
<script src="{{ URL::asset('assets/website/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/website/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
<script src="{{ URL::asset('assets/website/plugins/slick/slick.min.js')}}"></script>
<script src="{{ URL::asset('assets/website/js/custom.js')}}"></script>
</body>

</html>
