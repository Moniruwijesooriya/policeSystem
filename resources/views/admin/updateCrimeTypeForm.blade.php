
@extends('admin.adminApp')
@section('content')

    <div class="content-header">
        <h1>
            Update Crime Type
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
                        <form method="POST" action="updateCrimeType">
                            @csrf

                            <div class="form-group row">
                                <label for="crimeType" class="col-md-4 col-form-label text-md-left">{{ __('Crime Type') }}</label>

                                <div class="col-md-7">
                                    <input id="crimeType" type="text" class="form-control" name="crimeType" value="{{ $crimeTypeList->crimeType }}" required autofocus>
                                    <input type="hidden" name="crimeIdTemp" value="{{$crimeTypeList->id}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categoryType" class="col-md-4 col-form-label text-md-left">{{ __('Category Type') }}</label>

                                <div class="col-md-8">
                                    <div input id="categoryType"  name="categoryType"class="form-group row" >
                                        <div class="col-md-7">
                                            <select class="form-control" name="categoryType" id="categoryType">

                                                <option>{{$crimeTypeList->categoryType}}</option>
                                                @if($crimeTypeList->categoryType=="Miscellaneous complaints Branch")
                                                    <option>Criminal Investigation Branch</option>
                                                    <option>D-Type of Offence</option>
                                                    <option>Admin Branch</option>
                                                    <option>Women Bureau</option>
                                                @endif

                                                @if($crimeTypeList->categoryType=="Criminal Investigation Branch")
                                                    <option>D-Type of Offence</option>
                                                    <option>Miscellaneous complaints Branch</option>
                                                    <option>Admin Branch</option>
                                                    <option>Women Bureau</option>
                                                @endif

                                                @if($crimeTypeList->categoryType=="D-Type of Offence")
                                                    <option>Criminal Investigation Branch</option>
                                                    <option>Miscellaneous complaints Branch</option>
                                                    <option>Admin Branch</option>
                                                    <option>Women Bureau</option>
                                                @endif

                                                @if($crimeTypeList->categoryType=="Admin Branch")
                                                    <option>Criminal Investigation Branch</option>
                                                    <option>D-Type of Offence</option>
                                                    <option>Miscellaneous complaints Branch</option>
                                                    <option>Women Bureau</option>
                                                @endif

                                                @if($crimeTypeList->categoryType=="Women Bureau")
                                                    <option>Criminal Investigation Branch</option>
                                                    <option>D-Type of Offence</option>
                                                    <option>Miscellaneous complaints Branch</option>
                                                    <option>Admin Branch</option>
                                                @endif


                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-left">{{ __('Description') }}</label>

                                <div class="col-md-7">
                                    <textarea class="form-control" name="description"  rows="2">{{ $crimeTypeList->description }}</textarea>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categoryType" class="col-md-4 col-form-label text-md-left">{{ __('Police View') }}</label>
                                @if($crimeTypeList->policeView=="Yes")
                                    <div class="col-md-2">
                                        <div class="radio">
                                            <label><input type="radio" name="policeView"  value="Yes" checked>Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="radio">
                                            <label><input type="radio" name="policeView" value="No" >No</label>
                                        </div>
                                    </div>
                                @endif
                                @if($crimeTypeList->policeView=="No")
                                    <div class="col-md-2">
                                        <div class="radio">
                                            <label><input type="radio" name="policeView" value="Yes" >Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="radio">
                                            <label><input type="radio" name="policeView" value="No" checked>No</label>
                                        </div>
                                    </div>
                                @endif


                            </div>

                            <div class="form-group row">
                                <label for="categoryType" class="col-md-4 col-form-label text-md-left">{{ __('Citizen View') }}</label>
                                @if($crimeTypeList->citizenView=="Yes")
                                    <div class="col-md-2">
                                        <div class="radio">
                                            <label><input type="radio" name="citizenView"  value="Yes" checked>Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="radio">
                                            <label><input type="radio" name="citizenView" value="No" >No</label>
                                        </div>
                                    </div>
                                @endif
                                @if($crimeTypeList->citizenView=="No")
                                    <div class="col-md-2">
                                        <div class="radio">
                                            <label><input type="radio" name="citizenView"  value="Yes" >Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="radio">
                                            <label><input type="radio" name="citizenView" value="No" checked>No</label>
                                        </div>
                                    </div>
                                @endif

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





