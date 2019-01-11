@extends('oic.oicApp')
@section('content')

    <div class="content-header">
        <h1>
            Branch
        </h1>
    </div>
    <!-- Main content -->
    <div class="content" >
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-lg-12 ">
                <!-- TO DO List -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{--View Branch List--}}
                        <div class="container-fluid">
                            <!-- The Grid -->
                            <div class="row" style="border-radius: 8px;background-color: lightgray">
                                <!-- Left Column -->
                                <div class="col-md-2 table-col tc-left" style="background-color: whitesmoke;margin-left:30px;margin-top: 30px">
                                    <!-- Accordion -->
                                    <div class="card">
                                        <div class="bg-grey">
                                            <button onclick="myFunction('newEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>New Entries</button>
                                            <br>
                                            <div id="newEntries" class="w3-hide w3-container">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        @foreach($newEntries as $entry)

                                                            <form method="post" action="{{'viewOICEntry'}}">
                                                                @csrf
                                                                <input type="hidden" value="{{$entry->entryID}}" name="entryID">
                                                                <p><input type="submit" class="btn btn-primary" style="width: 100%" value="Entry ID :{{$entry->entryID}}"></p>
                                                            </form>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <button onclick="myFunction('ongoingEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Ongoing Entries</button>
                                            <br>
                                            <div id="ongoingEntries" class="w3-hide w3-container">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        @foreach($ongoingEntries as $entry)

                                                            <form method="post" action="{{'viewOICEntry'}}">
                                                                @csrf
                                                                <input type="hidden" value="{{$entry->entryID}}" name="entryID">
                                                                <p><input type="submit" class="btn btn-primary" style="width: 100%" value="Entry ID :{{$entry->entryID}}"></p>
                                                            </form>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <button onclick="myFunction('closedEntries')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Closed Entries</button>

                                            <br>

                                            <div id="closedEntries" class="w3-hide w3-container">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        @foreach($closedEntries as $entry)

                                                            <form method="post" action="{{'viewOICEntry'}}">
                                                                @csrf
                                                                <input type="hidden" value="{{$entry->entryID}}" name="entryID">
                                                                <p><input type="submit" class="btn btn-primary" style="width: 100%" value="Entry ID :{{$entry->entryID}}"></p>
                                                            </form>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- End Left Column -->
                                </div>

                                <!-- Middle Column -->
                                <div class="col-md-8 card" style="margin-bottom: 10px;margin-left:30px;border-radius: 8px;background-color: whitesmoke;margin-top: 30px" >
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="page-header" style="text-align: center">{{ __('Branch') }}</div>

                                                <div class="form-group">
                                                    <form>
                                                        @csrf

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right" style="margin-left: 10px">{{ __('Branch Name') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" value="{{ $branchDetails->policeOfficeArea }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right" style="margin-left: 10px">{{ __('Branch Officer Incharge') }}</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" value="{{ $branchOfficerDetails->name }}"readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right" style="margin-left: 10px;margin-top: 5px">{{ __('Branch Officer NIC') }}</label>
                                                            <div class="col-md-6">
                                                                <button style="width: 100%" type="button" value="{{ $branchOfficerDetails->nic }}" id="nicbutton" class="btn btn-primary nic-button" data-toggle="modal" data-target="#viewPerson">{{ $branchOfficerDetails->nic }}</button>
                                                            </div>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Middle Column -->
                                </div>
                                <!-- End Grid -->
                            </div>
                            <!-- End Page Container -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </div>
@endsection






