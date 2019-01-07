@extends('admin.adminApp')
@section('content')

    <div class="content-header">
        <h1>
            View Police Officers List
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
                        {{--Register IGP office form--}}
                        <div class="container-fluid">
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
                                    <th scope="col">E-Mail</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>

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
                                        </td>

                                        <td></form>
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
    <script>
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






