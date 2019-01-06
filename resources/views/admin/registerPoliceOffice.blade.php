@extends('admin.app')
@section('content')
    {{--Register IGP office form--}}♦
    <div class="content-wrapper">
        <div class="modal fade" id="registerIGPOffice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div  class="modal-dialog modal-dialog-centered" role="document">
                <div  class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerIGPOffice">Register Inspector General of Police Office</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('registerPoliceOffice') }}">
                            @csrf
                            <input type="hidden" name="headPoliceOffice" value="Ministry">
                            <input type="hidden" name="policeOfficeType" value="Inspector General of Police Office">
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
                                <label for="policeOfficeArea" class="col-md-4 col-form-label text-md-left">{{ __('Office Area') }}</label>

                                <div class="col-md-7">
                                    <input id="policeOfficeArea" type="text" class="form-control" name="policeOfficeArea" value="Sri Lanka" readonly>

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

                </div>
            </div>
        </div>

    </div>

@endsection