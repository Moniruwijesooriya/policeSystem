@extends('registeredCitizen.registeredCitizenNav')
@section('content1')
    <?php
    use Illuminate\Support\Facades\DB;
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
                    <p class="w3-center"><img src="/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                    <hr>
                    <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->profession}}</p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>{{Auth::User()->address}}</p>
                </div>
            </div>
            <br>

            <!-- Accordion -->
            <div class="w3-card w3-round">
                <div class="w3-white">
                    <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Submitted Entries</button>
                    <div id="Demo1" class="w3-hide w3-container">
                        {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                        <?php
                        $entries=db::table('entries')->where('complainantID',Auth::User()->nic)->get();
                        ?>
                        @foreach($entries as $entry)

                            <form method="post" action="{{'viewCitizenEntry'}}">
                                @csrf
                                <input type="hidden" value="{{$entry->entryID}}" name="entryID">
                                <p><input type="submit" class="btn btn-primary" value="Entry ID :{{$entry->entryID}}"></p>
                            </form>
                        @endforeach
                        {{--</div>--}}
                    </div>
                    <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Following Cases</button>
                    <div id="Demo2" class="w3-hide w3-container">

                    </div>
                    <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Evidence Submitted</button>
                </div>
            </div>
            <br>

            <!-- Interests -->
            <div class="w3-card w3-round w3-white w3-hide-small">
                <div class="w3-container">
                    <p>Interests</p>
                    <p>
                        <span class="w3-tag w3-small w3-theme-d5">News</span>
                        <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
                        <span class="w3-tag w3-small w3-theme-d3">Labels</span>
                        <span class="w3-tag w3-small w3-theme-d2">Games</span>
                        <span class="w3-tag w3-small w3-theme-d1">Friends</span>
                        <span class="w3-tag w3-small w3-theme">Games</span>
                        <span class="w3-tag w3-small w3-theme-l1">Friends</span>
                        <span class="w3-tag w3-small w3-theme-l2">Food</span>
                        <span class="w3-tag w3-small w3-theme-l3">Design</span>
                        <span class="w3-tag w3-small w3-theme-l4">Art</span>
                        <span class="w3-tag w3-small w3-theme-l5">Photos</span>
                    </p>
                </div>
            </div>
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
        <div class="col-md-5" style="margin-left: 40px;margin-right: 40px">
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
                <div class="w3-container">
                    {{--<p>Upcoming Events:</p>--}}
                    {{--<img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">--}}
                    {{--<p><strong>Holiday</strong></p>--}}
                    {{--<p>Friday 15:00</p>--}}
                    {{--<p><button class="w3-button w3-block w3-theme-l4">Info</button></p>--}}
                    <a href="submitCrimeEntryForm"><button type="button" class="btn btn-primary">Submit Entry</button>
                    </a>
                </div>
            </div>
            <br>

            <div class="w3-card w3-round w3-white w3-center">
                <div class="w3-container">
                    <p>Friend Request</p>
                    <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
                    <span>Jane Doe</span>
                    <div class="w3-row w3-opacity">
                        <div class="w3-half">
                            <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
                        </div>
                        <div class="w3-half">
                            <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
                <p>ADS</p>
            </div>
            <br>

            <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
                <p><i class="fa fa-bug w3-xxlarge"></i></p>
            </div>

            <!-- End Right Column -->
        </div>

    </div>

</div>
@endsection

