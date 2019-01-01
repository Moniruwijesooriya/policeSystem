@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Crime Type') }}</div>

                    <div class="card-body">
                        <form method="post" action="updateCrimeType" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{  $crime->crimeType }}" readonly>
                                </div>
                            </div>

                            {{--<div class="form-group row">--}}
                                {{--<label for="crimeType" class="col-md-4 col-form-label text-md-left">{{ __('Crime Type') }}</label>--}}

                                {{--<div class="col-md-7">--}}
                                    {{--<input id="crimeType" type="text" class="form-control" name="crimeType" value="{{ old('crimeType') }}" required autofocus>--}}

                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input type="text" class="form-control" value="{{ $crime->name }}" readonly>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input type="text" class="form-control" name="nic" value="{{ $crime->nic }}" readonly>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                                {{--<label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<input type="text" class="form-control" value="{{ $crime->dob }}" readonly>--}}

                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                                {{--<label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<input type="text" class="form-control" value="{{ $crime->gender }}" readonly>--}}

                                {{--</div>--}}
                            {{--</div>--}}


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Remove') }}
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
