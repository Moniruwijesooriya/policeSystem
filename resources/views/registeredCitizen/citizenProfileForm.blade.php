{{--Citizen Update form--}}
{{--<div class="modal fade" id="citizenUpdateForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
    {{--<div  class="modal-dialog modal-dialog-centered" role="document">--}}
        {{--<div  class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<h5 class="modal-title" id="registerPoliceOfficer">Update Profile</h5>--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--<span aria-hidden="true">&times;</span>--}}
                {{--</button>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{----}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}





@extends('registeredCitizen.registeredCitizenApp')
<?php
use Illuminate\Support\Facades\DB;
?>
@section('content')
    <div class="w3-card w3-round w3-white">
        <div class="w3-container-center">
            <div class="row" style="background-color: whitesmoke">
                <div class="col-md-12">
                    <div class="card">
                        <h4 class="w3-center">Update Profile</h4>
                        <div class="card-body">
                            <form method="POST" action="citizenInfoUpdate" enctype="multipart/form-data">
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

                                <?php
                                $policeOffice=db::table('police_offices')->get()->where('policeOfficeType',"Police Station");
                                ?>
                                <div class="form-group row">
                                    <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Nearest Police Station') }}</label>
                                    <div class="col-md-6">

                                        <select class="form-control" name="policeStation" id="exampleFormControlSelect1">
                                            <option>{{$citizenDetails->policeOffice}}</option>
                                            @foreach($policeOffice as $office)
                                                <option>{{$office->OfficeName}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                                    <div class="col-md-6">
                                        <input id="profession" type="text" class="form-control" name="profession" value="{{$citizenDetails->profession}}" required autofocus>
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
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
