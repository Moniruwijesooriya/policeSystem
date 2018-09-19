<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Crime Reporting System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('login') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif<br><br>
    {{--<div class="row">--}}

        {{--<div class="col-md-10">--}}


            {{--<div class="content">--}}
                {{--<div class="title m-b-md">--}}
                    {{--Crime Reporting System--}}
                {{--</div>--}}

                {{--<div class="w3-content w3-section" style="max-width:1000px">--}}
                    {{--<img class="mySlides" src='{{asset('/img/police1.jpg')}}' style="width:100%">--}}
                    {{--<img class="mySlides" src='{{asset('/img/police3.jpg')}}' style="width:100%">--}}
                    {{--<img class="mySlides" src='{{asset('/img/police4.jpg')}}' style="width:100%">--}}
                {{--</div>--}}
                {{--<script>--}}
                    {{--var myIndex = 0;--}}
                    {{--carousel();--}}

                    {{--function carousel() {--}}
                        {{--var i;--}}
                        {{--var x = document.getElementsByClassName("mySlides");--}}
                        {{--for (i = 0; i < x.length; i++) {--}}
                            {{--x[i].style.display = "none";--}}
                        {{--}--}}

                        {{--myIndex++;--}}
                        {{--if (myIndex > x.length) {myIndex = 1}--}}
                        {{--x[myIndex-1].style.display = "block";--}}
                        {{--setTimeout(carousel, 2000); // Change image every 2 seconds--}}

                    {{--}--}}

                {{--</script>--}}
            {{--</div>--}}
        {{--</div>--}}
        @include('Districts.districts')
    </div>
</div>
</body>
</html>
