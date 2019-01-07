@extends('admin.adminApp')
@section('content')

    <div class="content-header">
        <h1>
            Register Branch Office
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
                        <form method="POST" action="{{ route('registerPoliceOffice') }}">
                            @csrf
                            <input type="hidden" name="policeOfficeType" value="Branch Police Office">


                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-md-4 col-form-label text-md-left">Police Station</label>
                                <div class="col-md-7">
                                    <select class="form-control" name ="headPoliceOffice" id="policeOfficeType">
                                        @foreach($policeStationOffices as $policeStationOffice)
                                            <option>{{$policeStationOffice->OfficeName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-md-4 col-form-label text-md-left">District</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="district" id="exampleFormControlSelect1">
                                        <option>Ampara</option>
                                        <option>Anuradhapura</option>
                                        <option>Badulla</option>
                                        <option>Batticaloa</option>
                                        <option>Colombo</option>
                                        <option>Galle</option>
                                        <option>Gampaha</option>
                                        <option>Hambanthota</option>
                                        <option>Jaffna</option>
                                        <option>Kaluthara</option>
                                        <option>Kandy</option>
                                        <option>Kegalle</option>
                                        <option>Kilinochchi</option>
                                        <option>Kurunegala</option>
                                        <option>Mannar</option>
                                        <option>Matale</option>
                                        <option>Matara</option>
                                        <option>Monaragala</option>
                                        <option>Mullaitivu</option>
                                        <option>Nuwara Eliya</option>
                                        <option>Polonnaruwa</option>
                                        <option>Puttalam</option>
                                        <option>Rathnapura</option>
                                        <option>Trincomalee</option>
                                        <option>Vavuniya</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-left">{{ __('Branch Type') }}</label>
                                <div class="col-md-7">
                                    <select class="form-control" name ="policeOfficeArea" id="exampleFormControlSelect1">
                                        <option>Crime</option>
                                        <option>Vice Unit</option>
                                        <option>Miscellaneous Complaints</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="landNumber" class="col-md-4 col-form-label text-md-left">{{ __('Landline Number') }}</label>

                                <div class="col-md-7">
                                    <input id="landNumber" type="text" class="form-control{{ $errors->has('landNumber') ? ' is-invalid' : '' }}" name="landNumber" value="{{ old('landNumber') }}" required autofocus>

                                    @if ($errors->has('landNumber'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('landNumber') }}</strong>
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
@endsection
