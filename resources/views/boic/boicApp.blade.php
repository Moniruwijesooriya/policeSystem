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
    <title>Branch Officer Panel</title>
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
        /*.tc-left{
            min-width: 15%;
        } */
        .tc-middle{
            min-width: 45%;
            padding-left: 3%;

        }
        .tc-right{
            min-width: 40%;
            padding-left: 3%;
        }
    </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        {{-- <!-- Logo --> --}}
        <a href="BOIC" class="logo">
            {{-- <!-- mini logo for sidebar mini 50x50 pixels --> --}}
            <span class="logo-mini"><b>BOIC</b></span>
            {{-- <!-- logo for regular state and mobile devices --> --}}
            <span class="logo-lg"><b>BOIC</b> PANEL</span>
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
                    {{-- <!-- Notifications: style can be found in dropdown.less --> --}}
                    {{-- <!-- Tasks: style can be found in dropdown.less --> --}}
                    <li class="dropdown tasks-menu">
                        <?php
                        $boicPoliceOffice=db::table('police_offices')->where('OfficeName',$boicDetails->policeOffice)->first();
                        $entryCount=db::table('entries')->where('boicNotification',"y")->where('branch',$boicPoliceOffice->id)->count()
                        ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-window-restore"></i>
                            <span class="label label-danger">{{$entryCount}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if($entryCount==1)
                                <li class="header">{{$entryCount}} New Entry</li>

                            @elseif($entryCount>0)
                                <li class="header">{{$entryCount}} New Entries</li>
                            @else
                                <li class="header">No New Entries</li>
                            @endif
                            <li>
                                {{-- <!-- inner menu: contains the actual data --> --}}
                                <ul class="menu">
                                    <?php
                                    $entryNotification=db::table('entries')->where('boicNotification',"y")->where('branch',$boicPoliceOffice->id)->get();
                                    ?>
                                    @foreach($entryNotification as $notifi)
                                        <li>
                                            <form method="post" action="{{'viewBOICEntry'}}">
                                                @csrf
                                                <input type="hidden" value="{{$notifi->entryID}}" name="entryID">
                                                <input type="submit" class="btn-link" value="Entry ID:{{$notifi->entryID}} is received">
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="viewBOICNewEntries">View all entries</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <!-- User Account: style can be found in dropdown.less --> --}}
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src='{{asset('/userProfileImages/'.$boicDetails->nic.'.jpg')}}' class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::User()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            {{-- <!-- User image --> --}}
                            <li class="user-header">
                                <img src='{{asset('/userProfileImages/'.$boicDetails->nic.'.jpg')}}' class="img-circle" alt="User Image">

                                <p>
                                    {{Auth::User()->name}}
                                    <small>{{Auth::User()->profession}}</small>
                                    <small>{{Auth::User()->policeOffice}}</small>
                                </p>
                            </li>
                            {{-- <!-- Menu Body --> --}}
                            <li class="user-body" style="background-color:lightgrey">
                                <div>
                                    <a href="boicProfileFormView" class="btn btn-default btn-flat" style="width:100%">Profile</a>
                                </div>
                                <br>
                                <div>
                                    <a href="deactivateBOICFormView" class="btn btn-default btn-flat" style="width:100%">Deactivate Account</a>
                                </div>
                                <br>
                                <div>
                                    <a href="changeBOICPasswordFormView" class="btn btn-default btn-flat" style="width:100%">Change Password</a>
                                </div>
                                <br>
                                <div>
                                    <a href="logout" class="btn btn-default btn-flat" style="width:100%">Sign out</a>
                                </div>
                                <!-- /.row -->
                            </li>
                        </ul>
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
                    <img src='{{asset('/userProfileImages/'.$boicDetails->nic.'.jpg')}}' class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::User()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
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
                        <li><a href="viewBOICNewEntries"><i class="fa fa-circle-o"></i>New Entries</a></li>
                        <li><a href="viewBOICOngoingEntries"><i class="fa fa-circle-o"></i>Ongoing Entries</a></li>
                        <li><a href="viewBOICClosedEntries"><i class="fa fa-circle-o"></i>Closed Entries</a></li>
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
            Group <b>CS 26n</b>
        </div>
        <strong>Crime Reporting System</strong>
    </footer>
    {{-- <!-- Control Sidebar --> --}}
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
    //Javascript Function to get the user information when the NIC number is given
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

    //Javascript Function to get the filter the table with matching results
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
</body>
</html>
