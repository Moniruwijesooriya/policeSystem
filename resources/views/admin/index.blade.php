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
                    <div class="w3-container">
                        <h4 class="w3-center">My Profile</h4>
                        <p class="w3-center"><img src='{{asset('/img/admin.png')}}' class="w3-circle" style="height:106px;width:106px" alt="Admin Image"></p>
                        <hr>
                        <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>System Admin</p>
                    </div>
                </div>
                <br>

                <!-- Accordion -->
                <div class="w3-card w3-round">
                    <div class="w3-white">
                        <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-archive fa-fw w3-margin-right"></i>Police Office Management</button>
                        <div id="Demo1" class="w3-hide w3-container">
                            {{--<p>Some text..</p>--}}
                        </div>
                        <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-address-book-o fa-fw w3-margin-right"></i>Police Officer Management</button>
                        <div id="Demo2" class="w3-hide w3-container">
                            {{--<p>Some other text..</p>--}}
                        </div>
                        <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Citizen Management</button>
                        <div id="Demo3" class="w3-hide w3-container">
                            <div class="w3-row-padding">
                                {{--<br>--}}
                                {{--<div class="w3-half">--}}
                                    {{--<img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">--}}
                                {{--</div>--}}
                                {{--<div class="w3-half">--}}
                                    {{--<img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">--}}
                                {{--</div>--}}
                                {{--<div class="w3-half">--}}
                                    {{--<img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">--}}
                                {{--</div>--}}
                                {{--<div class="w3-half">--}}
                                    {{--<img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">--}}
                                {{--</div>--}}
                                {{--<div class="w3-half">--}}
                                    {{--<img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">--}}
                                {{--</div>--}}
                                {{--<div class="w3-half">--}}
                                    {{--<img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">--}}
                                {{--</div>--}}
                            </div>
                        </div>
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
                                <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerPoliceOfficer">
                                        Register Police Officer
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
                                        Register Police Office
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

                <div class="w3-card w3-round w3-white w3-center">
                    <div class="w3-container">

                        <div class="w3-row w3-opacity">

                        </div>
                    </div>
                </div>
                <br>

                {{--<div class="w3-card w3-round w3-white w3-padding-16 w3-center">--}}
                    {{--<p>ADS</p>--}}
                {{--</div>--}}
                {{--<br>--}}

                {{--<div class="w3-card w3-round w3-white w3-padding-32 w3-center">--}}
                    {{--<p><i class="fa fa-bug w3-xxlarge"></i></p>--}}
                {{--</div>--}}

                <!-- End Right Column -->
            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>
    {{--Register police officer form--}}
    <div class="modal fade" id="registerPoliceOfficer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-dialog-centered" role="document">
            <div  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerPoliceOfficer">Register Police Officer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('registerPoliceOfficer') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                            <div class="col-md-7">
                                <input id="nic" type="text" class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" value="{{ old('nic') }}" required autofocus>

                                @if ($errors->has('nic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="homeAddress" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>

                            <div class="col-md-7">
                                <input id="homeAddress" type="text" class="form-control{{ $errors->has('homeAddress') ? ' is-invalid' : '' }}" name="homeAddress" value="{{ old('homeAddress') }}" required autofocus>

                                @if ($errors->has('homeAddress'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('homeAddress') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                            <div class="col-md-7">
                                <input id="mobNumber" type="text" class="form-control{{ $errors->has('mobNumber') ? ' is-invalid' : '' }}" name="mobNumber" value="{{ old('mobNumber') }}" required autofocus>

                                @if ($errors->has('mobNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>

                            <div class="col-md-7">
                                <input id="landNumber" type="text" class="form-control{{ $errors->has('landNumber') ? ' is-invalid' : '' }}" name="landNumber" value="{{ old('landNumber') }}" required autofocus>

                                @if ($errors->has('landNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('landNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">


                            <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('System Role') }}</label>
                            <div class="col-md-7">
                                <select class="form-control" name="role" id="exampleFormControlSelect1">
                                    <option>Branch Officer Incharge</option>
                                    <option>Officer Incharge of Police Station</option>
                                    <option>Division Officer Incharge</option>
                                    <option>Inspector General of Police</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rank" class="col-md-4 col-form-label text-md-right">{{ __('Officer Rank') }}</label>
                            <div class="col-md-7">
                                <select class="form-control" name="profession" id="exampleFormControlSelect1">
                                    <option>Inspector General of Police</option>
                                    <option>Senior Deputy Inspector General of Police</option>
                                    <option>Deputy Inspector General of Police</option>
                                    <option>Senior Superintendent of Police</option>
                                    <option>Superintendent of Police</option>
                                    <option>Assistant Superintendent of Police</option>
                                    <option>Chief Inspector of Police</option>
                                    <option>Inspector of Police </option>
                                    <option>Sub Inspector of Police</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Police Office') }}</label>
                            <div class="col-md-7">
                                <select class="form-control" name="policeOffice" id="exampleFormControlSelect1">
                                    <option>Alpitiya</option>
                                    <option>Ampara</option>
                                    <option>Anuradhapura</option>
                                    <option>Badulla</option>
                                    <option>Batticaloa</option>
                                    <option>Galle</option>
                                    <option>Matara</option>
                                </select>
                            </div>
                        </div>



                        {{--<div class="form-group row">--}}
                        {{--<label for="profileImage" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>--}}

                        {{--<div class="col-md-6">--}}
                        {{--<input class="form-group mb-2" id="profileImage" type="file" name="profileImage" value="{{ old('profileImage') }}" required>--}}

                        {{--@if ($errors->has('profileImage'))--}}
                        {{--<span class="invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('profileImage') }}</strong>--}}
                        {{--</span>--}}
                        {{--@endif--}}
                        {{--</div>--}}
                        {{--</div>--}}



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{--Register police office form--}}
    <div class="modal fade" id="registerPoliceOffice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-dialog-centered" role="document">
            <div  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerPoliceOfficer">Register Police Office</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('registerPoliceOffice') }}">
                        @csrf

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">District</label>
                            <select class="form-control" name="district" id="exampleFormControlSelect1">
                                <option>Ampara</option>
                                <option>Anuradhapura</option>
                                <option>Badulla</option>
                                <option>Batticaloa</option>
                                <option>Colombo</option>
                                <option>Galle</option>
                                <option>Gampaha</option>
                                <option>Hambanthota</option>
                                <option>Jaffna</option>
                                <option>Kaluthara</option>
                                <option>Kandy</option>
                                <option>Kegalle</option>
                                <option>Kilinochchi</option>
                                <option>Kurunegala</option>
                                <option>Mannar</option>
                                <option>Matale</option>
                                <option>Matara</option>
                                <option>Monaragala</option>
                                <option>Mullaitivu</option>
                                <option>Nuwara Eliya</option>
                                <option>Polonnaruwa</option>
                                <option>Puttalam</option>
                                <option>Rathnapura</option>
                                <option>Trincomalee</option>
                                <option>Vavuniya</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Office Area</label>
                            <select class="form-control" name ="policeOfficeArea" id="exampleFormControlSelect1">
                                <option>Ampara</option>
                                <option>Anuradhapura</option>
                                <option>Badulla</option>
                                <option>Batticaloa</option>
                                <option>Colombo</option>
                                <option>Galle</option>


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Office Type</label>
                            <select class="form-control" name ="policeOfficeType" id="exampleFormControlSelect1">
                                <option>Police Station</option>
                                <option>Inspector General of Police Office</option>
                                <option>Branch Office</option>
                                <option>Division Office</option>

                            </select>
                        </div>

                        <div class="form-group row">
                            <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>

                            <div class="col-md-7">
                                <input id="landNumber" type="text" class="form-control{{ $errors->has('landNumber') ? ' is-invalid' : '' }}" name="landNumber" value="{{ old('landNumber') }}" required autofocus>

                                @if ($errors->has('landNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('landNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
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


@endsection
