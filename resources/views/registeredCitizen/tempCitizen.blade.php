@extends('registeredCitizen.registeredCitizenApp')
<?php
use Illuminate\Support\Facades\DB;
?>
@section('content')
    <div class="col-md-12">
        <p></p>
        <?php
        $posts=db::table('public_posts')->get();
        ?>
        @foreach($posts as $post)
            <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                <img src="{{asset('/userProfileImages/'.$post->postedBy.'.jpg')}}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                <?php
                $postedPoliceOfficer=db::table('users')->where('nic',$post->postedBy)->first();
                ?>
                <span class="w3-right w3-opacity">Posted By {{$postedPoliceOfficer->name}} :: {{$postedPoliceOfficer->role}}  {{$postedPoliceOfficer->policeOffice}}</span>
                <br>
                <span class="w3-right w3-opacity"> {{$post->created_at}}</span>
                <h4>{{$post->title}}</h4><br>
                <hr class="w3-clear">
                <p>{{$post->content}}.</p>
                <div class="w3-row-padding" style="margin:0 -16px">
                    <div class="w3-half">
                        {{--<img src='' style="width:100%" alt="Northern Lights" class="w3-margin-bottom">--}}
                    </div>
                    <div class="w3-half">
                        {{--<img src="/w3images/nature.jpg" style="width:100%" alt="Nature" class="w3-margin-bottom">--}}
                    </div>
                </div>
                <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-hand-o-right"></i>  Follow Case</button>
                <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-file-o"></i>  Submit Evidence</button>
            </div>
            {{--<div class="w3-container w3-card w3-white w3-round w3-margin" style="width: 100%"><br>--}}
            {{--<span class="w3-right w3-opacity">{{$post->created_at}}</span>--}}
            {{--<h4>{{$post->title}}</h4><br>--}}
            {{--<h6>{{$post->content}}</h6><br>--}}
            {{--<p></p>--}}
            {{--<button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-hand-o-right"></i>  </button>--}}
            {{--<button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-file-o"></i>  </button>--}}
            {{--</div>--}}
        @endforeach

    </div>
    <!-- End Middle Column -->

    <!-- Right Column -->

@endsection

