@extends('layouts.app')
<?php
use Illuminate\Support\Facades\DB;
?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('registerCitizen') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fullName" type="text" class="form-control{{ $errors->has('fullName') ? ' is-invalid' : '' }}" name="fullName" value="{{ old('fullName') }}" required autofocus>

                                    @if ($errors->has('fullName'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                <div class="col-md-6">
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

                                <div class="col-md-6">
                                    <input id="dob" type="date" class="form-control" name="dob"  required autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="col-md-2">
                                    <div class="radio">
                                        <label><input type="radio" name="gender" value="Male" checked>Male</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label><input type="radio" name="gender" value="Female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="homeAddress" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>

                                <div class="col-md-6">
                                    <input id="homeAddress" type="text" class="form-control{{ $errors->has('homeAddress') ? ' is-invalid' : '' }}" name="homeAddress" value="{{ old('homeAddress') }}" required autofocus>

                                    @if ($errors->has('homeAddress'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('homeAddress') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <?php
                            $policeOffice=db::table('police_offices')->get()->where('policeOfficeType',"Police Station");
                            ?>
                            <div class="form-group row">
                                <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Nearest Police Station') }}</label>
                                <div class="col-md-6">

                                    <select class="form-control" name="policeStation" id="exampleFormControlSelect1">
                                        @foreach($policeOffice as $office)
                                            <option>{{$office->OfficeName}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                                <div class="col-md-6">
                                    <input id="profession" type="text" class="form-control{{ $errors->has('profession') ? ' is-invalid' : '' }}" name="profession" value="{{ old('profession') }}" required autofocus>

                                    @if ($errors->has('profession'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
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

                                <div class="col-md-6">
                                    <input id="landNumber" type="text" maxlength="10" class="form-control{{ $errors->has('landNumber') ? ' is-invalid' : '' }}" name="landNumber" value="{{ old('landNumber') }}" required autofocus>

                                    @if ($errors->has('landNumber'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('landNumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            {{--<div class="form-group row">--}}
                            {{--<label for="profileImage" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input class="form-group mb-2" id="profileImage" type="file" name="profileImage" value="{{ old('profileImage') }}" required>--}}

                            {{--@if ($errors->has('profileImage'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('profileImage') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}



                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group row">--}}
                                {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                    {{--@if ($errors->has('password'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="Update" class="btn btn-primary">
                                        {{ __('Register') }}
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
