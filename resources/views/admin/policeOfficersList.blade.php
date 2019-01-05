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
            <div class="col-md-6">
                <input class="form-control" id="myInput" type="text" placeholder="Search...">
                <br>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Name with initials</th>
                <th scope="col">NIC</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Gender</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Landline Number</th>
                <th scope="col">System Role</th>
                <th scope="col">Officer Rank</th>
                <th scope="col">Police Office</th>
                <th scope="col">E-Mail Address</th>
            </tr>
            </thead>
            <tbody id="myTable">
            @foreach($policeOfficersList as $policeOfficer)
                <tr>
                    <td>{{$policeOfficer->fullName}}</td>
                    <td>{{$policeOfficer->name}}</td>
                    <td>{{$policeOfficer->nic}}</td>
                    <td>{{$policeOfficer->dob}}</td>
                    <td>{{$policeOfficer->gender}}</td>
                    <td>{{$policeOfficer->mobileNumber}}</td>
                    <td>{{$policeOfficer->landLineNumber}}</td>
                    <td>{{$policeOfficer->role}}</td>
                    <td>{{$policeOfficer->profession}}</td>
                    <td>{{$policeOfficer->policeOffice}}</td>
                    <td>{{$policeOfficer->email}}</td>
                    <td><form action="updatePoliceOfficerFormView" method="post">
                            @csrf
                            <input type="hidden" name="policeOfficer" value="{{$policeOfficer->nic}}">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>

                        </form>
                        <form action="removePoliceOfficer" method="post">
                            @csrf
                            <input type="hidden" name="policeOfficer" value="{{$policeOfficer->nic}}">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Remove') }}
                            </button>
                        </form>
                    </td>



                </tr>
            @endforeach
            </tbody>
        </table>

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
