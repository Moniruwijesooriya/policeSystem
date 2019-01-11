<?php
use Illuminate\Support\Facades\DB;
$newEntries=db::table('entries')->where('nearestPoliceStation',$oicDetails->policeOffice)->where('status','new')->count();
$ongoingEntries=db::table('entries')->where('nearestPoliceStation',$oicDetails->policeOffice)->where('status','ongoing')->count();
$closedEntries=db::table('entries')->where('nearestPoliceStation',$oicDetails->policeOffice)->where('status','closed')->count();
$registeredUsersCount=db::table('users')->where('role','citizen')->where('verified','Yes')->where('policeOffice',$oicDetails->policeOffice)->count();
$allUsersCount=db::table('users')->count();
$officersCount=$allUsersCount - $registeredUsersCount;
?>
@extends('oic.oicApp')
@section('content')
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                OIC Dashboard
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{$newEntries}}</h3>
                            <p>New Entries</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="viewOICNewEntries" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$ongoingEntries}}</h3>
                            <p>Ongoing Entries</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-home"></i>
                        </div>
                        <a href="viewOICOngoingEntries" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{$closedEntries}}</h3>

                            <p>Closed Entries</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="viewOICClosedEntries" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{$registeredUsersCount}}</h3>
                            <p>Registered Citizens</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="viewRegisteredCitizens" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Posts Column -->
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
                            </div>
                            <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-hand-o-right"></i>  Follow Case</button>
                            <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-file-o post-content"></i>  Submit Evidence</button>
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
    </div>
@endsection
