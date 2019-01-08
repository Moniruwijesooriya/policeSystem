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

    <title>SL Police</title>

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
<body style="background-image: url('/img/swirl_pattern.png')">
<div id="app">
    <nav class="navbar  navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->

                @guest
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item ">
                            <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::User()->role=='citizen')
                            <a class="navbar-brand" href="{{'RegisteredCitizen'}}">
                                Home
                            </a>
                        @endif
                        @if(Auth::User()->role=='Officer Incharge of Police Station')
                            <a class="navbar-brand" href="{{'OIC'}}">
                                Home
                            </a>
                        @endif
                        @if(Auth::User()->role=='Inspector General of Police')
                            <a class="navbar-brand" href="{{'IGP'}}">
                                Home
                            </a>
                        @endif
                        @if(Auth::User()->role=='Branch Officer Incharge')
                            <a class="navbar-brand" href="{{'BOIC'}}">
                                Home
                            </a>
                        @endif
                        @if(Auth::User()->role=='Division Officer Incharge')
                            <a class="navbar-brand" href="{{'DOIG'}}">
                                Home
                            </a>
                        @endif
                            @if(Auth::User()->role=='admin')
                                <a class="navbar-brand" href="{{'admin'}}">
                                    Home
                                </a>
                            @endif
                    </ul>

                    <?php
                    $loggedUser=db::table('users')->where('nic',Auth::User()->nic)->first();
                    ?>
                    <ul class="navbar-nav ml-auto">
                        <li>
                            <div class="w3-dropdown-hover w3-hide-small">
                                @if(Auth::User()->role=='admin')
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('users')->where('verified',"n")->where('role',"citizen")->count()}}</span>
                                        </button>
                                        <?php
                                        $count=db::table('users')->where('verified',"No")->where('role',"citizen")->count();
                                        ?>
                                        @if($count>0)
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                <?php
                                                $notification=db::table('users')->where('verified',"No")->where('role',"citizen")->get();
                                                ?>
                                                @foreach($notification as $notifi)

                                                    <form method="post" action="{{'reviewCitizenRegistrationRequest'}}">
                                                        @csrf
                                                        <input type="hidden" value="{{$notifi->nic}}" name="nic">
                                                        <input type="submit" class="btn-link" value="{{$notifi->nic}} requested a registration request">
                                                    </form>

                                            @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </li>
                        @if(Auth::User()->role=='Officer Incharge of Police Station')

                            <li>
                                <div class="w3-dropdown-hover w3-hide-small">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('users')->where('verified',"No")->where('role',"citizen")->where('policeOffice',$loggedUser->policeOffice)->count()}}</span>
                                        </button>
                                        <?php
                                        $count=db::table('users')->where('verified',"No")->where('role',"citizen")->where('policeOffice',$loggedUser->policeOffice)->count();
                                        ?>
                                        @if($count>0)
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                <?php
                                                $notification=db::table('users')->where('verified',"No")->where('role',"citizen")->where('policeOffice',$loggedUser->policeOffice)->get();
                                                ?>
                                                @foreach($notification as $notifi)

                                                    <form method="post" action="{{'reviewCitizenRegistrationRequest'}}">
                                                        @csrf
                                                        <input type="hidden" value="{{$notifi->nic}}" name="nic">
                                                        <input type="submit" class="btn-link" value="{{$notifi->nic}} requested a registration request">
                                                    </form>

                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
                            </li>
                            <li>
                                <div class="w3-dropdown-hover w3-hide-small">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->count()}}</span>
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <?php
                                            $notification=db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->get();
                                            ?>
                                            @foreach($notification as $notifi)
                                                <form method="post" action="{{'viewOICEntry'}}">
                                                    @csrf
                                                    <input type="hidden" value="{{$notifi->entryID}}" name="entryID">
                                                    <input type="submit" class="btn-link" value="{{$notifi->complainantID}} submitted a crime">
                                                </form>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                        <li>
                            @if(Auth::User()->role=='Branch Officer Incharge')

                                <div class="w3-dropdown-hover w3-hide-small">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('entries')->where('boicNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->count()}}</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                                            <?php
                                            $notification=db::table('entries')->where('boicNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->get();
                                            ?>
                                            @foreach($notification as $notifi)
                                                <form method="post" action="{{'viewBOICEntry'}}">
                                                    @csrf
                                                    <input type="hidden" value="{{$notifi->entryID}}" name="entryID">
                                                    <input type="submit" class="btn-link" value="{{$notifi->complainantID}} received an entry">
                                                </form>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                                @if(Auth::User()->role=='Division Officer Incharge')

                                    <div class="w3-dropdown-hover w3-hide-small">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('entries')->where('doigNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->count()}}</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                                                <?php
                                                $notification=db::table('entries')->where('doigNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->get();
                                                ?>
                                                @foreach($notification as $notifi)
                                                    <form method="post" action="{{'viewBOICEntry'}}">
                                                        @csrf
                                                        <input type="hidden" value="{{$notifi->entryID}}" name="entryID">
                                                        <input type="submit" class="btn-link" value="{{$notifi->complainantID}} received an entry">
                                                    </form>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(Auth::User()->role=='Division Officer Incharge')

                                    <div class="w3-dropdown-hover w3-hide-small">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{db::table('entries')->where('doigNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->count()}}</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                                                <?php
                                                $notification=db::table('entries')->where('doigNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->get();
                                                ?>
                                                @foreach($notification as $notifi)
                                                    <form method="post" action="{{'viewBOICEntry'}}">
                                                        @csrf
                                                        <input type="hidden" value="{{$notifi->entryID}}" name="entryID">
                                                        <input type="submit" class="btn-link" value="{{$notifi->complainantID}} received an entry">
                                                    </form>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                        </li>
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
