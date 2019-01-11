@extends('oic.oicApp')
@section('content')

    <div class="content-header">
        <h1>
            Change Password
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
                                    <h2></h2>
                                    <br>
                                </div>
                            </div>

                            <form method="POST" action="oicPasswordChange" >
                                @csrf

                                <div class="form-group row">
                                    <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                    <div class="col-md-6">
                                        <input type="hidden" name="nic" value="{{$oicDetails->nic}}">
                                        <input id="nic" type="text" pattern=".{10,12}" name="tmp" class="form-control"  value="{{$oicDetails->nic}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="currentpassword" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="newpassword" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="confirmpassword" required>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="\OIC"><button type="button" class="btn btn-secondary" >Cancel</button></a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change Passord') }}
                                    </button>
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
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </div>
@endsection






