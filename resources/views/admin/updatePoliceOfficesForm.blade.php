@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Police Offices') }}</div>

                    <div class="card-body">
                        <form method="post" action="updatePoliceOffices" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Office Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOffice->OfficeName }}" readonly>
                                    <input type="hidden" name="policeOfficeID" value="{{ $policeOffice->id }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOffice->district }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Police Office Area') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nic" value="{{ $policeOffice->policeOfficeArea }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Police Office Type') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOffice->policeOfficeType }}" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Land Number') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="landNumber" value="{{ $policeOffice->landNumber }}" >

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Main Officer') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOffice->mainOfficer }}" readonly>
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
@endsection
