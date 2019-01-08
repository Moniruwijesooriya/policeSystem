@extends('admin.adminApp')
@section('content')

    <div class="content-header">
        <h1>
            Update Profile
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
                        <form method="POST" action="adminInfoUpdate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fullName" type="text" class="form-control" name="fullName" value="{{$citizenDetails->fullName}}" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$citizenDetails->name}}" readonly>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                <div class="col-md-6">
                                    <input id="nic" type="text" pattern=".{10,12}" class="form-control" name="nic" value="{{$citizenDetails->nic}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="homeAddress" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>

                                <div class="col-md-6">
                                    <input id="homeAddress" type="text" class="form-control" name="homeAddress" value="{{$citizenDetails->address}}" required autofocus>

                                </div>
                            </div>


                            </div>

                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                                <div class="col-md-6">
                                    <input id="profession" type="text" class="form-control" name="profession" value="{{$citizenDetails->profession}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input id="mobNumber" type="text" maxlength="10" class="form-control" name="mobNumber" value="{{$citizenDetails->mobileNumber}}" required autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>

                                <div class="col-md-6">
                                    <input id="landNumber" type="text" maxlength="10" class="form-control" name="landNumber" value="{{$citizenDetails->landLineNumber}}" required autofocus>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{$citizenDetails->email}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input  onkeyup="validatePassword()" id="confirm_password" type="password" class="form-control" name="confirm_password" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-10  col-xs-4">
                                    <a href="/admin"><button type="button" class="btn btn-secondary" >Cancel</button></a>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>

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
