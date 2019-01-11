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
                    {{--To Take user details to load some information of the user--}}
                    <?php
                    $loggedUser=db::table('users')->where('nic',Auth::User()->nic)->first();
                    ?>
                    {{-- <!-- Notifications: style can be found in dropdown.less --> --}}
                    <li class="dropdown notifications-menu">
                        {{--No. of new registration requests--}}
                        <?php
                        $count=db::table('users')->where('verified',"No")->where('role',"citizen")->where('policeOffice',$loggedUser->policeOffice)->count();
                        ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-plus"></i>
                            <span class="label label-warning">{{$count}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if($count==1)
                                <li class="header">{{$count}} New Citizen Registration Request</li>

                            @elseif($count>0)
                                <li class="header">{{$count}} New Citizen Registration Requests</li>
                            @else
                                <li class="header">No New Registration Requests</li>
                            @endif

                            <li>
                                {{-- <!-- inner menu: contains the actual data --> --}}

                                <ul class="menu">
                                    {{--List of registration requests--}}
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
                            <li class="footer"><a href="viewNewCitizenRequests">View all</a></li>
                        </ul>
                    </li>
                    {{-- <!-- Tasks: style can be found in dropdown.less --> --}}
                    <li class="dropdown tasks-menu">
                        {{--No of new entries submitted by registered citizens--}}
                        <?php
                        $entryCount=db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$loggedUser->policeOffice)->count()
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
                                    {{--List of new entries--}}
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
                                <a href="viewOICNewEntries">View all</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <!-- User Account: style can be found in dropdown.less --> --}}
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src='{{asset('/userProfileImages/'.$loggedUser->nic.'.jpg')}}' class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::User()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            {{-- <!-- User image --> --}}
                            <li class="user-header">
                                <img src='{{asset('/userProfileImages/'.$loggedUser->nic.'.jpg')}}' class="img-circle" alt="User Image">

                                <p>
                                    {{Auth::User()->name}}
                                    <small>{{Auth::User()->profession}}</small>
                                    <small>{{Auth::User()->policeOffice}}</small>
                                </p>
                            </li>
                            {{-- <!-- Menu Body --> --}}
                            <li class="user-body" style="background-color:lightgrey">

                                <div>
                                    <a href="oicProfileFormView" class="btn btn-default btn-flat" style="width:100%">Profile</a>
                                </div>
                                <br>
                                <div>
                                    <a href="deactivateOICFormView" class="btn btn-default btn-flat" style="width:100%">Deactivate Account</a>
                                </div>
                                <br>
                                <div>
                                    <a href="changeOICPasswordFormView" class="btn btn-default btn-flat" style="width:100%">Change Password</a>
                                </div>
                                <br>
                                <div>
                                    <a href="logout" class="btn btn-default btn-flat" style="width:100%">Sign out</a>
                                </div>
                                <!-- /.row -->
                            </li>
                            {{-- <!-- /.row --> --}}
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
                    <img src='{{asset('/userProfileImages/'.$loggedUser->nic.'.jpg')}}' class="img-circle" alt="User Image">
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
                        <li><a href="viewOICNewEntries"><i class="fa fa-circle-o"></i>New Entries</a></li>
                        <li><a href="viewOICOngoingEntries"><i class="fa fa-circle-o"></i>Ongoing Entries</a></li>
                        <li><a href="viewOICClosedEntries"><i class="fa fa-circle-o"></i>Closed Entries</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i>
                        <span>Citizen Management</span>
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
                        @foreach($branches as $branch)
                            <form method="post" action="{{'viewBranch'}}">
                                @csrf
                                <input type="hidden" value="{{ $branch->id }}" name="branchID">
                                <input type="hidden" value="{{ $branch->policeOfficeArea }}" name="branchName">
                                <input type="hidden" value="{{ $branch->mainOfficer }}" name="mainOfficer">
                                <li><input type="submit" class="btn btn-outline-primary" style="width: 222px;text-wrap: normal;" value="{{ $branch->policeOfficeArea }} Branch"></li>
                            </form>
                        @endforeach
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
            Group<b> CS 26</b>
        </div>
        <strong>Crime Reporting System</strong>
    </footer>
    {{--viewUserProfile--}}
    <div class="modal fade" id="viewPerson" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-dialog-centered" role="document">
            <div  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerPoliceOfficer">Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form >
                        @csrf
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                            <div class="col-md-7">
                                <input id="nicTempId" type="text" class="form-control" name="nicTemp" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-7">
                                <input id="nameTempId" type="text" class="form-control" name="nameTemp"  readonly></div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-7">
                                <input id="fullNameTempId" type="text" class="form-control" name="fullNameTemp"  readonly></div>
                        </div>

                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-7">
                                <input id="dobTempId" type="text" class="form-control" name="dobTemp"  readonly></div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-7">
                                <input id="addressTempId" type="text" class="form-control" name="addressTemp"  readonly></div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                            <div class="col-md-7">
                                <input id="mobileNumberTempId" type="text" class="form-control" name="mobileNumberTemp"  readonly></div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Land Line Number') }}</label>

                            <div class="col-md-7">
                                <input id="landLineNumberTempId" type="text" class="form-control" name="landLineNumberTemp"  readonly></div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-7">
                                <input id="emailTempId" type="text" class="form-control" name="emailTemp"  readonly></div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-7">
                                <input id="genderTempId" type="text" class="form-control" name="genderTemp"  readonly></div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                            <div class="col-md-7">
                                <input id="professionTempId" type="text" class="form-control" name="professionTemp"  readonly></div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Relevant Police Station') }}</label>

                            <div class="col-md-7">
                                <input id="policeStationId" type="text" class="form-control" name="policeStationTemp"  readonly></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    // Javascript function for searching the items in the table
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    //Javascript function to load the information of an user relevant to the NIC number
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
    //Javascript function to load the information of an user relevant to the NIC number and which is a closed user account
    $(document).ready(function () {
        var url = '{{route('getRemovedUserInfo')}}';
        var token = '{{Session::token()}}';
        var tempNic="";

        $(".nic-button-closed").click(function () {
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
</script>
</body>
</html>
