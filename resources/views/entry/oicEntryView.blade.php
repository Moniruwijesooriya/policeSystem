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
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:50x">
        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3">
                <!-- Accordion -->
                <div class="card">
                    <div class="bg-white">
                        <button onclick="myFunction('evidencesList')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Evidences</button>
                        <div id="evidencesList" class="w3-hide w3-container">
                            <div class="form-group row">
                                <?php
                                $entryInfo=db::table('entries')->where('entryID',$entry->entryID)->First();
                                ?>
                                <div class="col-md-11">
                                    <p contenteditable="false" class="w3-border w3-padding" >{{ $entryInfo->evidences }}</p>
                                    @foreach($evidences as $evidence)
                                        <p contenteditable="false" class="w3-border w3-padding" >{{ $evidence->evidence_txt }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button onclick="myFunction('suspectList')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Suspects</button>
                        <div id="suspectList" class="w3-hide w3-container">
                            <div class="form-group row">
                                <?php
                                $entryInfo=db::table('entries')->where('entryID',$entry->entryID)->First();
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
                <br>




                <!-- End Left Column -->
            </div>

            <!-- Middle Column -->
            <div class="w3-col m7">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">{{ __('Entry') }}</div>

                            <div class="card-body">
                                <form method="post" action="{{ route('acceptOICEntry') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Entry ID') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control"value="{{ $entry->entryID }}" readonly>
                                            <input type="hidden" name="entryId" value="{{ $entry->entryID }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Complainant NIC') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control"value="{{ $entry->complainantID }}" readonly>
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
                                            {{--<input type="text" class="form-control"value="{{ $entry->complaint }}" readonly>--}}
                                            <p contenteditable="false" class="w3-border w3-padding" >{{ $entry->complaint }}</p>
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
                                        <div class="col-md-6 offset-md-6 col-xs-6"  >
                                            <input type="submit" class="btn btn-primary">
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
            <div class="w3-col m2">
                </div>

            <!-- End Right Column -->
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
