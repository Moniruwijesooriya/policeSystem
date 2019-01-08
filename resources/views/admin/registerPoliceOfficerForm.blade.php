
@extends('admin.adminApp')
@section('content')

    <div class="content-header">
        <h1>
            Register Police Officer
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
                        <form method="POST" action="{{ route('registerPoliceOfficer') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-7">
                                    <input id="fullName" type="text" class="form-control{{ $errors->has('fullName') ? ' is-invalid' : '' }}" name="fullName" value="{{ old('fullName') }}" required autofocus>

                                    @if ($errors->has('fullName'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>

                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                <div class="col-md-7">
                                    <input id="nic" type="text" pattern=".{10,12}" class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" value="{{ old('nic') }}" required autofocus>

                                    @if ($errors->has('nic'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nic') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-7">
                                    <input id="dob" type="date" class="form-control" name="dob"  required autofocus>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="col-md-3">
                                    <div class="radio">
                                        <label><input type="radio" name="gender" value="Male" checked>Male</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="radio">
                                        <label><input type="radio" name="gender" value="Female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="civilStatus" class="col-md-4 col-form-label text-md-right">{{ __('Civil Status') }}</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="civilStatus" id="exampleFormControlSelect1">
                                        <option>Single</option>
                                        <option>Married</option>
                                        <option>Divorced</option>
                                        <option>Widowed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profileImage" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                                <div class="col-md-6">
                                    <input type="file"  accept="image/*" class="form-control" name="profileImage" required autofocus>

                                    @if ($errors->has('landNumber'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('landNumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="homeAddress" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>

                                <div class="col-md-7">
                                    <input id="homeAddress" type="text" class="form-control{{ $errors->has('homeAddress') ? ' is-invalid' : '' }}" name="homeAddress" value="{{ old('homeAddress') }}" required autofocus>

                                    @if ($errors->has('homeAddress'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('homeAddress') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-7">
                                    <input id="mobNumber" type="text" maxlength="10" class="form-control{{ $errors->has('mobNumber') ? ' is-invalid' : '' }}" name="mobNumber" value="{{ old('mobNumber') }}" required autofocus>

                                    @if ($errors->has('mobNumber'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobNumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>

                                <div class="col-md-7">
                                    <input id="landNumber" type="text" maxlength="10" class="form-control{{ $errors->has('landNumber') ? ' is-invalid' : '' }}" name="landNumber" value="{{ old('landNumber') }}" required autofocus>

                                    @if ($errors->has('landNumber'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('landNumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rank" class="col-md-4 col-form-label text-md-right">{{ __('Officer Rank') }}</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="profession" id="exampleFormControlSelect1">
                                        <option>Inspector General of Police</option>
                                        <option>Senior Deputy Inspector General of Police</option>
                                        <option>Deputy Inspector General of Police</option>
                                        <option>Senior Superintendent of Police</option>
                                        <option>Superintendent of Police</option>
                                        <option>Assistant Superintendent of Police</option>
                                        <option>Chief Inspector of Police</option>
                                        <option>Inspector of Police </option>
                                        <option>Sub Inspector of Police</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('System Role') }}</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="role" id="systemRoleSelect">
                                        <option></option>
                                        <option>Branch Officer Incharge</option>
                                        <option>Officer Incharge of Police Station</option>
                                        <option>Division Officer Incharge</option>
                                        <option>Inspector General of Police</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="officeNameTemp" id="officeNameId">
                            <div id="IGPSection" style="display: none">
                                <div class="form-group row">
                                    <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Police Office') }}</label>
                                    <div class="col-md-7">
                                        <input type="text"name="igpPoliceOffice"class="form-control"value="Sri Lanka Inspector General of Police Office" readonly>
                                    </div>
                                </div>
                            </div>
                            <div id="DIOGSection" style="display: none">
                                <div class="form-group row">
                                    <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Division Police Office') }}</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="doigPoliceOffice" id="exampleFormControlSelect1">
                                            @foreach($divisionPoliceOffices as $office)
                                                <option>{{$office->OfficeName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="OICSection" style="display: none">
                                <div class="form-group row">
                                    <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Police Station') }}</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="oicPoliceOffice" id="exampleFormControlSelect1">

                                            @foreach($policeStationOffices as $office)
                                                <option>{{$office->OfficeName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="BOICSection" style="display: none">
                                <div class="form-group row">
                                    <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Branch Police Office') }}</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="boicPoliceOffice" id="exampleFormControlSelect1">
                                            @foreach($branchPoliceOffices as $office)
                                                <option>{{$office->OfficeName}}</option>
                                            @endforeach
                                        </select>

                                        {{--<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example--}}
                                        {{--<span class="caret"></span></button>--}}
                                        {{--<ul class="dropdown-menu">--}}
                                        {{--<input class="form-control" id="myInput" type="text" placeholder="Search..">--}}
                                        {{--<select class="dropdown boic-select" name="boicPoliceOffice" id="exampleFormControlSelect1">--}}
                                        {{--@foreach($branchPoliceOffices as $office)--}}
                                        {{--<li><option>{{$office->OfficeName}}</option></li>--}}
                                        {{--@endforeach--}}
                                        {{--</select>--}}
                                        {{--</ul>--}}

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-7">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
    <script>
        $(document).ready(function () {
            var tempRole="";

            $("#systemRoleSelect").change(function () {
                tempRole= $(this).val();
                if(tempRole=="Inspector General of Police"){
                    $("#IGPSection").show();
                    $("#DIOGSection").hide();
                    $("#BOICGSection").hide();
                    $("#OICSection").hide();
                    $("#officeNameId").val("Inspector General of Police Office");

                }
                else{
                    if(tempRole=="Division Officer Incharge"){
                        $("#DIOGSection").show();
                        $("#OICSection").hide();
                        $("#IGPGSection").hide();
                        $("#BOICSection").hide();
                        $("#officeNameId").val("Division Police Office");
                    }
                    else {
                        if(tempRole=="Officer Incharge of Police Station"){
                            $("#OICSection").show();
                            $("#DIOGSection").hide();
                            $("#BOICSection").hide();
                            $("#IGPSection").hide();
                            $("#officeNameId").val("Police Station");
                        }
                        else{
                            if(tempRole=="Branch Officer Incharge"){
                                $("#BOICSection").show();
                                $("#IGPSection").hide();
                                $("#OICSection").hide();
                                $("#DIOGSection").hide();
                                $("#officeNameId").val("Branch Police Office");
                            }
                        }
                    }

                }
            });

        });
    </script>

@endsection


