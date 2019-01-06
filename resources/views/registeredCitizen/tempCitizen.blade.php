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

@endsection

