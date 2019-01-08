@extends('registeredCitizen.registeredCitizenNav')
<?php
use Illuminate\Support\Facades\DB;
?>
@section('content1')
    <div class="container-fluid" style="max-width:1400px;background-color:whitesmoke">
        <!-- The Grid -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-3" style="margin-top: 20px">
                @if(Auth::User()->role=='citizen')
                    <div class="card">
                        <div class="bg-white">
                            <button onclick="myFunction('myEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Submitted Entries</button>
                            <div id="myEntries" class="w3-hide w3-container">
                                {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}

                                <?php
                                $entries=db::table('entries')->where('complainantID',Auth::User()->nic)->get();
                                ?>
                                @foreach($entries as $entr)

                                    <form method="post" action="{{'viewCitizenEntry'}}">
                                        @csrf
                                        {{--<button onclick="myFunction('myEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"></i>{{$entr->entryID}}</button>--}}
                                        <input type="hidden" value="{{$entr->entryID}}" name="entryID">
                                        <p><input type="submit" class="btn btn-primary" style="width: 100%" value="Entry ID :{{$entr->entryID}}"></p>
                                    </form>
                                @endforeach
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="bg-white">
                            <button onclick="myFunction('evidencesList')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Evidences</button>
                            <div id="evidencesList" class="w3-hide w3-container">
                                <div class="col-md-12">
                                    <?php
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
                            <button onclick="myFunction('suspectList')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Suspects</button>
                            <div id="suspectList" class="w3-hide w3-container">
                                <div class="form-group row">
                                    <?php
                                    $entryInfo=db::table('entries')->where('entryID',$entr->entryID)->First();
                                    ?>
                                    <div class="col-md-11">
                                        <p contenteditable="false" class="w3-border w3-padding" >{{ $entryInfo->suspects }}</p>
                                        @foreach($suspects as $suspect)
                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $suspect->name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>


            <!-- Middle Column -->
            <div class="col-md-5"style="margin-top: 10px;margin-right: 40px;margin-left: 20px;margin-bottom: 10px">
                <div class="row justify-content-center">
                    <div class="col-md-12" style="margin-left: 3px;margin-right: 3px">
                        <div class="card">
                            <div class="page-header" style="text-align: center">{{ __('Entry') }}</div>
                            <div class="card-body">
                                <form method="post" action="{{ route('updateCitizenEntry') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Entry ID') }}</label>

                                        <div class="col-md-6">
                                            <input type="text"name="entryID"class="form-control"value="{{ $entry->entryID }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Polie Station') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control"value="{{ $entry->nearestPoliceStation }}" readonly>
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
                                            {{--<input type="text" class="form-control"value="{{ $entry->complaint }}" readonly>--}}
                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->complaint }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Evidences') }}</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="evidence" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Suspects</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="suspects" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>

                                    </div>

                                    <div class="form-group row mb-0">


                                        <div class="col-md-3 col-xs-6"  >
                                            <input type="submit" class="btn btn-primary" value="Update">
                                        </div>
                                        <div class="col-md-3  col-xs-6"  >
                                            <button  type="reset" class="btn btn-danger" value="cancel">Reset</button>
                                        </div>
                                            <a href="RegisteredCitizen"><button type="button" class="btn btn-outline-secondary" >Cancel</button></a>
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
                    <div style="margin-top: 10px">
                        <form action="viewHigherAuthorityAttention" method="post" >
                            @csrf
                            <input type="hidden" name="entryIDTemp" value="{{$entry->entryID}}">
                            <input type="submit" class="btn btn-dark" value="Request Higher Authority Attention" style="background-color:cadetblue">
                        </form>
                    </div>
                    <div class="row justify-content-center">

                        <div class="card" style="margin-top: 10px">
                            <div class="card-header">{{ __('Progress') }}</div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-11">

                                        <?php
                                        $progr=db::table('entries')->where('entryID',$entry->entryID)->first();
                                        ?>
                                        @if($progr->branch==null)
                                                <p contenteditable="false" class="w3-border w3-padding"  style="background-color:darkgrey">{{ $entry->progress }}</p>
                                            @endif
                                    @foreach($entry_progress as $entry_progres)
                                            <p contenteditable="false" class="w3-border w3-padding"  style="background-color:darkgrey">{{ $entry_progres->progress }}</p>
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

@endsection
