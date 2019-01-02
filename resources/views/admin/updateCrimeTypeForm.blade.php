@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Crime Type') }}</div>

                </div>
                <div class="card-body">
                    <form method="POST" action="updateCrimeType">
                        @csrf

                        <div class="form-group row">
                            <label for="crimeType" class="col-md-4 col-form-label text-md-left">{{ __('Crime Type') }}</label>

                            <div class="col-md-7">
                                <input id="crimeType" type="text" class="form-control" name="crimeType" value="{{ $crimeTypeList->crimeType }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoryType" class="col-md-4 col-form-label text-md-left">{{ __('Category Type') }}</label>

                            <div class="col-md-7">
                                <input id="categoryType" type="text" class="form-control" name="categoryType" value="{{ $crimeTypeList->categoryType }}" required autofocus>

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
                                        <label><input type="radio" name="policeView"  checked>Yes</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label><input type="radio" name="policeView" >No</label>
                                    </div>
                                </div>
                                @endif
                            @if($crimeTypeList->policeView=="No")
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label><input type="radio" name="policeView"  >Yes</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label><input type="radio" name="policeView" checked>No</label>
                                    </div>
                                </div>
                            @endif


                        </div>

                        <div class="form-group row">
                            <label for="categoryType" class="col-md-4 col-form-label text-md-left">{{ __('Citizen View') }}</label>
                            @if($crimeTypeList->citizenView=="Yes")
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label><input type="radio" name="citizenView"  checked>Yes</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label><input type="radio" name="citizenView" >No</label>
                                    </div>
                                </div>
                            @endif
                            @if($crimeTypeList->citizenView=="No")
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label><input type="radio" name="citizenView"  >Yes</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label><input type="radio" name="citizenView" checked>No</label>
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
                </div>
            </div>
        </div>
    </div>
@endsection
