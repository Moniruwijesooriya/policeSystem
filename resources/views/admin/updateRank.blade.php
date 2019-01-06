
@extends('admin.adminApp')
@section('content')

    <div class="content-header">
        <h1>
            Update Police Officers
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
                        <form method="post" action="updatePoliceOfficer" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->fullName }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nic" value="{{ $policeOfficer->nic }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->dob }}" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->gender }}" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->mobileNumber }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->landLineNumber }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categoryType" class="col-md-4 col-form-label text-md-right">{{ __('System Role') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="role" id="categoryType">
                                        <option>{{$policeOfficer->role}}</option>
                                        @foreach($dataSystemRole as $systemRole)
                                            @if($policeOfficer->role!=$systemRole->data)
                                                <option>{{$systemRole->data}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="categoryType" class="col-md-4 col-form-label text-md-right">{{ __('Officer Rank') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="officerRank" id="categoryType">
                                        <option>{{$policeOfficer->profession}}</option>
                                        @foreach($dataOfficerRank as $officerRank)
                                            @if($policeOfficer->profession!= $officerRank->data)
                                                <option>{{$officerRank->data}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categoryType" class="col-md-4 col-form-label text-md-right">{{ __('Police Office') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="policeOffice" id="categoryType">
                                        <option>{{$policeOfficer->policeOffice}}</option>
                                        @foreach($dataPoliceOffice as $policeOffices)
                                            @if($policeOfficer->policeOffice!= $policeOffices->OfficeName)
                                                <option>{{$policeOffices->OfficeName}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->email }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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

@endsection











