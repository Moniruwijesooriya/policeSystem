@extends('igp.igpApp')
@section('content')

    <div class="content-header">
        <h1>
            Entry
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
                        {{--View Office List--}}
                        <div class="container-fluid">
                            <!-- The Grid -->
                            <div class="row" style="border-radius: 8px;background-color: lightgray">
                                <!-- Left Column -->
                                <div class="col-md-2 table-col tc-left" style="background-color: whitesmoke;margin-left:30px;margin-top: 30px">
                                    <!-- Accordion -->
                                    <div class="card">
                                        <div class="bg-grey">
                                            <button onclick="myFunction('newEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>New Entries</button>
                                            <br>
                                            <div id="newEntries" class="w3-hide w3-container">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        @foreach($newEntries as $entry)

                                                            <form method="post" action="{{'viewOICEntry'}}">
                                                                @csrf
                                                                <input type="hidden" value="{{$entry->entryID}}" name="entryID">
                                                                <p><input type="submit" class="btn btn-primary" style="width: 100%" value="Entry ID :{{$entry->entryID}}"></p>
                                                            </form>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <button onclick="myFunction('ongoingEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Ongoing Entries</button>
                                            <br>
                                            <div id="ongoingEntries" class="w3-hide w3-container">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        @foreach($ongoingEntries as $entry)

                                                            <form method="post" action="{{'viewOICEntry'}}">
                                                                @csrf
                                                                <input type="hidden" value="{{$entry->entryID}}" name="entryID">
                                                                <p><input type="submit" class="btn btn-primary" style="width: 100%" value="Entry ID :{{$entry->entryID}}"></p>
                                                            </form>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <button onclick="myFunction('closedEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Closed Entries</button>
                                            <br>
                                            <div id="closedEntries" class="w3-hide w3-container">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        @foreach($closedEntries as $entry)

                                                            <form method="post" action="{{'viewOICEntry'}}">
                                                                @csrf
                                                                <input type="hidden" value="{{$entry->entryID}}" name="entryID">
                                                                <p><input type="submit" class="btn btn-primary" style="width: 100%" value="Entry ID :{{$entry->entryID}}"></p>
                                                            </form>
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
                                <div class="col-md-8 card" style="margin-bottom: 10px;margin-left:30px;border-radius: 8px;background-color: whitesmoke;margin-top: 30px" >
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="page-header" style="text-align: center">{{ __('Office') }}</div>

                                                <div class="form-group">
                                                    <form>
                                                        @csrf

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right" style="margin-left: 10px">{{ __('Office Name') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" value="{{ $officeDetails->policeOfficeArea }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">

                                                            <label class="col-md-4 col-form-label text-md-right" style="margin-left: 10px">{{ __('Office Officer Incharge') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" value="{{ $officeOfficerDetails->name }}"readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">

                                                            <label class="col-md-4 col-form-label text-md-right" style="margin-left: 10px;margin-top: 5px">{{ __('Office Officer NIC') }}</label>

                                                            <div class="col-md-6">
                                                                <button style="width: 100%" type="button" value="{{ $officeOfficerDetails->nic }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">{{ $officeOfficerDetails->nic }}</button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Middle Column -->
                                </div>




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
                        {{--<div class="form-group row">--}}
                        {{--<div class="col-md-3">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6" style="align-content: center">--}}
                        {{--<img id="userProfileImage" src='{{asset('/userProfileImages/'.$citizenDetails->nic.'.jpg')}}' class="user-image" alt="User Image">--}}

                        {{--</div>--}}
                        {{--<div class="col-md-3"></div>--}}
                        {{--</div>--}}

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
                                {{--<button type="submit" class="btn btn-primary">--}}
                                {{--{{ __('Check') }}--}}
                                {{--</button>--}}
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
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






