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

           </style>
    <!-- Navbar -->

    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:5px">
        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m2">
                @if(Auth::User()->role=='citizen')
                <div class="w3-card w3-round">
                    <div class="w3-white">
                        <button onclick="myFunction('myEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Submitted Entries</button>
                        <div id="myEntries" class="w3-hide w3-container">
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}

                            <?php
                            $entries=db::table('entries')->where('complainantID',Auth::User()->nic)->get();
                            ?>
                            @foreach($entries as $entr)

                                <form method="post" action="{{'viewCitizenEntry'}}">
                                    @csrf
                                    <input type="hidden" value="{{$entr->entryID}}" name="entryID">
                                    <p><input type="submit" class="btn-link" value="Entry ID :{{$entr->entryID}}"></p>
                                </form>
                            @endforeach
                            {{--</div>--}}
                        </div>

                    </div>
                </div>
                    @endif

                    <div class="card" style="margin-top: 10px">
                        <div class="card-header">{{ __('Evidences') }}</div>
                        <div class="card-body">
                            <div class="form-group row">
                                <?php
                                $evidences=db::table('entries')->where('entryID',$entr->entryID)->First();
                                ?>
                                <div class="col-md-11">
                                    <input type="text" class="form-control"value="{{ $evidences->evidences }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>


            <!-- Middle Column -->
            <div class="w3-col m6">
                <div class="row justify-content-center">
                    <div class="col-md-11" style="margin-left: 6px;margin-right: 6px">
                        <div class="card">
                            <div class="card-header">{{ __('Entry') }}</div>

                            @if(Auth::User()->role=='Officer Incharge of Police Station')

                            <div class="card-body">
                                <form method="post" action="{{ route('acceptOICEntry') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Entry ID') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="entryId" value="{{ $entry->entryID }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Complainant NIC') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="complainantNIC" value="{{ $entry->complainantID }}" readonly>
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

                                    <div class="form-group row">
                                        <label for="Progress" class="col-md-4 col-form-label text-md-right">{{ __('Progress') }}</label>

                                        <div class="col-md-6">
                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->progress }}</p>
                                            {{--<input id="progress" type="text" class="form-control{{ $errors->has('progress') ? ' is-invalid' : '' }}" name="progress" value="{{ $entry->progress }}" required autofocus>--}}

                                        </div>
                                    </div>

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

                                    <div class="form-group row">
                                        <label for="suspects" class="col-md-4 col-form-label text-md-right">{{ __('Suspects') }}</label>

                                        <div class="col-md-6">
                                            <input id="suspects" type="text" class="form-control{{ $errors->has('suspects') ? ' is-invalid' : '' }}" name="suspects" value="{{ $entry->suspects }}" required autofocus>

                                            @if ($errors->has('suspects'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('suspects') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-6 col-xs-6"  >
                                            <input type="submit" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>@endif


                                {{--@if(Auth::User()->role=='citizen')--}}
                                <div class="card-body">
                                    <form method="post" action="{{ route('updateCitizenEntry') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Entry ID') }}</label>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control"value="{{ $entry->entryID }}" readonly>
                                                <input type="hidden" name="entryId" value="{{ $entry->entryID }}">
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
                                                {{--<input type="text" class="form-control"value="{{ $entry->evidences }}" readonly>--}}
                                                <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->evidences }}</p>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-6 col-xs-6"  >
                                                <input type="submit" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                    {{--@endif--}}
                        </div>
                    </div>
                </div>

                <!-- End Middle Column -->
            </div>

            <!-- Right Column -->
            <div class="w3-col m4">
                <div class="row">
                    <div class="w3-card w3-round">
                        <div class="w3-white">
                            <button onclick="myFunction('progress')" class="w3-button w3-block w3-theme-l1 w3-center-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-left"></i>Progress</button>
                            <div id="progress" class="w3-hide w3-container">

                                <?php
                                $progress=db::table('entries')->where('entryID',$entr->entryID)->First();
                                ?>
                                    <div class="w3-col m11">
                                        <input type="text" class="form-control"value="{{ $progress->progress }}" readonly>
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
