<!DOCTYPE html>
<html>

<title>SL Police</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Styles -->

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Sri Lanka Police</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
{{--<link href="{{asset('dist/css/AdminLTE.min.cs')}}">--}}
{{--<link href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">--}}
{{--<link href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">--}}
{{--<link href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">--}}
{{--<link href="{{asset('dist/css/skins/_all-skins.min.css')}}">--}}
{{--<link href="{{asset('bower_components/morris.js/morris.css')}}">--}}
{{--<link href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">--}}
{{--<link href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">--}}
{{--<link href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">--}}
{{--<link href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">--}}
{{--<link href="{{asset('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js')}}">--}}
{{--<link href="{{asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}">--}}
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

<!-- Morris chart -->
<link rel="stylesheet" href="bower_components/morris.js/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
<!-- Date Picker -->
<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


<style>
    html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="container-fluid" style="background-color: #151516">
<?php
use Illuminate\Support\Facades\DB;
?>

<!-- Navbar -->
<nav class="navbar navbar-static-top" style="background-color: #15253f">
    <!-- Sidebar toggle button-->

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="nav nav-item ">
                <a class="nav nav-link" style="margin-left: 10px" href="RegisteredCitizen">{{ __('Home') }}</a>
            </li>
        </ul>
        <ul class="nav navbar-nav" style="float: right;">
            <!-- Messages: style can be found in dropdown.less-->
            {{--<li class="dropdown messages-menu">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                    {{--<i class="fa fa-envelope-o"></i>--}}
                    {{--<span class="label label-success">4</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li class="header">You have 4 messages</li>--}}
                    {{--<li>--}}
                        {{--<!-- inner menu: contains the actual data -->--}}
                        {{--<ul class="menu">--}}
                            {{--<li><!-- start message -->--}}
                                {{--<a href="#">--}}
                                    {{--<div class="pull-left">--}}
                                        {{--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}
                                    {{--</div>--}}
                                    {{--<h4>--}}
                                        {{--Support Team--}}
                                        {{--<small><i class="fa fa-clock-o"></i> 5 mins</small>--}}
                                    {{--</h4>--}}
                                    {{--<p>Why not buy a new awesome theme?</p>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<!-- end message -->--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<div class="pull-left">--}}
                                        {{--<img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">--}}
                                    {{--</div>--}}
                                    {{--<h4>--}}
                                        {{--AdminLTE Design Team--}}
                                        {{--<small><i class="fa fa-clock-o"></i> 2 hours</small>--}}
                                    {{--</h4>--}}
                                    {{--<p>Why not buy a new awesome theme?</p>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<div class="pull-left">--}}
                                        {{--<img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">--}}
                                    {{--</div>--}}
                                    {{--<h4>--}}
                                        {{--Developers--}}
                                        {{--<small><i class="fa fa-clock-o"></i> Today</small>--}}
                                    {{--</h4>--}}
                                    {{--<p>Why not buy a new awesome theme?</p>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<div class="pull-left">--}}
                                        {{--<img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">--}}
                                    {{--</div>--}}
                                    {{--<h4>--}}
                                        {{--Sales Department--}}
                                        {{--<small><i class="fa fa-clock-o"></i> Yesterday</small>--}}
                                    {{--</h4>--}}
                                    {{--<p>Why not buy a new awesome theme?</p>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<div class="pull-left">--}}
                                        {{--<img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">--}}
                                    {{--</div>--}}
                                    {{--<h4>--}}
                                        {{--Reviewers--}}
                                        {{--<small><i class="fa fa-clock-o"></i> 2 days</small>--}}
                                    {{--</h4>--}}
                                    {{--<p>Why not buy a new awesome theme?</p>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="footer"><a href="#">See All Messages</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <!-- Notifications: style can be found in dropdown.less -->
            {{--<li class="dropdown notifications-menu">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                    {{--<i class="fa fa-bell-o"></i>--}}
                    {{--<span class="label label-warning">10</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li class="header">You have 10 notifications</li>--}}
                    {{--<li>--}}
                        {{--<!-- inner menu: contains the actual data -->--}}
                        {{--<ul class="menu">--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-users text-aqua"></i> 5 new members joined today--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the--}}
                                    {{--page and may cause design problems--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-users text-red"></i> 5 new members joined--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-shopping-cart text-green"></i> 25 sales made--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-user text-red"></i> You changed your username--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="footer"><a href="#">View all</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}


            {{--<!-- Tasks: style can be found in dropdown.less -->--}}
            {{--<li class="dropdown tasks-menu">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                    {{--<i class="fa fa-flag-o"></i>--}}
                    {{--<span class="label label-danger">9</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li class="header">You have 9 tasks</li>--}}
                    {{--<li>--}}
                        {{--<!-- inner menu: contains the actual data -->--}}
                        {{--<ul class="menu">--}}
                            {{--<li><!-- Task item -->--}}
                                {{--<a href="#">--}}
                                    {{--<h3>--}}
                                        {{--Design some buttons--}}
                                        {{--<small class="pull-right">20%</small>--}}
                                    {{--</h3>--}}
                                    {{--<div class="progress xs">--}}
                                        {{--<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"--}}
                                             {{--aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                            {{--<span class="sr-only">20% Complete</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<!-- end task item -->--}}
                            {{--<li><!-- Task item -->--}}
                                {{--<a href="#">--}}
                                    {{--<h3>--}}
                                        {{--Create a nice theme--}}
                                        {{--<small class="pull-right">40%</small>--}}
                                    {{--</h3>--}}
                                    {{--<div class="progress xs">--}}
                                        {{--<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"--}}
                                             {{--aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                            {{--<span class="sr-only">40% Complete</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<!-- end task item -->--}}
                            {{--<li><!-- Task item -->--}}
                                {{--<a href="#">--}}
                                    {{--<h3>--}}
                                        {{--Some task I need to do--}}
                                        {{--<small class="pull-right">60%</small>--}}
                                    {{--</h3>--}}
                                    {{--<div class="progress xs">--}}
                                        {{--<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"--}}
                                             {{--aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                            {{--<span class="sr-only">60% Complete</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<!-- end task item -->--}}
                            {{--<li><!-- Task item -->--}}
                                {{--<a href="#">--}}
                                    {{--<h3>--}}
                                        {{--Make beautiful transitions--}}
                                        {{--<small class="pull-right">80%</small>--}}
                                    {{--</h3>--}}
                                    {{--<div class="progress xs">--}}
                                        {{--<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"--}}
                                             {{--aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                            {{--<span class="sr-only">80% Complete</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<!-- end task item -->--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="footer">--}}
                        {{--<a href="#">View all tasks</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}



            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php
                    $nic=Auth::User()->nic;
                    $citizenDetails = db::table('users')->where('nic',$nic)->First();
                    ?>
                    <img src='{{asset('/userProfileImages/'.$citizenDetails->nic.'.jpg')}}' class="user-image" alt="User Image">
                    <span class="hidden-xs">{{Auth::User()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src='{{asset('/userProfileImages/'.$citizenDetails->nic.'.jpg')}}' class="img-circle" alt="User Image">

                        <p style="background-color: #29292d;padding: 5px">
                            {{$citizenDetails->name}}
                            <small>{{$citizenDetails->profession}}</small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body" style="background-color:lightgrey">

                        <div>
                            <a href="citizenProfileFormView" class="btn btn-default btn-flat" style="width:100%">Update Profile</a>
                        </div>
                            <br>
                        <div>
                            <a href="deactivateCitizenForm" class="btn btn-default btn-flat" style="width:100%">Deactivate Account</a>
                        </div>
                        <br>
                        <div>
                            <a href="changePasswordFormView" class="btn btn-default btn-flat" style="width:100%">Change Password</a>
                        </div>
                        <br>
                        <div>
                            <a href="logout" class="btn btn-default btn-flat" style="width:100%">Sign out</a>
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    {{--<li class="user-footer">--}}
                        {{--<div class="pull-left">--}}
                            {{--<a href="citizenProfileFormView" class="btn btn-default btn-flat">Profile</a>--}}
                        {{--</div>--}}
                        {{--<div class="pull-right">--}}
                            {{--<a href="logout" class="btn btn-default btn-flat">Sign out</a>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                </ul>
            </li>
        </ul>
    </div>
</nav>

@yield('content1')
{{--<div class="w3-top">--}}
{{--<div class="w3-bar w3-theme-d2 w3-left-align w3-large">--}}
{{--<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>--}}
{{--<a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>--}}
{{--<div class="">--}}
{{--<div class="w3-dropdown-hover w3-hide-small w3-right">--}}
{{--<button class="w3-button w3-padding-large w3-right" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></button>--}}
{{--<div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">--}}
{{--<a href="#" class="w3-bar-item w3-button">One new friend request</a>--}}
{{--<a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>--}}
{{--<a href="#" class="w3-bar-item w3-button">Jane likes your post</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="Messages"><i class="fa fa-envelope"></i></a>--}}
{{--<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="Account Settings"><i class="fa fa-user"></i></a>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}

<!-- Navbar on small screens -->
{{--<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">--}}
{{--<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>--}}
{{--<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>--}}
{{--<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>--}}
{{--<a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>--}}
{{--</div>--}}

<!-- Page Container -->


<!-- End Page Container -->
<br>

<!-- Footer -->

<footer class="w3-container w3-theme-d5">
    <p style="padding: 10px;"> <strong>Crime Reporting System  Group 26</strong></p>
</footer>

<script>
    // Accordion
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-theme-d1";
        } else {
            x.className = x.className.replace("w3-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace(" w3-theme-d1", "");
        }
    }

    // Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>

</body>
</html>
