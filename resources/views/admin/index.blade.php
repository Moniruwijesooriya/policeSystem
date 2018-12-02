@extends('admin.adminLayout')
<?php
use Illuminate\Support\Facades\DB;
?>
@section('content')
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

                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white w3-center">
                            <div class="w3-container">
                                <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#removePoliceOfficer">
                                        Remove Police Officer
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

                        <a href="viewCrimeCategorySection" class="btn btn-primary" >Crime Categories</a>
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-7">
                                <input id="fullName" type="text" class="form-control{{ $errors->has('fullName') ? ' is-invalid' : '' }}" name="fullName" value="{{ old('fullName') }}" required autofocus>

                                @if ($errors->has('fullName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>

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
                                <input id="nic" type="text" pattern=".{10,12}" class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" value="{{ old('nic') }}" required autofocus>

                                @if ($errors->has('nic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-7">
                                <input id="dob" type="date" class="form-control" name="dob"  required autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-3">
                                <div class="radio">
                                    <label><input type="radio" name="gender" value="Male" checked>Male</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="radio">
                                    <label><input type="radio" name="gender" value="Female">Female</label>
                                </div>
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
                                <input id="mobNumber" type="text" maxlength="10" class="form-control{{ $errors->has('mobNumber') ? ' is-invalid' : '' }}" name="mobNumber" value="{{ old('mobNumber') }}" required autofocus>

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
                                <input id="landNumber" type="text" maxlength="10" class="form-control{{ $errors->has('landNumber') ? ' is-invalid' : '' }}" name="landNumber" value="{{ old('landNumber') }}" required autofocus>

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

                        <?php
                        $policeOffice=db::table('police_offices')->get();
                        ?>
                        <div class="form-group row">
                            <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Police Office') }}</label>
                            <div class="col-md-7">

                                <select class="form-control" name="policeOffice" id="exampleFormControlSelect1">
                                    @foreach($policeOffice as $office)
                                    <option>{{$office->OfficeName}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
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
    {{--Remove police officer form--}}
    <div class="modal fade" id="removePoliceOfficer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-dialog-centered" role="document">
            <div  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerPoliceOfficer">Remove Police Officer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="removeFormView" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                            <div class="col-md-7">
                                <input id="nic" type="text" pattern=".{10,12}" class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" value="{{ old('nic') }}" required autofocus>

                                @if ($errors->has('nic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Check') }}
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

                        <div class="form-group row">
                            <label for="exampleFormControlSelect1" class="col-md-4 col-form-label text-md-left">District</label>
                            <div class="col-md-7">
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
                        </div>



                        <div class="form-group row">
                            <label for="exampleFormControlSelect1" class="col-md-4 col-form-label text-md-left">Office Type</label>
                            <div class="col-md-7">
                            <select class="form-control" name ="policeOfficeType" id="exampleFormControlSelect1">
                                <option>Police Station</option>
                                <option>Inspector General of Police Office</option>
                                <option>Branch Office</option>
                                <option>Division Office</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="policeOfficeArea" class="col-md-4 col-form-label text-md-left">{{ __('Office Area') }}</label>

                            <div class="col-md-7">
                                <input id="policeOfficeArea" type="text" class="form-control" name="policeOfficeArea" value="{{ old('policeOfficeArea') }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="landNumber" class="col-md-4 col-form-label text-md-left">{{ __('Landline Number') }}</label>

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
