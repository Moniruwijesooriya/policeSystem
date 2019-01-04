@extends('layouts.app')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
    </style>
    <!-- Navbar -->


    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
    </div>

    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3">
                <!-- Profile -->
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container ">
                        <h4 class="w3-center">My Profile</h4>
                        <p class="w3-center"><img src='{{asset('/img/IGP.jpg')}}' class="w3-circle" style="height:106px;width:106px" alt="IGP Image"></p>
                        <hr>
                        <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->profession}}</p>
                        <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->policeOffice}}</p>
                    </div>
                </div>
                <br>

                <!-- Accordion -->
                <div class="w3-card w3-round">
                    <div class="w3-white">
                        <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Investigation</button>
                        <div id="Demo1" class="w3-hide w3-container">
                            {{--<p>Some text..</p>--}}
                        </div>
                        <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Invetigation Branches</button>
                        <div id="Demo2" class="w3-hide w3-container">
                            {{--<p>Some other text..</p>--}}
                        </div>
                        <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>D Type Crime Enquries</button>

                    </div>
                </div>
                <br>




                <!-- End Left Column -->
            </div>

            <!-- Middle Column -->

            <div class="w3-col m7">

                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white w3-center">
                            <div class="w3-container">
                                <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                        View Crime Entries
                                    </button></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white w3-center">
                            <div class="w3-container">
                                <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerPoliceOffice">
                                        Call Up relevant Branches
                                    </button></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white w3-center">
                            <div class="w3-container">
                                <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#igpUpdateform">
                                        Update Account
                                    </button></p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- End Middle Column -->
            </div>

            <!-- Right Column -->
            <div class="w3-col m2">
                <br>


                <br>

                {{--<div class="w3-card w3-round w3-white w3-padding-16 w3-center">--}}
                    {{--<p>ADS</p>--}}
                {{--</div>--}}
                <br>

                {{--<div class="w3-card w3-round w3-white w3-padding-32 w3-center">--}}
                    {{--<p><i class="fa fa-bug w3-xxlarge"></i></p>--}}
                {{--</div>--}}

                <!-- End Right Column -->
            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>


    {{--<div class="modal fade" id="igpUpdateform" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
        {{--<div  class="modal-dialog modal-dialog-centered" role="document">--}}
            {{--<div  class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<h5 class="modal-title" id="registerPoliceOfficer">Update Profile</h5>--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<form method="POST" action="{{ route('registerPoliceOfficer') }}" enctype="multipart/form-data">--}}
                        {{--@csrf--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="fullName" type="text" class="form-control" name="fullName" value="{{$citizenDetails->fullName}}" readonly>--}}

                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control" name="name" value="{{$citizenDetails->name}}" readonly>--}}
                            {{--</div>--}}
                        {{--</div>--}}


                        {{--<div class="form-group row">--}}
                            {{--<label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="nic" type="text" pattern=".{10,12}" class="form-control" name="nic" value="{{$citizenDetails->nic}}" readonly>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="homeAddress" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="homeAddress" type="text" class="form-control" name="homeAddress" value="{{$citizenDetails->address}}" required autofocus>--}}

                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<?php--}}
                        {{--$policeOffice=db::table('police_offices')->get()->where('policeOfficeType',"Police Station");--}}
                        {{--?>--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Nearest Police Station') }}</label>--}}
                            {{--<div class="col-md-6">--}}

                                {{--<select class="form-control" name="policeStation" id="exampleFormControlSelect1">--}}
                                    {{--<option>{{$citizenDetails->policeOffice}}</option>--}}
                                    {{--@foreach($policeOffice as $office)--}}
                                        {{--<option>{{$office->OfficeName}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}

                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="profession" type="text" class="form-control" name="profession" value="{{$citizenDetails->profession}}" required autofocus>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="mobNumber" type="text" maxlength="10" class="form-control" name="mobNumber" value="{{$citizenDetails->mobileNumber}}" required autofocus>--}}

                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="landNumber" type="text" maxlength="10" class="form-control" name="landNumber" value="{{$citizenDetails->landLineNumber}}" required autofocus>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{$citizenDetails->email}}" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input  onkeyup="validatePassword()" id="confirm_password" type="password" class="form-control" name="confirm_password" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Update') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Crime Entries</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Entry ID</th>
                            <th scope="col">Complaint Category</th>
                            <th scope="col">Complainant ID</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <br>

    <!-- Footer -->
    <footer class="w3-container w3-theme-d3 w3-padding-16">
        <h5>Crime Reporting System</h5>
    </footer>

    <footer class="w3-container w3-theme-d5">
        <p>Group 26</p>
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

@extends('layouts.footer')
@endsection
