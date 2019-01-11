@extends('igp.igpApp')
@section('content')

    <div class="content-header">
        <h1>
            Request For Registration
        </h1>
    </div>

    <!-- Main content -->
    <div class="content" >
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-lg-12 ">
                <!-- TO DO List -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{--View Entry List--}}
                        <div class="container-fluid">
                            <!-- The Grid -->
                            <div class="row" style="border-radius: 8px;background-color: lightgray">
                                <!-- Left Column -->
                                <!-- Middle Column -->
                                <div class="col-md-8 card" style="margin-bottom: 10px;margin-left:180px;margin-right:180px;border-radius: 8px;background-color: whitesmoke;margin-top: 30px">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="page-header" style="text-align: center">{{ __('Citizen Registration Form') }}</div>

                                                <div class="card-body">
                                                    <form method="post" style="margin-left: 70px" action="{{ route('acceptCitizenRequest') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <p class="w3-center"><img src='{{asset('/userProfileImages/'.$citizenDetails->nic.'.jpg')}}' class="w3-circle" style="height:200px;width:200px" alt="{{ $citizenDetails->nic }}"></p>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->name }}" readonly>
                                                                <input type="hidden" name="nic" value="{{ $citizenDetails->nic }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->fullName }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->nic }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->dob }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->gender }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Residence Address') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->address }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->profession }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->mobileNumber }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->landLineNumber }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->email }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Verify') }}</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name ="verify" id="exampleFormControlSelect1">
                                                                    <option>Yes</option>
                                                                    <option>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-6 col-xs-6"  >
                                                                <input type="submit" class="btn btn-primary">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Middle Column -->
                                    </div>

                                    <!-- End Middle Column -->
                                </div>

                                <!-- Right Column -->

                                <!-- End Grid -->
                            </div>

                            <!-- End Page Container -->
                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </div>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </div>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection









{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    {{--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">--}}
    {{--<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">--}}
    {{--<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    {{--<style>--}}
        {{--html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}--}}
    {{--</style>--}}
    {{--<!-- Navbar -->--}}


    {{--<!-- Navbar on small screens -->--}}
    {{--<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">--}}
        {{--<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>--}}
        {{--<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>--}}
        {{--<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>--}}
        {{--<a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>--}}
    {{--</div>--}}

    {{--<!-- Page Container -->--}}
    {{--<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">--}}
        {{--<!-- The Grid -->--}}
        {{--<div class="w3-row">--}}
            {{--<!-- Left Column -->--}}
            {{--<div class="w3-col m3">--}}
                {{--<!-- Profile -->--}}
                {{--<div class="w3-card w3-round w3-white">--}}
                    {{--<div class="w3-container ">--}}
                        {{--<h4 class="w3-center">My Profile</h4>--}}
                        {{--<p class="w3-center"><img src='{{asset('/img/igp.jpeg')}}' class="w3-circle" style="height:106px;width:106px" alt="IGP Image"></p>--}}
                        {{--<hr>--}}
                        {{--<p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->profession}}</p>--}}
                        {{--<p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->policeOffice}}</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<br>--}}

                {{--<!-- Accordion -->--}}
                {{--<div class="w3-card w3-round">--}}
                    {{--<div class="w3-white">--}}
                        {{--<button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Investigation</button>--}}
                        {{--<div id="Demo1" class="w3-hide w3-container">--}}
                            {{--<p>Some text..</p>--}}
                        {{--</div>--}}
                        {{--<button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Invetigation Branches</button>--}}
                        {{--<div id="Demo2" class="w3-hide w3-container">--}}
                            {{--<p>Some other text..</p>--}}
                        {{--</div>--}}
                        {{--<button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>D Type Crime Enquries</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<br>--}}


                {{--<!-- End Left Column -->--}}
            {{--</div>--}}

            {{--<!-- Middle Column -->--}}


            {{--<div class="w3-col m7">--}}


                {{--<!-- Right Column -->--}}
                {{--<div class="w3-col m2">--}}
                    {{--<br>--}}

                    {{--<div class="w3-card w3-round w3-white w3-center">--}}
                        {{--<div class="w3-container">--}}

                            {{--<div class="w3-row w3-opacity">--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<br>--}}

                {{--<div class="w3-card w3-round w3-white w3-padding-16 w3-center">--}}
                {{--<p>ADS</p>--}}
                {{--</div>--}}
                {{--<br>--}}

                {{--<div class="w3-card w3-round w3-white w3-padding-32 w3-center">--}}
                {{--<p><i class="fa fa-bug w3-xxlarge"></i></p>--}}
                {{--</div>--}}

                {{--<!-- End Right Column -->--}}
                {{--</div>--}}

                {{--<!-- End Grid -->--}}
            {{--</div>--}}

            {{--<!-- End Page Container -->--}}
        {{--</div>--}}


        {{--<br>--}}

        {{--<!-- Footer -->--}}
        {{--<footer class="w3-container w3-theme-d3 w3-padding-16">--}}
            {{--<h5>Crime Reporting System</h5>--}}
        {{--</footer>--}}

        {{--<footer class="w3-container w3-theme-d5">--}}
            {{--<p>Group 26</p>--}}
        {{--</footer>--}}

        {{--<script>--}}
            {{--// Accordion--}}
            {{--function myFunction(id) {--}}
                {{--var x = document.getElementById(id);--}}
                {{--if (x.className.indexOf("w3-show") == -1) {--}}
                    {{--x.className += " w3-show";--}}
                    {{--x.previousElementSibling.className += " w3-theme-d1";--}}
                {{--} else {--}}
                    {{--x.className = x.className.replace("w3-show", "");--}}
                    {{--x.previousElementSibling.className =--}}
                        {{--x.previousElementSibling.className.replace(" w3-theme-d1", "");--}}
                {{--}--}}
            {{--}--}}

            {{--// Used to toggle the menu on smaller screens when clicking on the menu button--}}
            {{--function openNav() {--}}
                {{--var x = document.getElementById("navDemo");--}}
                {{--if (x.className.indexOf("w3-show") == -1) {--}}
                    {{--x.className += " w3-show";--}}
                {{--} else {--}}
                    {{--x.className = x.className.replace(" w3-show", "");--}}
                {{--}--}}
            {{--}--}}
        {{--</script>--}}

{{--@endsection--}}
