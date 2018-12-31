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
    <!-- Navbar on small screens -->
    {{--<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">--}}
        {{--<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>--}}
        {{--<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>--}}
        {{--<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>--}}
        {{--<a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>--}}
    {{--</div>--}}

    <!-- Page Container -->
    <div class="container-fluid" style="max-width:1400px;margin-top:8px;background-color: lightblue">
        <!-- The Grid -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-3">
                <!-- Profile --> <div class="card bg-white">
                    <div class="container">
                        <h4 class="text-center">My Profile</h4>
                        <p class="text-center"><img src='{{asset('/img/oic.jpeg')}}' class="rounded-circle" style="height:106px;width:106px" alt="IGP Image"></p>
                        <hr>
                        <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->profession}}</p>
                        <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->policeOffice}}</p>
                    </div>
                </div>

                <br>

                <!-- Accordion -->
                <div class="card">
                    <div class="bg-white">
                        <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Entries</button>
                        <div id="Demo1" class="w3-hide w3-container">
                            <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewNewEntries">New Entries</a></button>
                            <br>
                            <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewOngoingEntries">Ongoing Entries</a></button>
                            <br>
                            <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewClosedEntries">Closed Entries</a></button>

                        </div>
                        <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Invetigation Branches</button>
                        <div id="Demo2" class="w3-hide w3-container">
                            {{--<p>Some other text..</p>--}}
                        </div>
                        <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>D Type Crime Enquries</button>
                    </div>
                </div>
                <br>
                <!-- End Left Column -->
            </div>
            <!-- Middle Column -->
            <div class="col-md-5">



                <!-- End Middle Column -->
            </div>

            <!-- Right Column -->
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card rounded bg-white align-content-center">
                            <div class="w3-container">
                                <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                        View Crime Entries
                                    </button></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white w3-center">
                            <div class="w3-container">
                                <p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerPoliceOffice">
                                        Call Up relevant Branches
                                    </button></p>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                {{--<div class="w3-card w3-round w3-white w3-padding-16 w3-center">--}}
                {{--<p>ADS</p>--}}
                {{--</div>--}}
                <br>

            {{--<div class="w3-card w3-round w3-white w3-padding-32 w3-center">--}}
            {{--<p><i class="fa fa-bug w3-xxlarge"></i></p>--}}
            {{--</div>--}}

            <!-- End Right Column -->
            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>


    <!-- Modal -->
    <div class="modal fade" style="width:1250px" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Crime Entries</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php
                    $entryList=db::table('entries')->get();
                    ?>
                </div>
                <div class="modal-body ">
                    {{--<div style="overflow-x:auto;">--}}
                    {{--<input class="form-control" id="myInput" type="text" placeholder="Search..">--}}
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Entry ID</th>
                            <th scope="col">Date and Time</th>
                            <th scope="col">Complaint Category</th>
                            <th scope="col">Complainant NIC</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody id="entryTable">
                        @foreach($entryList as $entry)
                        <tr>
                            <th scope="row">{{$entry->entryID}}</th>
                            <td>{{$entry->created_at}}</td>
                            <td>{{$entry->complaintCategory}}</td>
                            <td>{{$entry->complainantID}}</td>
                            <td><button>View</button></td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    </script>

    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#entryTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

@endsection
