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
                        <h4 class="w3-center">Deactivate Account</h4>
                        <div class="card-body">
                            <form method="POST" action="citizenAccountDeactivate" >
                                @csrf

                                <div class="form-group row">
                                    <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                    <div class="col-md-6">
                                        <input type="hidden" name="nic" value="{{$citizenDetails->nic}}">
                                        <input id="nic" type="text" pattern=".{10,12}" name="tmp" class="form-control"  value="{{$citizenDetails->nic}}" readonly>
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
                                        <a href="RegisteredCitizen"><button type="button" class="btn btn-secondary" >Cancel</button></a>
                                    </div>

                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Deactivate Account') }}
                                        </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
