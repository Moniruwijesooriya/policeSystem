@extends('layouts.app')
<?php
use Illuminate\Support\Facades\DB;
?>
@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
    </style>
    <!-- Navbar -->



    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:10px">
        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3">
                <!-- Profile -->
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container">
                        <h4 class="w3-center">My Profile</h4>
                        <p class="w3-center"><img src='{{asset('/img/citizen.png')}}' class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                        <hr>
                        <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->profession}}</p>
                        <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->address}}</p>
                    </div>
                </div>
                <br>




                @if(Session::has('entrySuccess'))

                    <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
                    <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
                      <i class="fa fa-remove"></i>
                     </span>
                        <p><strong>Attention!</strong></p>
                        <p>{{Session::get('entrySuccess')}}</p>
                    </div>

                 @endif

                <!-- Accordion -->
                <div class="w3-card w3-round">
                    <div class="w3-white">
                        <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Submitted Entries</button>
                        <div id="Demo1" class="w3-hide w3-container">
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                            <?php
                            $entries=db::table('entries')->where('complainantID',Auth::User()->nic)->get();
                            ?>
                            @foreach($entries as $entry)

                                <form method="post" action="{{'viewCitizenEntry'}}">
                                    @csrf
                                    <input type="hidden" value="{{$entry->entryID}}" name="entryID">
                                    <p><input type="submit" class="btn btn-primary" value="Entry ID :{{$entry->entryID}}"></p>
                                </form>
                            @endforeach
                            {{--</div>--}}
                        </div>
                        <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Following Cases</button>
                        <div id="Demo2" class="w3-hide w3-container">

                        </div>
                        <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Evidence Submitted</button>
                    </div>
                </div>
                <br>

                <!-- Districts of Interest -->
                <div class="w3-card w3-round w3-white w3-hide-small">
                    <div class="w3-container">
                        <p>Districts of Interest</p>
                        <p>
                            <span class="w3-tag w3-small w3-theme-d5">Colombo</span>
                            <span class="w3-tag w3-small w3-theme-d4">Kandy</span>
                        </p>
                    </div>
                </div>
                <br>

                <!-- Alert Box -->


                <!-- End Left Column -->
            </div>
            <!-- Middle Column -->
            <div class="w3-col m7">
                <?php
                $posts=db::table('public_posts')->get();
                ?>
                @foreach($posts as $post)
                <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                    <span class="w3-right w3-opacity">{{$post->created_at}}</span>
                    <h4>{{$post->title}}</h4><br>
                    <h6>{{$post->content}}</h6><br>
                    <p></p>
                    <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-hand-o-right"></i>  Follow Case</button>
                    <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-file-o"></i>  Submit Evidence</button>
                </div>
                    @endforeach

                <!-- End Middle Column -->
            </div>

            <!-- Right Column -->
            <div class="w3-col m2">
                <div class="row" style="margin-top:15px">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitCrimeEntry">
                        Submit Your Crime Entry
                    </button>
                </div>

                <div class="row" style="margin-top:15px">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#citizenUpdateForm">
                        Update Profile
                    </button>
                </div>

                <div class="row" style="margin-top:15px">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deactivateaccountform">
                        Deactivate Account
                    </button>
                </div>

                <div class="row" style="margin-top:15px">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changepasswordform">
                        Change Password
                    </button>
                </div>

            </div>


            <!-- End Right Column -->

        </div>
        <!-- End Grid -->

        <!-- End Page Container -->
    </div>


    {{--Change Password--}}
    <div class="modal fade" id="changepasswordform" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-dialog-centered" role="document">
            <div  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerPoliceOfficer">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="citizenPasswordChange" >
                        @csrf

                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="nic" value="{{$citizenDetails->nic}}">
                                <input id="nic" type="text" pattern=".{10,12}" name="tmp" class="form-control"  value="{{$citizenDetails->nic}}" readonly>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="currentpassword" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="newpassword" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="confirmpassword" required>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Passord') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{--Deactivate Account--}}
    <div class="modal fade" id="deactivateaccountform" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-dialog-centered" role="document">
            <div  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerPoliceOfficer">Deactivate Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="citizenAccountDeactivate" >
                        @csrf

                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="nic" value="{{$citizenDetails->nic}}">
                                <input id="nic" type="text" pattern=".{10,12}" name="tmp" class="form-control"  value="{{$citizenDetails->nic}}" readonly>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Deactivate Account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{--Citizen Update form--}}
    <div class="modal fade" id="citizenUpdateForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-dialog-centered" role="document">
            <div  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerPoliceOfficer">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="citizenInfoUpdate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="fullName" type="text" class="form-control" name="fullName" value="{{$citizenDetails->fullName}}" readonly>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$citizenDetails->name}}" readonly>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                            <div class="col-md-6">
                                <input id="nic" type="text" pattern=".{10,12}" class="form-control" name="nic" value="{{$citizenDetails->nic}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="homeAddress" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>

                            <div class="col-md-6">
                                <input id="homeAddress" type="text" class="form-control" name="homeAddress" value="{{$citizenDetails->address}}" required autofocus>

                            </div>
                        </div>

                        <?php
                        $policeOffice=db::table('police_offices')->get()->where('policeOfficeType',"Police Station");
                        ?>
                        <div class="form-group row">
                            <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Nearest Police Station') }}</label>
                            <div class="col-md-6">

                                <select class="form-control" name="policeStation" id="exampleFormControlSelect1">
                                    <option>{{$citizenDetails->policeOffice}}</option>
                                    @foreach($policeOffice as $office)
                                        <option>{{$office->OfficeName}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                            <div class="col-md-6">
                                <input id="profession" type="text" class="form-control" name="profession" value="{{$citizenDetails->profession}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input id="mobNumber" type="text" maxlength="10" class="form-control" name="mobNumber" value="{{$citizenDetails->mobileNumber}}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>

                            <div class="col-md-6">
                                <input id="landNumber" type="text" maxlength="10" class="form-control" name="landNumber" value="{{$citizenDetails->landLineNumber}}" required autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$citizenDetails->email}}" required>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{--Submit crime entry form--}}
    <div class="modal fade" id="submitCrimeEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitCrimeEntryTitle">Submit Crime Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route("submitEntry")}}">
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

                        <?php
                        $policeOffice=db::table('police_offices')->get()->where('policeOfficeType',"Police Station");
                        ?>
                        <div class="form-group">
                            <label for="policeOffice">Nearest Police Station</label>
                            <select class="form-control" name="policeStation" id="policeStation">
                                @foreach($policeOffice as $office)
                                    <option>{{$office->policeOfficeArea}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Complaint Category</label>
                            <select class="form-control" name="complaintCategory" id="exampleFormControlSelect1">
                                @foreach($crimeCategories as $crimeCategory)
                                <option>{{$crimeCategory->crimeType}}</option>
                                    @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Complaint</label>
                            <textarea class="form-control" name="complaintText" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Evidences</label>
                            <textarea class="form-control" name="evidences"  rows="2"></textarea>
                        </div>


                        <div class="form-group">
                            <label for="suspects">Suspects</label>
                            <textarea class="form-control" name="suspects" rows="2"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="submit" value="Submit Entry">
                        </div>
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <br>

    @extends('layouts.footer')

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
            var password = document.getElementById("password")
                , confirm_password = document.getElementById("confirm_password");

            function validatePassword(){
                if(password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                } else {
                    confirm_password.setCustomValidity('');
                }
            }

    </script>


@endsection
