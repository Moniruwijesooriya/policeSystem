@extends('registeredCitizen.registeredCitizenNav')
@section('content1')
    <?php
    use Illuminate\Support\Facades\DB;
    $nic=Auth::User()->nic;
    $citizenDetails = db::table('users')->where('nic',$nic)->First();
    $entries=db::table('entries')->where('complainantID',Auth::User()->nic)->get();
    ?>
    <!-- Page Container -->
    <div class="w3-container" style="max-width:100%;background-color: #29292d">
        <!-- The Grid -->
        <div class="row" style="margin-top: 5px">
            <!-- Left Column -->
            <div class="col-md-3">
                <!-- Profile -->
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container">
                        <h4 class="w3-center">My Profile</h4>
                        <p class="w3-center"><img src="{{asset('/userProfileImages/'.$citizenDetails->nic.'.jpg')}}" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                        <hr>
                        <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>{{$citizenDetails->name}}</p>
                        <p><i class="fa fa-id-badge fa-fw w3-margin-right w3-text-theme"></i>{{$citizenDetails->nic}}</p>
                        <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme" aria-hidden="true"></i>{{$citizenDetails->email}}</p>
                    </div>
                </div>
                <br>

                <!-- Accordion -->
                <div class="w3-card w3-round">
                    <div class="w3-white">
                        <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Submitted Entries</button>
                        <br>
                        <div id="Demo1" class="w3-hide w3-container">
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                            @foreach($entries as $entry)

                                <form method="post" action="{{'viewCitizenEntry'}}">
                                    @csrf
                                    <input type="hidden" value="{{$entry->entryID}}" name="entryID">
                                    <p><input type="submit" class="btn btn-primary" style="width: 100%" value="Entry ID :{{$entry->entryID}}"></p>
                                </form>
                            @endforeach
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Following Cases</button>--}}
                        {{--<div id="Demo2" class="w3-hide w3-container">--}}

                        </div>
                        <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Evidence Submitted</button>
                    </div>
                </div>
                <br>

                <!-- Interests -->
                {{--<div class="w3-card w3-round w3-white w3-hide-small">--}}
                    {{--<div class="w3-container">--}}
                        {{--<p>Interests</p>--}}
                        {{--<p>--}}
                            {{--<span class="w3-tag w3-small w3-theme-d5">News</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme-d4">W3Schools</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme-d3">Labels</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme-d2">Games</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme-d1">Friends</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme">Games</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme-l1">Friends</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme-l2">Food</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme-l3">Design</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme-l4">Art</span>--}}
                            {{--<span class="w3-tag w3-small w3-theme-l5">Photos</span>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <br>

            {{--<!-- Alert Box -->--}}
            {{--<div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">--}}
            {{--<span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">--}}
            {{--<i class="fa fa-remove"></i>--}}
            {{--</span>--}}
            {{--<p><strong>Hey!</strong></p>--}}
            {{--<p>People are looking at your profile. Find out who.</p>--}}
            {{--</div>--}}

            <!-- End Left Column -->
            </div>

            <!-- Middle Column -->
            <div class="col-md-5" style="margin-left: 20px;margin-right: 20px">
                @yield('content')
            </div>
            <div class="col-md-3">
                {{--Alert Messages--}}
                @if(session('updateCitizen'))
                    <div class="alert alert-success m1200" role="alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{session('updateCitizen')}}
                    </div>
                @endif

                @if(session('CitizenPasswordUpdate'))
                    <div class="alert alert-success m1200" role="alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{session('CitizenPasswordUpdate')}}
                    </div>
                @endif


                @if(session('entrySuccess'))
                    <div class="alert alert-success m1200" role="alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{session('entrySuccess')}}
                    </div>
                @endif


                <script !src="">
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove();
                        });
                    }, 4000);
                </script>


                <div class="w3-card w3-round w3-white w3-center">
                    <div class="w3-container" style="padding: 5px">
                        {{--<p>Upcoming Events:</p>--}}
                        {{--<img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">--}}
                        {{--<p><strong>Holiday</strong></p>--}}
                        {{--<p>Friday 15:00</p>--}}
                        {{--<p><button class="w3-button w3-block w3-theme-l4">Info</button></p>--}}
                        <a href="submitCrimeEntryForm"><button type="button" style="width: 100%;padding: 10px" class="btn btn-primary">Submit Entry</button>
                        </a>
                    </div>
                </div>
                <br>

                <div class="w3-card w3-round w3-white w3-center">
                    <div class="w3-container">
                        <div class="moduletable">
                            <h3 style="background-color:whitesmoke;padding: 5px ">Related Links </h3>
                            <p><a href="http://www.president.gov.lk/" target="_blank">H.E. The President</a>
                                <br /><a href="http://www.pmoffice.gov.lk/" target="_blank">Hon. Prime Minister </a>
                                <br /><a href="http://www.pmdnews.lk/" target="_blank">PMD News<br /></a><a href="http://www.presidentsoffice.gov.lk/" target="_blank" style="line-height: 15.6px;">Presidential Secretariat </a><a href="http://www.presidentsoffice.gov.lk/" target="_blank"> </a><br /><strong><span style="color: #0000ff;"><a href="http://www.lawandorder.lk/" target="_blank">Ministry of Law and Order</a></span></strong><br /><a href="http://www.defence.lk" target="_blank" style="line-height: 1.3em;">Ministry of Defence<br /></a><a href="http://www.gov.lk" target="_blank" style="line-height: 15.6px;">Government Web Portal<br /></a><a href="http://www.npc.gov.lk/" target="_blank">National Police Commission<br /></a><a href="http://www.policereforms.lk/" target="_blank">Police Reforms Committee<br /></a><a href="http://www.ocds.lk/" target="_blank">Chief  of Defence Staff<br /></a><a href="http://www.army.lk" target="_blank">Sri Lanka Army<br /></a><a href="http://www.navy.lk" target="_blank">Sri Lanka Navy<br /></a><a href="http://www.airforce.lk" target="_blank">Sri Lanka Airforce</a></p>		</div>
                    </div>
                </div>
                <br>

                <div class="rounded-circle"style="margin-left: 30px">
                    <img src='{{asset('/img/preventCrime.png')}}' class="img-circle" alt="User Image">
                </div>
                <br>

                <!-- End Right Column -->
            </div>

        </div>

    </div>
@endsection

