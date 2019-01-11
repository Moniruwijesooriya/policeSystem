@extends('oic.oicApp')
@section('content')

    <div class="content-header">
        <h1>
            Request For Registration
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
                            <div class="row" style="border-radius: 8px;background-color: lightgray">
                                <!-- Left Column -->
                                <!-- Middle Column -->
                                <div class="col-md-8 card" style="margin-bottom: 10px;margin-left:180px;margin-right:180px;border-radius: 8px;background-color: whitesmoke;margin-top: 30px">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="page-header" style="text-align: center">{{ __('Citizen Registration Form') }}</div>

                                                <div class="card-body">
                                                    <form method="post" style="margin-left: 70px" action="{{ route('acceptCitizenRequest') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <p class="w3-center"><img src='{{asset('/userProfileImages/'.$citizenDetails->nic.'.jpg')}}' class="w3-circle" style="height:200px;width:200px" alt="{{ $citizenDetails->nic }}"></p>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->name }}" readonly>
                                                                <input type="hidden" name="nic" value="{{ $citizenDetails->nic }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->fullName }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->nic }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->dob }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->gender }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Residence Address') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->address }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->profession }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->mobileNumber }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->landLineNumber }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"value="{{ $citizenDetails->email }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Verify') }}</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name ="verify" id="exampleFormControlSelect1">
                                                                    <option>Yes</option>
                                                                    <option>No</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-6 col-xs-6"  >
                                                                <input type="submit" class="btn btn-primary">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Middle Column -->
                                    </div>
                                    <!-- End Middle Column -->
                                </div>
                                <!-- Right Column -->

                                <!-- End Grid -->
                            </div>
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
