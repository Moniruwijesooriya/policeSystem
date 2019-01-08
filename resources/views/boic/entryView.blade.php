@extends('boic.boicApp')
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
                        {{--View Entry List--}}
                        <div class="container-fluid">
                            <!-- The Grid -->
                            <div class="row w3-grey">
                                <!-- Left Column -->
                                <div class="col-md-2 w3-light-grey table-col tc-left">
                                    <!-- Accordion -->
                                    <div class="card">
                                        <div class="bg-grey">
                                            <button onclick="myFunction('evidencesList')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Evidences</button>
                                            <div id="evidencesList" class="w3-hide w3-container">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        use Illuminate\Support\Facades\DB;
                                                        $citizenDetails = db::table('users')->where('nic',$entry->complainantID)->First();
                                                        ?>

                                                        <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->evidences }}<br>-------------------<br>Submitted by Registered {{$citizenDetails->role}} {{$citizenDetails->name}} on {{$entry->created_at}} <button type="button" value="{{ $entry->complainantID }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                                                {{ $entry->complainantID }}
                                                            </button></p>
                                                        @foreach($evidences as $evidence)
                                                                <?php
                                                                $citizenDetails2 = db::table('users')->where('nic',$evidence->witnessId)->First();
                                                                ?>
                                                            @if($evidence->evidence_txt=="Image Evidence")
                                                                        <p contenteditable="false" class="w3-border w3-padding" >
                                                                    @for($i=1;$i<=$evidence->evidence_image_count;$i++)
                                                                        <img style="width: 25%;height: 150px;margin: 5px" src='{{asset("/evidences/$entry->entryID/$evidence->evidence_image/".$i.'.jpg')}}' style="width:100%" alt="{{$entry->entryID}}">

                                                                    @endfor
                                                                        <br>-------------------<br>Submitted by {{$citizenDetails2->role}} {{$citizenDetails2->name}} on {{$evidence->created_at}}
                                                                        <button type="button" value="{{ $evidence->witnessId }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                                                            {{ $evidence->witnessId }}
                                                                        </button>
                                                                        </p>

                                                                @endif
                                                                @if($evidence->evidence_txt!="Image Evidence")
                                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $evidence->evidence_txt }}<br>Submitted by {{$citizenDetails2->role}} {{$citizenDetails2->name}} on {{$evidence->created_at}}
                                                                <button type="button" value="{{ $evidence->witnessId }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                                                    {{ $evidence->witnessId }}
                                                                </button>
                                                            </p>
                                                                    @endif
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
                                <div class="col-md-6 table-col tc-middle" style="margin-right: 40px;margin-left: 20px;margin-bottom: 10px" >
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">{{ __('Entry') }}</div>

                                                <div class="form-group">
                                                    <form method="post" action="{{ route('entryOICAction') }}" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="form-group row">
                                                            <label class="col-md-3 col-form-label text-md-right">{{ __('Entry ID') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $entry->entryID }}" readonly>
                                                                <input type="hidden" name="entryID" value="{{ $entry->entryID }}">
                                                                <input type="hidden" name="policeStation" value="{{ $entry->nearestPoliceStation }}">
                                                                <input type="hidden" name="initialProgress" value="{{ $entry->progress }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3 col-form-label text-md-right">{{ __('Complainant NIC') }}</label>

                                                            <div class="col-md-6">
                                                                <button type="button" value="{{ $entry->complainantID }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">{{ $entry->complainantID }}</button>
                                                                <input type="hidden" name="complainantNIC" value="{{ $entry->complainantID }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 col-form-label text-md-right">{{ __('Date And Time') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $entry->created_at }}" readonly>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <label class="col-md-3 col-form-label text-md-right">{{ __('Complaint Category') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $entry->complaintCategory }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">

                                                            <label class="col-md-3 col-form-label text-md-right">{{ __('Complaint') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="hidden" value="{{ $entry->complaint }}" name="complaint">
                                                                <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->complaint }}</p>
                                                            </div>
                                                        </div>

                                                        @if($entry->status=="new")
                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-form-label text-md-right">{{ __('Branch') }}</label>
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
                                                                <label class="col-md-3 col-form-label text-md-right">{{ __('Current Branch') }}</label>

                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"value="{{ $entry->branch }}" readonly>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="form-group row">
                                                            <label class="col-md-3 col-form-label text-md-right">{{ __('Evidences') }}</label>
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" name="evidence" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                            </div>
                                                            <div class="form-check col-md-3">
                                                                <input type="checkbox" class="form-check-input" name="evidenceCitizenView" value="Yes" id="exampleCheck1">
                                                                <label class="form-check-label" for="exampleCheck1" style="width:100%">Allow Submitter to View</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="profileImage" class="col-md-3 col-form-label text-md-right">{{ __('Evidence Images') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="file"  class="form-control" accept="image/*" name="evidenceImage[]" style="height: 100%" multiple>

                                                                @if ($errors->has('landNumber'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('landNumber') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-check col-md-3">
                                                                <input type="checkbox" class="form-check-input" name="evidenceImageCitizenView" value="Yes" id="exampleCheck1">
                                                                <label class="form-check-label" for="exampleCheck1">Allow Submitter to View</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 col-form-label text-md-right">Suspects</label>
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" name="suspects" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                            </div>
                                                            <div class="form-check col-md-3">
                                                                <input type="checkbox" class="form-check-input" name="suspectCitizenView" value="Yes" id="exampleCheck1">
                                                                <label class="form-check-label" for="exampleCheck1">Allow Submitter to View</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 col-form-label text-md-right">Progress</label>
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" name="entryProgress" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                            </div>
                                                            <div class="form-check col-md-3">
                                                                <input type="checkbox" class="form-check-input" name="progressCitizenView" value="Yes" id="exampleCheck1">
                                                                <label class="form-check-label" for="exampleCheck1">Allow Submitter to View</label>
                                                            </div>

                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-3"></div>
                                                            @if($entry->status=="new")
                                                                <div class="col-md-2 offset-md-3 col-xs-6"  style="width: 18.75%">
                                                                        <input type="hidden" name="statusType" value="{{$entry->status}}">
                                                                    <input type="submit" class="btn btn-primary" value="Accept and Forward" style="width: 100%">
                                                                </div>
                                                            @endif
                                                            @if($entry->status=="ongoing")
                                                                <div class="col-md-2 offset-md-3 col-xs-6"  style="width: 18.75%">
                                                                    <input type="hidden" name="statusType" value="{{$entry->status}}">
                                                                    <input type="submit" class="btn btn-primary" name="ongoingSubmit" value="Submit" style="width: 100%">
                                                                </div>
                                                                <div class="col-md-2 offset-md-3 col-xs-6"  style="width: 18.75%">
                                                                    <input type="submit" class="btn btn-primary" name="ongoingSubmit" value="Close Entry" style="width: 100%">
                                                                </div>
                                                                <div class="col-md-2 offset-md-3 col-xs-6"  style="width: 18.75%">
                                                                    <input type="submit" class="btn btn-primary" name="ongoingSubmit" value="Forward" style="width: 100%">
                                                                </div>
                                                            @endif
                                                            @if($entry->status=="closed")
                                                                <div class="col-md-2 offset-md-3 col-xs-6"  style="width: 18.75%">
                                                                    <input type="hidden" name="statusType" value="closed" style="width: 100%">
                                                                    <input type="submit" class="btn btn-primary"  value="Forward" style="width: 100%">
                                                                </div>
                                                            @endif

                                                            <div class="col-md-2 col-xs-6"  style="width: 18.75%">
                                                                <button  type="reset" class="btn btn-danger" value="cancel" style="width: 100%">Reset</button>
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
                                <div class="col-md-5 w3-light-grey table-col tc-right">
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
                        <div class="form-group row">
                            <div class="form-check col-md-4">
                                <input type="checkbox" class="form-check-input" name="districtView" value="Yes" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">District View</label>
                            </div>
                            <div class="form-check col-md-4">
                                <input type="checkbox" class="form-check-input" name="provinceView" value="Yes" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Province View</label>
                            </div>
                            <div class="form-check col-md-4">
                                <input type="checkbox" class="form-check-input" name="countryView" value="Yes" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Country View</label>
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
                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-3">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6" style="align-content: center">--}}
                                {{--<img src='{{asset('/userProfileImages/'.$citizenDetails->nic.'.jpg')}}' class="user-image" alt="User Image">--}}

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





