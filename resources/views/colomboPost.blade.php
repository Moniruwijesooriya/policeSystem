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
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif<br><br>
    <div class="row">

        <div class="col-md-10">


            <div class="content">
                <div class="title m-b-md">
                    Crime Reporting System
                </div>

                <div class="links">
                    {{--<a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>--}}
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <p class="h3">Districts</p>
            <ul class="locations-1"><li>
                    <a href="/en/ads/col" data-id='1506'>Colombo</a></li>
                <li><a href="/en/ads/kandy" data-id='1636'>Kandy</a>
                </li><li><a href="/en/ads/galle" data-id='1559'>Galle</a>
                </li></ul><ul class="locations-2"><li><a href="/en/ads/ampara" data-id='1432'>Ampara</a></li>
                <li><a href="/en/ads/anuradhapura" data-id='1452'>Anuradhapura</a></li>
                <li><a href="/en/ads/badulla" data-id='1475'>Badulla</a></li>
                <li><a href="/en/ads/batticaloa" data-id='1491'>Batticaloa</a></li>
                <li><a href="/en/ads/gampaha" data-id='1577'>Gampaha</a></li>
                <li><a href="/en/ads/hambantota" data-id='1592'>Hambantota</a></li>
                <li><a href="/en/ads/jaffna" data-id='1605'>Jaffna</a></li>
                <li><a href="/en/ads/kalutara" data-id='1620'>Kalutara</a></li>
                <li><a href="/en/ads/kegalle" data-id='1658'>Kegalle</a></li>
                <li><a href="/en/ads/kilinochchi" data-id='1670'>Kilinochchi</a></li>
                <li><a href="/en/ads/kurunegala" data-id='1674'>Kurunegala</a></li>
                <li><a href="/en/ads/mannar" data-id='1706'>Mannar</a></li>
                <li><a href="/en/ads/matale" data-id='1712'>Matale</a></li>
                <li><a href="/en/ads/matara" data-id='1724'>Matara</a></li>
                <li><a href="/en/ads/moneragala" data-id='1740'>Moneragala</a></li>
                <li><a href="/en/ads/mullativu" data-id='1752'>Mullativu</a></li>
                <li><a href="/en/ads/nuwara-eliya" data-id='1757'>Nuwara Eliya</a></li>
                <li><a href="/en/ads/polonnaruwa" data-id='1763'>Polonnaruwa</a></li>
                <li><a href="/en/ads/puttalam" data-id='1771'>Puttalam</a></li>
                <li><a href="/en/ads/ratnapura" data-id='1788'>Ratnapura</a></li>
                <li><a href="/en/ads/trincomalee" data-id='1806'>Trincomalee</a></li>
                <li><a href="/en/ads/vavuniya" data-id='1818'>Vavuniya</a></li></ul>


        </div>
    </div>
</div>
</body>
</html>
