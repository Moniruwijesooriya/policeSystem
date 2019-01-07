<!DOCTYPE html>
<html>
<head>
    <?php
    use Illuminate\Support\Facades\DB;
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <!-- CSRF Token --> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <!-- Scripts --> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- <!-- Fonts --> --}}
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    {{-- <!-- jQuery library --> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- <!-- Styles --> --}}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OIC Panel</title>
    {{-- <!-- Tell the browser to be responsive to screen width --> --}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- <!-- Bootstrap 3.3.7 --> --}}
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    {{-- <!-- Font Awesome --> --}}
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    {{-- <!-- Ionicons --> --}}
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    {{-- <!-- Theme style --> --}}
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    {{-- <!-- AdminLTE Skins. Choose a skin from the css/skins --}}
         {{-- folder instead of downloading all of them to reduce the load. --> --}}
    {{-- <link href="{{asset('dist/css/AdminLTE.min.cs')}}"> --}}
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
    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


    {{-- <!-- Morris chart --> --}}
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    {{-- <!-- jvectormap --> --}}
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    {{-- <!-- Date Picker --> --}}
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    {{-- <!-- Daterange picker --> --}}
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    {{-- <!-- bootstrap wysihtml5 - text editor --> --}}
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- <!-- Google Font --> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .table-col {
            width: auto;
            height: auto;
            min-height: 10%;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            margin: 0.5% 0.5% 0.5% 0.5%;
            padding: 1% 1% 1% 1%;
            opacity: 1;

            box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
            -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
            -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        }   
        .tc-left{
            min-width: 10%;
        }
        .tc-middle{
            min-width: 50%;
            
        }
        .tc-right{
            min-width: 30%;
            padding-left: 3%;
        }
    </style>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        {{-- <!-- Logo --> --}}

        <a href="OIC" class="logo">

            {{-- <!-- mini logo for sidebar mini 50x50 pixels --> --}}
            <span class="logo-mini"><b>OIC</b></span>
            {{-- <!-- logo for regular state and mobile devices --> --}}
            <span class="logo-lg"><b>OIC</b> PANEL</span>
        </a>
        {{-- <!-- Header Navbar: style can be found in header.less --> --}}
        <nav class="navbar navbar-static-top">
            {{-- <!-- Sidebar toggle button--> --}}
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    {{-- <!-- Messages: style can be found in dropdown.less--> --}}
                    <?php
                    $loggedUser=db::table('users')->where('nic',Auth::User()->nic)->first();
                    ?>
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                {{-- <!-- inner menu: contains the actual data --> --}}
                                <ul class="menu">
                                    {{-- <li><!-- start message --> --}}
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    {{-- <!-- end message --> --}}
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                AdminLTE Design Team
                                                <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Developers
                                                <small><i class="fa fa-clock-o"></i> Today</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Sales Department
                                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Reviewers
                                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    {{-- <!-- Notifications: style can be found in dropdown.less --> --}}
                    <li class="dropdown notifications-menu">
                        <?php
                        $count=db::table('users')->where('verified',"No")->where('role',"citizen")->where('policeOffice',$loggedUser->policeOffice)->count();
                        ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">{{$count}}</span>
                        </a>
                        <ul class="dropdown-menu">

                            <li class="header">You have {{$count}} notifications</li>
                            <li>
                                {{-- <!-- inner menu: contains the actual data --> --}}

                                <ul class="menu">

                                    <?php
                                    $registerRequestNotification=db::table('users')->where('verified',"No")->where('role',"citizen")->get();
                                    ?>
                                    @foreach($registerRequestNotification as $notifi)
                                        <li>
                                            <form method="post" action="{{'reviewCitizenRegistrationRequest'}}">
                                                @csrf
                                                <input type="hidden" value="{{$notifi->nic}}" name="nic">
                                                <input type="submit" class="btn-link" value="{{$notifi->nic}} requested a registration request">
                                            </form>
                                        </li>


                                    @endforeach

                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    {{-- <!-- Tasks: style can be found in dropdown.less --> --}}
                    {{-- herrrrrrrrrrrrrrrreeeeeeeeeeeeeeee --}}
                    <li class="dropdown tasks-menu">
                        <?php
                        $entryCount=db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->count()
                        ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">{{$entryCount}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{$entryCount}} tasks</li>
                            <li>
                                {{-- <!-- inner menu: contains the actual data --> --}}
                                <ul class="menu">
                                    <?php
                                    $entryNotification=db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->get();
                                    ?>
                                    @foreach($entryNotification as $notifi)
                                            <li>
                                                <form method="post" action="{{'viewOICEntry'}}">
                                                    @csrf
                                                    <input type="hidden" value="{{$notifi->entryID}}" name="entryID">
                                                    <input type="submit" class="btn-link" value="{{$notifi->complainantID}} submitted a crime">
                                                </form>
                                            </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <!-- User Account: style can be found in dropdown.less --> --}}
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::User()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            {{-- <!-- User image --> --}}
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    {{Auth::User()->name}}
                                    <small>{{Auth::User()->profession}}</small>
                                </p>
                            </li>
                            {{-- <!-- Menu Body --> --}}
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                {{-- <!-- /.row --> --}}
                            </li>
                            {{-- <!-- Menu Footer--> --}}
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    {{-- <!-- Control Sidebar Toggle Button --> --}}
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    {{-- <!-- Left side column. contains the logo and sidebar --> --}}
    <aside class="main-sidebar">
        {{-- <!-- sidebar: style can be found in sidebar.less --> --}}
        <section class="sidebar">
            {{-- <!-- Sidebar user panel --> --}}
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::User()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            {{-- <!-- search form --> --}}
        {{--<form action="#" method="get" class="sidebar-form">--}}
        {{--<div class="input-group">--}}
        {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
        {{--<span class="input-group-btn">--}}
        {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
        {{--</button>--}}
        {{--</span>--}}
        {{--</div>--}}
        {{--</form>--}}
        {{-- <!-- /.search form --> --}}
            {{-- <!-- sidebar menu: : style can be found in sidebar.less --> --}}
            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Entries</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="viewOICNewEntries"><i class="fa fa-circle-o"></i>New Entries</a></li>
                        <li><a href="viewOICOngoingEntries"><i class="fa fa-circle-o"></i>Ongoing Entries</a></li>
                        <li><a href="viewOICClosedEntries"><i class="fa fa-circle-o"></i>Closed Entries</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Citizen Management</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="viewNewCitizenRequests"><i class="fa fa-circle-o"></i>New Registration Requests</a></li>
                        <li><a href="viewRegisteredCitizens"><i class="fa fa-circle-o"></i>Registered Citizens</a></li>
                        <li><a href="viewClosedAccounts"><i class="fa fa-circle-o"></i>Closed Accounts</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Branches</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <div id="branchOffice" class="w3-hide w3-container">
                            @foreach($branches as $branch)
                                <form method="post" action="{{'viewBranch'}}">
                                    @csrf
                                    <input type="hidden" value="{{ $branch->id }}" name="branchID">
                                    <input type="hidden" value="{{ $branch->policeOfficeArea }}" name="branchName">
                                    <input type="hidden" value="{{ $branch->mainOfficer }}" name="mainOfficer">
                                    <li><i class="fa fa-circle-o"></i><input type="submit" class="btn btn-primary" value="{{ $branch->OfficeName }}"></li>
                                </form>
                            @endforeach
                        </div>
                    </ul>
                </li>
            </ul>
        </section>
        {{-- <!-- /.sidebar --> --}}
    </aside>

    {{-- <!-- Content Wrapper. Contains page content --> --}}
    <div class="content-wrapper">
        @yield('content')
    </div>
    {{-- <!-- /.content-wrapper --> --}}
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2019  Group 26</strong> All rights
        reserved.
    </footer>
    {{-- <!-- Control Sidebar --> --}}
    <aside class="control-sidebar control-sidebar-dark">
        {{-- <!-- Create the tabs --> --}}
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        {{-- <!-- Tab panes --> --}}
        <div class="tab-content">
            {{-- <!-- Home tab content --> --}}
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                {{-- <!-- /.control-sidebar-menu --> --}}

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                {{-- <!-- /.control-sidebar-menu --> --}}

            </div>
            {{-- <!-- /.tab-pane -->
            <!-- Stats tab content --> --}}
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            {{-- <!-- /.tab-pane -->
            <!-- Settings tab content --> --}}
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    {{-- <!-- /.form-group --> --}}

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    {{-- <!-- /.form-group --> --}}

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    {{-- <!-- /.form-group --> --}}

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    {{-- <!-- /.form-group --> --}}

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    {{-- <!-- /.form-group --> --}}

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    {{-- <!-- /.form-group --> --}}
                </form>
            </div>
            {{-- <!-- /.tab-pane --> --}}
        </div>
    </aside>
    {{-- <!-- /.control-sidebar --> --}}
    {{-- <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar --> --}}
    <div class="control-sidebar-bg"></div>
</div>
{{-- <!-- ./wrapper --> --}}

{{-- <!-- jQuery 3 --> --}}
<script src="bower_components/jquery/dist/jquery.min.js"></script>
{{-- <!-- jQuery UI 1.11.4 --> --}}
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
{{-- <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip --> --}}
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
{{-- <!-- Bootstrap 3.3.7 --> --}}
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
{{-- <!-- Morris.js charts --> --}}
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
{{-- <!-- Sparkline --> --}}
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
{{-- <!-- jvectormap --> --}}
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
{{-- <!-- jQuery Knob Chart --> --}}
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
{{-- <!-- daterangepicker --> --}}
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
{{-- <!-- datepicker --> --}}
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
{{-- <!-- Bootstrap WYSIHTML5 --> --}}
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
{{-- <!-- Slimscroll --> --}}
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
{{-- <!-- FastClick --> --}}
<script src="bower_components/fastclick/lib/fastclick.js"></script>
{{-- <!-- AdminLTE App --> --}}
<script src="dist/js/adminlte.min.js"></script>
{{-- <!-- AdminLTE dashboard demo (This is only for demo purposes) --> --}}
<script src="dist/js/pages/dashboard.js"></script>
{{-- <!-- AdminLTE for demo purposes --> --}}
<script src="dist/js/demo.js"></script>
<script>
    $(document).ready(function () {
        var url = '{{route('getUserInfo')}}';
        var token = '{{Session::token()}}';
        var tempNic="";

        $(".nic-button").click(function () {
            tempNic= $(this).val();
            $.ajax({
                method: 'post',
                url: url,
                data:{
                    _token: token,
                    id: tempNic
                },
                success:function (data) {
                    $("#nicTempId").val(data.nic);
                    $("#nameTempId").val(data.name);
                    $("#fullNameTempId").val(data.fullName);
                    $("#dobTempId").val(data.dob);
                    $("#addressTempId").val(data.address);
                    $("#mobileNumberTempId").val(data.mobileNumber);
                    $("#landLineNumberTempId").val(data.landLineNumber);
                    $("#emailTempId").val(data.email);
                    $("#genderTempId").val(data.gender);
                    $("#professionTempId").val(data.profession);
                    $("#policeStationId").val(data.policeOffice);
                }
            });
        });

    });
</script>
</body>
</html>
