@extends('oic.oicApp')
@section('content')

    <div class="content-header">
        <h1>
            Citizen Management
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
                            {{--List of new citizen registration requests--}}
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">NIC</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    @if($type=="Registered Citizens")
                                    <th scope="col">Remove</th>
                                        @endif
                                    @if($type=="New Citizen Registration Requests")
                                        <th scope="col">Remove</th>
                                    @endif

                                </tr>
                                </thead>
                                <tbody id="myTable">
                                @foreach($citizens as $citizen)
                                    <tr>
                                        <td>
                                            @if($type=="Registered Citizens")
                                                <button type="button" value="{{ $citizen->nic }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                                    {{ $citizen->nic }}
                                                </button>
                                            @endif
                                            @if($type=="New Citizen Registration Requests")
                                                <form method="post" action="{{'reviewCitizenRegistrationRequest'}}">
                                                    @csrf
                                                    <input type="hidden" value="{{ $citizen->nic }}" name="nic">
                                                    <input type="submit" class="btn btn-primary" value="{{ $citizen->nic }}">
                                                </form>
                                            @endif
                                            @if($type=="Closed Accounts")
                                                <button type="button" value="{{ $citizen->nic }}" id="nicbutton" class="btn btn-primary nic-button-closed" data-toggle="modal" data-target="#viewPerson">
                                                    {{ $citizen->nic }}
                                                </button>
                                            @endif


                                        </td>
                                        <td>{{$citizen->fullName}}</td>
                                        <td>{{$citizen->email}}</td>
                                        <td>{{$citizen->address}}</td>
                                        <td> @if($type=="New Citizen Registration Requests")
                                                <button type="button" value="{{ $citizen->nic }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                                    Remove
                                                </button>
                                        @endif
                                            @if($type=="Registered Citizens")
                                                <button type="button" value="{{ $citizen->nic }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">
                                                    Remove
                                                </button>
                                        @endif
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
        <div class="modal fade" id="viewPerson" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div  class="modal-dialog modal-dialog-centered" role="document">
                <div  class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerPoliceOfficer">Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="manageCitizen" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                <div class="col-md-7">
                                    <input id="nicTempId" type="text" class="form-control" name="nicTemp" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-7">
                                    <input id="nameTempId" type="text" class="form-control" name="nameTemp"  readonly></div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <div class="col-md-7">
                                    <input id="fullNameTempId" type="text" class="form-control" name="fullNameTemp"  readonly></div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-7">
                                    <input id="dobTempId" type="text" class="form-control" name="dobTemp"  readonly></div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                                <div class="col-md-7">
                                    <input id="addressTempId" type="text" class="form-control" name="addressTemp"  readonly></div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                                <div class="col-md-7">
                                    <input id="mobileNumberTempId" type="text" class="form-control" name="mobileNumberTemp"  readonly></div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Land Line Number') }}</label>
                                <div class="col-md-7">
                                    <input id="landLineNumberTempId" type="text" class="form-control" name="landLineNumberTemp"  readonly></div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-7">
                                    <input id="emailTempId" type="text" class="form-control" name="emailTemp"  readonly></div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-7">
                                    <input id="genderTempId" type="text" class="form-control" name="genderTemp"  readonly></div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>
                                <div class="col-md-7">
                                    <input id="professionTempId" type="text" class="form-control" name="professionTemp"  readonly></div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Relevant Police Station') }}</label>
                                <div class="col-md-7">
                                    <input id="policeStationId" type="text" class="form-control" name="policeStationTemp"  readonly></div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="submitButton" value="removeCitizen">
                                        {{ __('Remove Citizen') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
