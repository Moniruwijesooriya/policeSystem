@extends('boic.boicApp')
@section('content')

    <div class="content-header">
        <h1>
            Deactivate Account
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

                            <form method="POST" action="oicAccountDeactivate" >
                                @csrf

                                <div class="form-group row">
                                    <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>
                                    <div class="col-md-6">
                                        <input type="hidden" name="nic" value="{{$boicDetails->nic}}">
                                        <input id="nic" type="text" pattern=".{10,12}" name="tmp" class="form-control"  value="{{$boicDetails->nic}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <div class="col-md-6 ">
                                        <input id="password" type="password" class="form-control" name="password" required>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <div class="col-md-8 col-xs-4">
                                        <a href="\OIC"><button type="button" class="btn btn-secondary" >Cancel</button></a>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Deactivate Account') }}
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
        </div><!-- /.row (main row) -->

    </div>
@endsection






