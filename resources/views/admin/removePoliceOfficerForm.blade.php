@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Remove Police Officer') }}</div>

                    <div class="card-body">
                        <form method="post" action="removePoliceOfficer" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->fullName }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nic" value="{{ $policeOfficer->nic }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->dob }}" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->gender }}" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->mobileNumber }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->landLineNumber }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('System Role') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->role }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rank" class="col-md-4 col-form-label text-md-right">{{ __('Officer Rank') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->profession }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Police Office') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->policeOffice }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $policeOfficer->email }}" readonly>
                                </div>
                            </div>
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
