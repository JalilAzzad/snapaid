                {{--<div class="navbar-header">--}}

                    {{--<!-- Collapsed Hamburger -->--}}
                    {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">--}}
                        {{--<span class="sr-only">Toggle Navigation</span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                    {{--</button>--}}

                    {{--<!-- Branding Image -->--}}
                    {{--<a href="{{ url('/') }}" class="logo"><img class="img-responsive" src="{!! url('/images/logo.png') !!}" alt="logo" /></a>--}}
                {{--</div>--}}

                {{--<div class="collapse navbar-collapse" id="app-navbar-collapse">--}}
                    {{--<!-- Left Side Of Navbar -->--}}
                    {{--<ul class="nav navbar-nav">--}}
                        {{--<li><a href="{{ url('/') }}">Home</a></li>--}}
                        {{--<li><a href="{{ url('/faq') }}">FAQ</a></li>--}}
                        {{--<li><a href="{{ url('/causes') }}">Causes</a></li>--}}
                    {{--</ul>--}}

                    {{--<!-- Right Side Of Navbar -->--}}
                    {{--<ul class="nav navbar-nav navbar-right">--}}
                        {{--<!-- Authentication Links -->--}}
                        {{--@if (auth()->guest())--}}
                            {{--<li><a href="{{ route('login') }}" class="signin">Signin</a></li>--}}
                            {{--<li><a href="{{ route('register') }}" class="signup">Signup</a></li>--}}
                        {{--@else--}}
                            {{--<li class="dropdown">--}}
                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                                    {{--{{ auth()->user()->firstname . " " . auth()->user()->lastname }} <span class="caret"></span>--}}
                                {{--</a>--}}

                                {{--<ul class="dropdown-menu" role="menu">--}}
                                    {{--<li>--}}
                                        {{--<a href="{{ route('logout') }}"--}}
                                            {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                            {{--Signout--}}
                                        {{--</a>--}}

                                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                            {{--{{ csrf_field() }}--}}
                                        {{--</form>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--@endif--}}
                    {{--</ul>--}}
                {{--</div>--}}

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Snap Aid') }}</title>
    <meta property="og:url"           content="{{request()->url()}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="@if(isset($cause->title)) {{$cause->title}} - @endif{{ config('app.name', 'Snap Aid') }}" />
    <meta property="og:description"   content="@if(isset($cause->description)) {{$cause->description}} @endif" />
    <meta property="og:image"         content="@if(isset($cause->file_ext)) {{ url('/images/causes/'.$cause->id.'.'.$cause->file_ext) }} @endif" />


    <link rel="icon" type="image/png" href="{{ url('/assets/images/favicons/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('/assets/images/favicons/apple-touch-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('/assets/images/favicons/apple-touch-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('/assets/images/favicons/apple-touch-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('/assets/images/favicons/apple-touch-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('/assets/images/favicons/apple-touch-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('/assets/images/favicons/apple-touch-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/assets/images/favicons/apple-touch-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('/assets/images/favicons/apple-touch-icon-152x152.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

    @if( Request::is('/') || request()->route() == 'home' || request()->route() == 'index')

        <div id="navBar">
            <div class="navButton">
                <img src="/img/nav-icon-open.gif" alt="navbar">
                <span>Menu</span>
            </div>
            <div class="navvv">
                <nav>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a href="{{ url('/causes') }}">Causes</a></li>
                        @if(auth()->check())
                            <li><a href="{{ url('logout') }}">logout</a></li>
                        @else
                            <li><a href="{{ route('login') }}">login</a></li>
                            <li><a href="{{ route('register') }}">Sign up</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>



        <div class="container-fluid">
            <div class="container">
                <div class="row align-items-center top-nav">
                    <div class="col-4">
                        <img src="/img/logo.png" class="logo" alt="logo">
                    </div>

                    <div class="col-8 nav-bar">
                        <ul class="nav justify-content-end align-items-center">
                            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="{{ url('/faq') }}" class="nav-link">FAQ</a></li>
                            <li class="nav-item"><a href="{{ url('/causes') }}" class="nav-link">Causes</a></li>
                            @if(auth()->check())
                                <li class="nav-item signup"><a href="{{ url('logout') }}" class="nav-link">logout</a></li>
                            @else
                                <li class="nav-item login"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                                <li class="nav-item signup"><a href="{{ route('register') }}" class="nav-link">Signup</a></li>
                            @endif
                        </ul>
                    </div>
                </div>


                <div class="row align-items-center top-content justify-content-between d-md-flex flex-lg-row flex-column-reverse">
                    <div class="col-lg-6 col-md-12"><img class="img-fluid" src="/img/child.png" alt="child"></div>
                    <div class="col-lg-5 col-md-12 justify-content-center ">
                        <p>
                            Donate to a Cause with no out of pocket cost.
                            Try a service join a trial download an app...
                            These are some things that can be
                            done to fund a cause
                        </p>

                        <a class="btn btn-danger btn-lg btn-red" href="{{url('/causes')}}" role="button">Donate</a>
                    </div>
                </div>

            </div>
            <div class="red-bg"></div>
        </div>

    @else
        <div id="navBar">
            <div class="navButton">
                <img src="/img/nav-icon-open.gif" alt="navbar">
                <span>Menu</span>
            </div>
            <div class="navvv">
                <nav>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a href="{{ url('/causes') }}">Causes</a></li>
                        @if(auth()->check())
                            <li><a href="{{ url('logout') }}">logout</a></li>
                        @else
                            <li><a href="{{ route('login') }}">login</a></li>
                            <li><a href="{{ route('register') }}">Sign up</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>



        <div class="container-fluid nav2">
            <div class="container">
                <div class="row align-items-center top-nav2">
                    <div class="col-4">
                        <img src="/img/logo.png" class="logo" alt="logo">
                    </div>

                    <div class="col-8 nav-bar2">
                        <ul class="nav justify-content-end align-items-center">
                            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="{{ url('/faq') }}" class="nav-link">FAQ</a></li>
                            <li class="nav-item"><a href="{{ url('/causes') }}" class="nav-link">Causes</a></li>
                            @if(auth()->check())
                                <li class="nav-item signup"><a href="{{ url('logout') }}" class="nav-link">logout</a></li>
                            @else
                                <li class="nav-item login"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                                <li class="nav-item signup"><a href="{{ route('register') }}" class="nav-link">Signup</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    @endif

    @yield('content')

    <div class="container-fluid footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 footerimg" >
                    <img src="/img/logo.png" alt="logo" style="width: 227px;">
                    {{--<br class="visible-sm-down" /><br class="visible-sm-down" />--}}
                    <p class="text-bottom" style="padding-bottom: 20px;">&copy; 2017 Snapaid.org | All rights reserved. <br> Created by <a href="http://tevarj.com" target="_blank">Tevar J</a> & <a href="https://generalsandgreatminds.com" target="_blank">Generals & Great Minds LLC</a></p>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="row justify-content-end">
                        <div class="col-lg-3 col-6 ">
                            <h5>ASSISTANCE</h5>
                            <nav class="nav flex-column">
                                <a class="nav-link" href="{{ url('faq') }}">FAQ's</a>
                                <a class="nav-link" href="#">Guides</a>
                            </nav>
                        </div>

                        <div class="col-lg-3 col-6">
                            <h5>COMPANY</h5>
                            <nav class="nav flex-column">
                                <a class="nav-link" href="#">Press Kit</a>
                                <a class="nav-link" href="{{ url('contact') }}">Contact Us</a>
                                <a class="nav-link" href="{{ url('terms') }}">Terms Of Service</a>
                                <a class="nav-link" href="{{ url('privacy') }}">Privacy Policy</a>
                            </nav>
                        </div>

                        <div class="col-lg-3 col-12 social-media-1">
                            <h5>Social Media</h5>
                            <nav class="nav flex-column">
                                <a class="nav-link" href="https://www.facebook.com/snapaidfunding/" target="_blank"><i class="fa fa-facebook"></i> &nbsp;&nbsp;&nbsp;&nbsp; Facebook </a>
                                <a class="nav-link" href="#" target="_blank"><i class="fa fa-google-plus"></i> &nbsp; Google Plus</a>
                                <a class="nav-link" href="https://www.instagram.com/snapaidfunding/" target="_blank"><i class="fa fa-instagram"></i> &nbsp;&nbsp;&nbsp;&nbsp;Instagram</a>
                                <a class="nav-link" href="https://twitter.com/snapaidfunding" target="_blank"><i class="fa fa-twitter"></i> &nbsp;&nbsp;&nbsp;Twitter</a>
                            </nav>
                        </div>

                        <div class="col-12 social-media-2">
                            <h5>Social Media</h5>
                            <nav class="nav">
                                <a class="nav-link" href="#" style="padding-top: 0;"><i class="fa fa-facebook-official"></i></a>
                                <a class="nav-link" href="#" style="padding-top: 0;"><i class="fa fa-google-plus-square"></i></a>
                                <a class="nav-link" href="https://www.instagram.com/snapaidfunding/" style="padding-top: 0;"><i class="fa fa-instagram"></i></a>
                                <a class="nav-link" href="#" style="padding-top: 0;"><i class="fa fa-twitter-square"></i></a>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.imgcheckbox.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
    <script type="text/javascript">



        $( ".navButton" ).click(function() {
            $( this ).toggleClass( "active" );
            $(".navvv").slideToggle();
        });



        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 220
                }, 1000);
            }
        });



        var windowWidth = $(window).width()

        if (windowWidth < 973)
        {
            $('.mob-des .row').addClass('justify-content-center');
            $('.footerimg').addClass('text-center');
        }










        $("img.checkable").imgCheckbox({

            "scaleSelected" :false ,
            "graySelected" : false,
            "fixedImageSize":"auto 30px",
            "checkMarkSize" : "0px",
            "addToForm" : true,
            "styles": {
                "span.imgCheckbox.imgChked img": {

                    "filter": "grayscale(0)",
                    "-webkit-filter": "grayscale(0)",
                    "-moz-filter":"grayscale(0)",
                    "ms-filter":"grayscale(0)",
                    "-o-filter":"grayscale(0)",
                    "border-color":"white"
                },

                "span.imgCheckbox.imgChked": {

                    "border": "0",
                    "background-color":"white",
                    "border-radius":"5px"
                }
            }


        });




        $("img.checkable2").imgCheckbox({

            "scaleSelected" :false ,
            "graySelected" : false,
            "fixedImageSize":"auto 30px",
            "checkMarkSize" : "0px",
            "addToForm" : true,
            "styles": {
                "span.imgCheckbox.imgChked img": {

                    "border-color":"#f53123"
                },

                "span.imgCheckbox.imgChked": {

                    "border": "0",
                    "background-color":"white",
                    "border-radius":"5px"
                }
            }


        });
    </script>
    @yield('scripts')

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-37796498-15', 'auto');
        ga('send', 'pageview');

    </script>

</body>
</html>