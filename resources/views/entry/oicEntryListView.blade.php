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
    <div class="container-fluid" style="max-width:1400px;">
        <!-- The Grid -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-3">
                <!-- Accordion -->
                <div class="card">
                    <div class="bg-white">
                        <button onclick="myFunction('entryView')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Entries</button>
                        <div id="entryView" class="w3-container">
                            <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewNewEntries">New Entries</a></button>
                            <br>
                            <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewOngoingEntries">Ongoing Entries</a></button>
                            <br>
                            <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewClosedEntries">Closed Entries</a></button>

                        </div>
                        <button onclick="myFunction('filterentries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Filter</button>
                        <div id="filterentries" class="w3-container">
                            <button class="btn-dark" style="margin: 5px;width: 100%;"><a href="viewClosedEntries">Closed Entries</a></button>
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
                        <th scope="col">Entry ID</th>
                        <th scope="col">Complainant NIC</th>
                        <th scope="col">Complaint Category</th>
                        <th scope="col">Complaint</th>
                        <th scope="col">Date</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @foreach($entries as $entry)
                        <tr>
                            <td><form action="viewOICEntry" method="post">
                                    @csrf
                                    <input type="hidden" name="entryID" value="{{$entry->entryID}}">
                                    <input type="submit" value="{{$entry->entryID}}">
                                </form>
                            </td>
                            <td>{{$entry->complainantID}}</td>
                            <td>{{$entry->complaintCategory}}</td>
                            <td>{{$entry->complaint}}</td>
                            <td>{{$entry->created_at}}</td>
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
    </script>

@endsection
