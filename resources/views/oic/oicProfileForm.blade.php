@extends('oic.oicApp')
@section('content')
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            @if(Session::has('passwordUpdateMessage'))
                <div class="alert alert-success m1200" role="alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    {{Session::get('passwordUpdateMessage')}}
                    {{Session::forget('passwordUpdateMessage')}}
                </div>
            @endif
        </div>
    </div>
    <div class="content-header">
        <h1>
            Update Profile
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
                            <form method="POST" action="oicUpdateProfile" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Officer Rank') }}</label>

                                    <div class="col-md-6">
                                        <input id="profession" type="text" class="form-control" name="profession" value="{{$oicDetails->profession}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="fullName" type="text" class="form-control" name="fullName" value="{{$oicDetails->fullName}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{$oicDetails->name}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                    <div class="col-md-6">
                                        <input id="nic" type="text" pattern=".{10,12}" class="form-control" name="nic" value="{{$oicDetails->nic}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="homeAddress" class="col-md-4 col-form-label text-md-right">{{ __('Police Station') }}</label>

                                    <div class="col-md-6">
                                        <input id="homeAddress" type="text" class="form-control" name="homeAddress" value="{{$oicDetails->policeOffice}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="homeAddress" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="homeAddress" type="text" class="form-control" name="homeAddress" value="{{$oicDetails->address}}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                                    <div class="col-md-6">
                                        <input id="mobNumber" type="text" maxlength="10" class="form-control" name="mobNumber" value="{{$oicDetails->mobileNumber}}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>
                                    <div class="col-md-6">
                                        <input id="landNumber" type="text" maxlength="10" class="form-control" name="landNumber" value="{{$oicDetails->landLineNumber}}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{$oicDetails->email}}" required>
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
@endsection






