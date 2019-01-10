@extends('registeredCitizen.registeredCitizenNav')
<?php
use Illuminate\Support\Facades\DB;
?>
<style>
    .table-col {
        width: auto;
        height: auto;
        min-height: 10%;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        margin: 0.5% 0.5% 0.5% 0.5%;
        padding: 1% 1% 1% 1%;
        opacity: 1;

        box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
    }
    /*.tc-left{
        min-width: 15%;
    } */
    .tc-middle{
        min-width: 45%;
        padding-left: 3%;

    }
    .tc-right{
        min-width: 40%;
        padding-left: 3%;
    }
</style>
@section('content1')
    <div class="container-fluid" style="max-width:1400px;background-color:whitesmoke">
        <!-- The Grid -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-3 table-col" style="margin-top: 10px">
                @if(Auth::User()->role=='citizen')
                    <div class="card">
                        <div class="bg-white">
                            <button onclick="myFunction('myEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Submitted Entries</button>
                            <br>
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
                            <br>
                            <div id="evidencesList" class="w3-hide w3-container">
                                <div class="form-group row"> <div class="col-md-12">
                                        <?php
                                        $citizenDetails = db::table('users')->where('nic',$entry->complainantID)->First();
                                        ?>
                                        @if($entry->evidences!=null)
                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->evidences }}<br>-------------------<br>Submitted by Registered {{$citizenDetails->role}} {{$citizenDetails->name}} on {{$entry->created_at}} </p>
                                        @endif


                                        @foreach($evidences as $evidence)
                                            <?php
                                            $citizenDetails2 = db::table('users')->where('nic',$evidence->witnessId)->First();
                                            ?>
                                            @if($evidence->evidence_txt=="Image Evidence")
                                                <p contenteditable="false" class="w3-border w3-padding" >
                                                    @for($i=1;$i<$evidence->evidence_image_count;$i++)
                                                        <img style="width: 100%;height: 150px;margin: 5px" src='{{asset("/evidences/$entry->entryID/$evidence->evidence_image/".$i.'.jpg')}}' style="width:100%" >

                                                    @endfor
                                                    <br>-------------------<br>Submitted by {{$citizenDetails2->role}} {{$citizenDetails2->name}} on {{$evidence->created_at}}
                                                </p>

                                            @endif
                                            @if($evidence->evidence_txt!="Image Evidence")
                                                <p contenteditable="false" class="w3-border w3-padding" >{{ $evidence->evidence_txt }}<br>-------------------<br>Submitted by {{$citizenDetails2->role}} {{$citizenDetails2->name}} on {{$evidence->created_at}}
                                                </p>
                                            @endif
                                        @endforeach
                                    </div></div>

                            </div>
                            <button onclick="myFunction('suspectList')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Suspects</button>
                            <br>
                            <div id="suspectList" class="w3-hide w3-container">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                            @if($entry->suspects!=null)
                                                <p contenteditable="false" class="w3-border w3-padding" >{{$entry->suspects}}</p>
                                            @endif
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
            <div class="col-md-5 table-col"style="margin-top: 10px;margin-right: 40px;margin-left: 40px;margin-bottom: 10px">
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
                                        <label for="profileImage" class="col-md-4 col-form-label text-md-right">{{ __('Evidence Images') }}</label>

                                        <div class="col-md-6">
                                            <input type="file"  class="form-control" accept="image/*" name="evidenceImage[]"  multiple>

                                            @if ($errors->has('landNumber'))
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('landNumber') }}</strong>
                                                                    </span>
                                            @endif
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
            <div class="col-md-3 table-col" style="margin-top: 10px">
                {{--<div class="">--}}
                    {{--<div style="margin-top: 10px">--}}
                        {{--<form action="viewHigherAuthorityAttention" method="post" >--}}
                            {{--@csrf--}}
                            {{--<input type="hidden" name="entryIDTemp" value="{{$entry->entryID}}">--}}
                            {{--<input type="submit" class="btn btn-dark" value="Request Higher Authority Attention" style="background-color:cadetblue">--}}
                        {{--</form>--}}
                    {{--</div>--}}
                    {{--<div class=" justify-content-center">--}}
                <div class="card">
                    <div class="bg-white">
                        <button onclick="myFunction('progress')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-line-chart fa-fw w3-margin-right"></i>Progress</button>
                        <br>
                        <div id="progress" class="w3-hide w3-container">
                            <div class="form-group row">
                                <div class="col-md-12">

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

            <!-- End Grid -->
        </div>
        <!-- End Page Container -->
    </div>

@endsection
