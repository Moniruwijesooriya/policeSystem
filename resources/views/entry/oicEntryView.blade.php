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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }


    </style>
    <!-- Navbar -->

    <!-- Page Container -->
    <div class="container-fluid" style="max-width:1400px;background-color:darkcyan">
        <!-- The Grid -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-3">
                <!-- Accordion -->
                <div class="card">
                    <div class="bg-white">
                        <button onclick="myFunction('evidencesList')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Evidences</button>
                        <div id="evidencesList" class="w3-hide w3-container">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->evidences }}<br>Submitted by : <button type="button" value="{{ $entry->complainantID }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                            {{ $entry->complainantID }}
                                        </button></p>
                                    @foreach($evidences as $evidence)
                                        <p contenteditable="false" class="w3-border w3-padding" >{{ $evidence->evidence_txt }}<br>Submitted by :
                                            {{--<input type="hidden" name="{{ $evidence->witnessId }}" value="{{ $evidence->witnessId }}">--}}
                                            <button type="button" value="{{ $evidence->witnessId }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                                {{ $evidence->witnessId }}
                                            </button>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button onclick="myFunction('suspectList')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Suspects</button>
                        <div id="suspectList" class="w3-hide w3-container">
                            <div class="form-group row">
                                <div class="col-md-11">
                                    <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->suspects }}</p>
                                    @foreach($suspects as $suspect)
                                        <p contenteditable="false" class="w3-border w3-padding" >{{ $suspect->name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <!-- End Left Column -->
            </div>

            <!-- Middle Column -->
            <div class="col-md-5" style="margin-right: 40px;margin-left: 20px;margin-bottom: 10px">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __('Entry') }}</div>

                            <div class="card-body">
                                <form method="post" action="{{ route('entryOICAction') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Entry ID') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control"value="{{ $entry->entryID }}" readonly>
                                            <input type="hidden" name="entryID" value="{{ $entry->entryID }}">
                                            <input type="hidden" name="policeStation" value="{{ $entry->nearestPoliceStation }}">
                                            <input type="hidden" name="initialProgress" value="{{ $entry->progress }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Complainant NIC') }}</label>

                                        <div class="col-md-6">
                                            <button type="button" value="{{ $entry->complainantID }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">{{ $entry->complainantID }}</button>
                                            <input type="hidden" name="complainantNIC" value="{{ $entry->complainantID }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Date And Time') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control"value="{{ $entry->created_at }}" readonly>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Complaint Category') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control"value="{{ $entry->complaintCategory }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Complaint') }}</label>

                                        <div class="col-md-6">
                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->complaint }}</p>
                                        </div>
                                    </div>

                                    @if($entry->status=="new")
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Branch') }}</label>
                                            <div class="col-md-6">
                                                <select class="form-control" name ="branch" id="exampleFormControlSelect1">
                                                    <option>Crime Branch</option>
                                                    <option>Vice Unit</option>
                                                    <option>Miscellaneous Complaints</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    @if($entry->status=="ongoing")
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Current Branch') }}</label>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control"value="{{ $entry->branch }}" readonly>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Evidences') }}</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="evidence" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                        <div class="form-check col-md-2">
                                            <input type="checkbox" class="form-check-input" name="evidenceCitizenView" value="Yes" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Citizen View</label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Suspects</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="suspects" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                        <div class="form-check col-md-2">
                                            <input type="checkbox" class="form-check-input" name="suspectCitizenView" value="Yes" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Citizen View</label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Progress</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="entryProgress" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                        <div class="form-check col-md-2">
                                            <input type="checkbox" class="form-check-input" name="progressCitizenView" value="Yes" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Citizen View</label>
                                        </div>

                                    </div>

                                    <div class="form-group row mb-0">
                                        @if($entry->status=="new")
                                            <div class="col-md-6 offset-md-6 col-xs-6"  >
                                                <input type="hidden" name="statusType" value="{{$entry->status}}">
                                                <input type="submit" class="btn btn-primary" value="Accept and Forward">
                                            </div>
                                        @endif
                                        @if($entry->status=="ongoing")
                                            <div class="col-md-6 offset-md-6 col-xs-6"  >
                                                <input type="hidden" name="statusType" value="{{$entry->status}}">
                                                <input type="submit" class="btn btn-primary"  value="Submit">
                                            </div>
                                            <div class="col-md-6 offset-md-6 col-xs-6"  >
                                                <input type="hidden" name="statusType" value="closed">
                                                <input type="submit" class="btn btn-primary"  value="Close Entry">
                                            </div>
                                            <div class="col-md-6 offset-md-6 col-xs-6"  >
                                                <input type="hidden" name="statusType" value="closed">
                                                <input type="submit" class="btn btn-primary"  value="Forward">
                                            </div>
                                        @endif
                                        @if($entry->status=="closed")
                                            <div class="col-md-6 offset-md-6 col-xs-6"  >
                                                <input type="hidden" name="statusType" value="closed">
                                                <input type="submit" class="btn btn-primary"  value="Forward">
                                            </div>
                                        @endif

                                        <div class="col-md-3 col-xs-6"  >
                                            <button  type="reset" class="btn btn-danger" value="cancel">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Middle Column -->
            </div>

            <!-- Right Column -->
            <div class="col-md-3">
                <div class="row">
                    <p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createPost">
                            Create a Post
                        </button></p>
                    <div class="row justify-content-center">

                        <div class="card" style="margin-top: 10px">
                            <div class="card-header">{{ __('Progress') }}</div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-11">
                                        @if($entry->status=="new")
                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->progress }}</p>
                                        @endif
                                        @foreach($entryProgresses as $entryProgress)
                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $entryProgress->progress }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>

    <br>

    {{--Create Post--}}
    <div class="modal fade" id="createPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-dialog-centered" role="document">
            <div  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerPoliceOfficer">Create Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="createPost" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control" name="title" placeholder="Title of the Post" required autofocus>
                                <input type="hidden" name="entryId" value="{{$entry->entryID}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Content</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="postContent" rows="3"></textarea>
                            </div>

                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Post') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
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
                    <form method="post" action="removeFormView" enctype="multipart/form-data">
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


@endsection
