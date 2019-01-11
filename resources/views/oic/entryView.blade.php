@extends('oic.oicApp')
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
                            <div class="row" style="border-radius: 8px;background-color: lightgray">
                                <!-- Left Column -->
                                <div class="col-md-2 table-col tc-left" style="background-color: whitesmoke;margin-left:30px;margin-top: 30px">
                                    <!-- Accordion -->
                                    <div class="card">
                                        <div class="bg-grey">
                                            <button onclick="myFunction('evidencesList')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Evidences</button>
                                            <br>
                                            <div id="evidencesList" class="w3-hide w3-container">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        use Illuminate\Support\Facades\DB;
                                                        $citizenDetails = db::table('users')->where('nic',$entry->complainantID)->First();
                                                        ?>
                                                        @if($entry->evidences!=null)
                                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->evidences }}<br>-------------------<br>Submitted by <strong>Registered {{$citizenDetails->role}}</strong> {{$citizenDetails->name}} on {{$entry->created_at}} <button type="button" value="{{ $entry->complainantID }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                                                    {{ $entry->complainantID }}
                                                                </button></p>
                                                        @endif
                                                        @foreach($evidences as $evidence)
                                                            <?php
                                                            $citizenDetails2 = db::table('users')->where('nic',$evidence->witnessId)->First();
                                                            ?>
                                                            @if($evidence->evidence_txt=="Image Evidence")
                                                                <p contenteditable="false" class="w3-border w3-padding" >
                                                                    @for($i=1;$i<$evidence->evidence_image_count;$i++)
                                                                        <img style="margin: 5px" src='{{asset("/evidences/$entry->entryID/$evidence->evidence_image/".$i.'.jpg')}}' style="width:100%" alt="{{$entry->entryID}}">

                                                                    @endfor<br>-------------------<br>Submitted by
                                                                    @if($citizenDetails2->role=="citizen")
                                                                        <strong>Registered {{$citizenDetails2->role}}</strong>
                                                                    @endif
                                                                    @if($citizenDetails2->role!="citizen")
                                                                        <strong>Registered {{$citizenDetails2->role}}</strong>
                                                                    @endif
                                                                    {{$citizenDetails2->name}} on {{$evidence->created_at}}
                                                                    <button type="button" value="{{ $evidence->witnessId }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">{{ $evidence->witnessId }}
                                                                    </button>
                                                                </p>

                                                            @endif
                                                            @if($evidence->evidence_txt!="Image Evidence")
                                                                <p contenteditable="false" class="w3-border w3-padding" >{{ $evidence->evidence_txt }}<br>-------------------<br>Submitted by <strong>Registered {{$citizenDetails2->role}}</strong> {{$citizenDetails2->name}} on {{$evidence->created_at}}
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
                                            <br>
                                            <div id="suspectList" class="w3-hide w3-container">
                                                <div class="form-group row">
                                                    <div class="col-md-11">
                                                        @if($entry->suspects!=null)
                                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->suspects }}</p>
                                                        @endif

                                                        @foreach($suspects as $suspect)
                                                            <?php
                                                            $citizenDetails3 = db::table('users')->where('nic',$suspect->userNic)->First();
                                                            ?>
                                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $suspect->name }}<br>-------------------<br>Submitted by {{$citizenDetails3->role}} {{$citizenDetails3->name}} on {{$suspect->created_at}}<button type="button" value="{{ $suspect->userNic }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                                                    {{ $evidence->witnessId }}
                                                                </button></p>
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
                                <div class="col-md-6 card" style="margin-bottom: 10px;margin-left:30px;border-radius: 8px;background-color: whitesmoke;margin-top: 30px" >
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="page-header" style="text-align: center">{{ __('Entry') }}</div>

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
                                                                <button style="width: 100%" type="button" value="{{ $entry->complainantID }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">{{ $entry->complainantID }}</button>
                                                                <input type="hidden" name="complainantNIC" value="{{ $entry->complainantID }}">
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $blackListedUser = db::table('users')->where('nic',$entry->complainantID)->First();
                                                        ?>
                                                        <div class="form-group row">
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4">
                                                                @if($blackListedUser->blackListStatus=="Yes")
                                                                    <p style="color: red">{{ __('Blacklisted Citizen') }}</p>
                                                                @endif
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
                                                                        @foreach($branches as $branch )
                                                                            <option>{{$branch->policeOfficeArea}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($entry->status=="ongoing")
                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-form-label text-md-right">{{ __('Current Branch') }}</label>

                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"value="{{ $currentBranch->policeOfficeArea }} Branch" readonly>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($entry->status!="closed")

                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-form-label text-md-right">{{ __('Text Evidences') }}</label>
                                                                <div class="col-md-6">
                                                                    <textarea class="form-control" name="evidence" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-check-label" for="exampleCheck1" style="width:100%;color: #b91d19;font-size: 13px;margin-top: 4px">Submitter View</label>
                                                                </div>
                                                                <div class="form-check col-md-1">
                                                                    <input type="checkbox" style="margin-top: 10px" class="form-check-input" name="evidenceCitizenView" value="Yes" id="exampleCheck1">

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="profileImage" class="col-md-3 col-form-label text-md-right">{{ __('Evidence Images') }}</label>

                                                                <div class="col-md-6">
                                                                    <input type="file"  class="form-control" accept="image/*" name="evidenceImage[]"  multiple>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-check-label" for="exampleCheck1" style="width:100%;color: #b91d19;font-size: 13px;margin-top: 4px">Submitter View</label>
                                                                </div>
                                                                <div class="form-check col-md-1">
                                                                    <input type="checkbox" style="margin-top: 10px" class="form-check-input" name="evidenceImageCitizenView" value="Yes" id="exampleCheck1">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-form-label text-md-right">Suspects</label>
                                                                <div class="col-md-6">
                                                                    <textarea class="form-control" name="suspects" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-check-label" for="exampleCheck1" style="width:100%;color: #b91d19;font-size: 13px;margin-top: 4px">Submitter View</label>
                                                                </div>
                                                                <div class="form-check col-md-1">
                                                                    <input type="checkbox" style="margin-top: 10px" class="form-check-input" name="suspectCitizenView" value="Yes" id="exampleCheck1">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-form-label text-md-right">Progress</label>
                                                                <div class="col-md-6">
                                                                    <textarea class="form-control" name="entryProgress" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-check-label" for="exampleCheck1" style="width:100%;color: #b91d19;font-size: 13px;margin-top: 4px">Submitter View</label>
                                                                </div>
                                                                <div class="form-check col-md-1">
                                                                    <input type="checkbox" style="margin-top: 10px" class="form-check-input" name="progressCitizenView" value="Yes" id="exampleCheck1">
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="form-group row mb-0">
                                                            @if($entry->status=="new")
                                                                <div class="col-md-5 col-xs-6">
                                                                    <input type="hidden" name="statusType" value="{{$entry->status}}">
                                                                    <input type="submit" class="btn btn-primary" value="Accept and Forward" style="width: 100%">
                                                                </div>
                                                                <div class="col-md-3 col-xs-6">
                                                                    <input type="hidden" name="statusType" value="reject">
                                                                    <input type="submit" class="btn btn-primary" value="Reject" style="width: 100%">
                                                                </div>
                                                                <div class="col-md-2 col-xs-6"  style="width: 18.75%">
                                                                    <button  type="reset" class="btn btn-danger" value="cancel">Reset</button>
                                                                </div>
                                                            @endif
                                                            @if($entry->status=="ongoing")
                                                                <div class="col-md-2 offset-md-3 col-xs-6"  style="width: 18.75%">
                                                                    <input type="hidden" name="statusType" value="{{$entry->status}}">
                                                                    <input type="submit" class="btn btn-yahoo" name="ongoingSubmit" value="Submit" >
                                                                </div>
                                                                <div class="col-md-2 offset-md-3 col-xs-6"  style="width: 25.75%">
                                                                    <input type="submit" class="btn btn-pinterest" name="ongoingSubmit" value="Close Entry" >
                                                                </div>
                                                                <div class="col-md-2 col-xs-6"  style="width: 18.75%">
                                                                    <button  type="reset" class="btn btn-danger" value="cancel">Reset</button>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Middle Column -->
                                </div>
                                <!-- Right Column -->

                                <div class="col-md-3"  >
                                    @if($entry->status=="ongoing")
                                        <div class="row">
                                            <button type="button" style="margin-top: 30px;margin-bottom: 15px;margin-left: 100px" class="btn btn-danger" data-toggle="modal" data-target="#createPost">
                                                Create a Post
                                            </button>
                                        </div>
                                    @endif
                                    <div class="row" >
                                        <div class="card" style="margin-bottom: 10px;margin-left: 60px;border-radius: 8px;background-color: whitesmoke;margin-top: 5px;float: right">
                                            <div class="card" style="margin-top: 10px">
                                                <div class="page-header" style="text-align: center;font-size: 15px">{{ __('Progress') }}</div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-12" style="align-content: center;">
                                                            @if($entry->status=="new")
                                                                <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->progress }}</p>
                                                            @endif
                                                            @foreach($entryProgresses as $entryProgress)
                                                                <p style="margin: 5px;background-color: lightgray;padding: 10px">{{ $entryProgress->progress }}</p>
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
@endsection






