<?php
use Illuminate\Support\Facades\DB;
?>
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Crime Reporting System') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
            {{--{{ config('app.name', 'Laravel') }}--}}
            {{--</a>--}}

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else

                        <li>

                            <!-- Navbar -->

                            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>

                            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
                            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
                            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
                            <div class="w3-dropdown-hover w3-hide-small">
                                @if(Auth::User()->role=='admin')
                                    {{--<button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('citizen_registration_notifs')->where('verified',"n")->count()}}</span></button>--}}
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('users')->where('verified',"n")->where('role',"citizen")->count()}}</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <?php
                                        $notification=db::table('users')->where('verified',"n")->where('role',"citizen")->get();
                                        ?>
                                        @foreach($notification as $notifi)

                                                <form method="post" action="{{'reviewCitizenRegistrationRequest'}}">
                                                    @csrf
                                                    <input type="hidden" value="{{$notifi->nic}}" name="nic">
                                                    <input type="submit" class="btn-link" value="{{$notifi->nic}} requested a registration request">
                                                </form>



                                            @endforeach
                                            @endif

                                            @if(Auth::User()->role=='Officer Incharge of Police Station')
                                                <?php
                                                $policeOffice=db::table('users')->where('nic',Auth::User()->nic)->first();
                                                ?>
                                                {{--<button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('citizen_registration_notifs')->where('verified',"n")->count()}}</span></button>--}}
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$policeOffice->policeOffice)->count()}}</span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                                                    <?php
                                                    $notification=db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$policeOffice->policeOffice)->get();
                                                    ?>
                                                    @foreach($notification as $notifi)
                                                            <form method="post" action="{{'viewOICEntry'}}">
                                                                @csrf
                                                                <input type="hidden" value="{{$notifi->entryID}}" name="entryID">
                                                                <input type="submit" class="btn-link" value="{{$notifi->complainantID}} submitted a crime">
                                                        </form>


                                                        @endforeach
                                                        @endif

                                                        @if(Auth::User()->role=='Branch Officer Incharge')
                                                            <?php
                                                            $policeOffice=db::table('users')->where('nic',Auth::User()->nic)->first();
                                                            ?>
                                                            {{--<button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('citizen_registration_notifs')->where('verified',"n")->count()}}</span></button>--}}
                                                            <div class="dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('entries')->where('boicNotification',"y")->where('nearestPoliceStation',$policeOffice->policeOffice)->count()}}</span>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                                                                    <?php
                                                                    $notification=db::table('entries')->where('boicNotification',"y")->where('nearestPoliceStation',$policeOffice->policeOffice)->get();
                                                                    ?>
                                                                    @foreach($notification as $notifi)
                                                                        <form method="post" action="{{'viewBOICEntry'}}">
                                                                            @csrf
                                                                            <input type="hidden" value="{{$notifi->entryID}}" name="entryID">
                                                                            <input type="submit" class="btn-link" value="{{$notifi->complainantID}} received an entry">
                                                                        </form>


                                                                    @endforeach
                                                                    @endif



                                        </div>
                                    </div>
                                    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
                                    </a>

                        <li class="nav-item dropdown">


                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>


                    @endguest
                </ul>
            </div>
        </div>




    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>

</html>
