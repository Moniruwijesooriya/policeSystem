@extends('boic.boicApp')
@section('content')

    <div class="content-header">
        <h1>
           Entry Management
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
                                        <td><form action="viewBOICEntry" method="post">
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
    <script>

    </script>
@endsection






