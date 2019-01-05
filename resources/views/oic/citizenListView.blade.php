@extends('layouts.app')

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
    <div class="container-fluid" style="max-width:1400px;">
        <!-- The Grid -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-3">
                <!-- Accordion -->
                <div class="card">
                    <div class="bg-white">
                        <button onclick="myFunction('citizenManagement')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Citizen Management</button>
                            <div id="citizenManagement" class="w3-hide w3-container">
                                <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewNewCitizenRequests">New Registration Requests</a></button>
                                <br>
                                <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewRegisteredCitizens">Registered Citizens</a></button>
                                <br>
                                <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewClosedAccounts">Closed Accounts</a></button>
                            </div>

                    </div>
                </div>
                <br>

                <!-- End Left Column -->
            </div>

            <!-- Middle Column -->
            <div class="col-md-8" style="margin-right: 40px;margin-left: 20px;margin-bottom: 10px">
                <div class="row">
                    <div class="col-md-6">
                        <h2>{{$type}}</h2>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control" id="myInput" type="text" placeholder="Search...">
                        <br>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">NIC</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @foreach($citizens as $citizen)
                        <tr>
                            <td>
                                    @if($type=="Registered Citizens")
                                    <button type="button" value="{{ $citizen->nic }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                        {{ $citizen->nic }}
                                    </button>
                                        @endif
                                        @if($type=="New Citizen Registration Requests")
                                            <form method="post" action="{{'reviewCitizenRegistrationRequest'}}">
                                                @csrf
                                                <input type="hidden" value="{{ $citizen->nic }}" name="nic">
                                                <input type="submit" class="btn btn-primary" value="{{ $citizen->nic }}">
                                            </form>
                                        @endif
                                        @if($type=="Closed Accounts")
                                            <button type="button" value="{{ $citizen->nic }}" id="nicbutton" class="btn btn-primary nic-button-closed" data-toggle="modal" data-target="#viewPerson">
                                                {{ $citizen->nic }}
                                            </button>
                                        @endif


                            </td>
                            <td>{{$citizen->fullName}}</td>
                            <td>{{$citizen->email}}</td>
                            <td>{{$citizen->address}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- End Middle Column -->
            </div>

            <!-- Right Column -->
            <div class="col-md-3">

            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
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
                    <form method="post" action="manageCitizen" enctype="multipart/form-data">
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
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Message</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="citizenMessage" id="exampleFormControlTextarea1" rows="2"></textarea>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary" name="submitButton" value="sendMessage">
                                    {{ __('Send') }}
                                </button>
                            </div>

                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" name="submitButton" value="removeCitizen">
                                    {{ __('Remove Citizen') }}
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

        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
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
    </script>

@endsection
