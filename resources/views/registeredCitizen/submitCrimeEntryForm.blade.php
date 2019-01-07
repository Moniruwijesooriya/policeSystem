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
                        <h4 class="w3-center">Submit Crime Entry</h4>
                        <div class="card-body">
                            <form method="post" action="{{route("submitEntry")}}">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">District</label>
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

                                <?php
                                $policeOffice=db::table('police_offices')->get()->where('policeOfficeType',"Police Station");
                                ?>
                                <div class="form-group">
                                    <label for="policeOffice">Nearest Police Station</label>
                                    <select class="form-control" name="policeStation" id="policeStation">
                                        @foreach($policeOffice as $office)
                                            <option>{{$office->policeOfficeArea}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Complaint Category</label>
                                    <select class="form-control" name="complaintCategory" id="exampleFormControlSelect1">
                                        @foreach($crimeCategories as $crimeCategory)
                                            <option>{{$crimeCategory->crimeType}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Complaint</label>
                                    <textarea class="form-control" name="complaintText" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Evidences</label>
                                    <textarea class="form-control" name="evidences"  rows="2"></textarea>
                                </div>


                                <div class="form-group">
                                    <label for="suspects">Suspects</label>
                                    <textarea class="form-control" name="suspects" rows="2"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-md-9 col-xs-4">
                                        <a href="RegisteredCitizen"><button type="button" class="btn btn-secondary" >Cancel</button></a>
                                    </div>
                                    <input type="submit" class="btn btn-primary" name="submit" value="Submit Entry">
                                </div>
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
