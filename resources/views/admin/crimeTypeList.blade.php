@extends('admin.adminApp')
@section('content')

    <div class="content-header">
        <h1>
            View Crime Types
        </h1>
    </div>

    <!-- Main content -->
    <div class="content">
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
                                    <th scope="col">ID</th>
                                    <th scope="col">Crime Type</th>
                                    <th scope="col">Category Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Police View</th>
                                    <th scope="col">Citizen View</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>

                                </tr>
                                </thead>
                                <tbody id="myTable">
                                @foreach($crimeTypeList as $crimeType)
                                    <tr>
                                        <td>{{$crimeType->id}}</td>
                                        <td>{{$crimeType->crimeType}}</td>
                                        <td>{{$crimeType->categoryType}}</td>
                                        <td>{{$crimeType->description}}</td>
                                        <td>{{$crimeType->policeView}}</td>
                                        <td>{{$crimeType->citizenView}}</td>
                                        <td>

                                                <form action="updateViewCrimeType" method="post">
                                                    @csrf
                                                    <input type="hidden" name="crimeIdTemp" value="{{$crimeType->id}}">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Update') }}
                                                    </button>

                                                </form></td>
                                        <td><form action="deleteCrimeType" method="post">
                                                @csrf
                                                <input type="hidden" name="crimeIdTemp" value="{{$crimeType->id}}">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form></td>



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









