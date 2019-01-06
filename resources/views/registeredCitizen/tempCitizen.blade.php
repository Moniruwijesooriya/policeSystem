@extends('registeredCitizen.registeredCitizenApp')
<?php
use Illuminate\Support\Facades\DB;
?>
@section('content')
    <div class="w3-col m7">
        <p></p>
        <?php
        $posts=db::table('public_posts')->get();
        ?>
        @foreach($posts as $post)
            <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                <span class="w3-right w3-opacity">{{$post->created_at}}</span>
                <h4>{{$post->title}}</h4><br>
                <h6>{{$post->content}}</h6><br>
                <p></p>
                <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-hand-o-right"></i>  Follow Case</button>
                <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-file-o"></i>  Submit Evidence</button>
            </div>
    @endforeach

    <!-- End Middle Column -->
    </div>
    <!-- End Middle Column -->

    <!-- Right Column -->
    <div class="w3-col m2">
        <div class="w3-card w3-round w3-white w3-center">
            <div class="w3-container">
                {{--<p>Upcoming Events:</p>--}}
                {{--<img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">--}}
                {{--<p><strong>Holiday</strong></p>--}}
                {{--<p>Friday 15:00</p>--}}
                {{--<p><button class="w3-button w3-block w3-theme-l4">Info</button></p>--}}
                <a href="submitCrimeEntryForm"><button type="button" class="btn btn-primary">Submit Entry</button>
            </div></a>
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
@endsection

