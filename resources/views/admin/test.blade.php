@extends('admin.navbar)
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                General Form Elements
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">General Elements</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Quick Example</h3>
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">{{ __('Register') }}</div>

                                        <div class="card-body">
                                            <form method="POST" action="{{ route('registerCitizen') }}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="fullName" type="text" class="form-control{{ $errors->has('fullName') ? ' is-invalid' : '' }}" name="fullName" value="{{ old('fullName') }}" required autofocus>

                                                        @if ($errors->has('fullName'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name with initials') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="nic" type="text" pattern=".{10,12}" class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" value="{{ old('nic') }}" required autofocus>

                                                        @if ($errors->has('nic'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nic') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="dob" type="date" class="form-control" name="dob"  required autofocus>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                                    <div class="col-md-2">
                                                        <div class="radio">
                                                            <label><input type="radio" name="gender" value="Male" checked>Male</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="radio">
                                                            <label><input type="radio" name="gender" value="Female">Female</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="civilStatus" class="col-md-4 col-form-label text-md-right">{{ __('Civil Status') }}</label>
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="civilStatus" id="exampleFormControlSelect1">
                                                            <option>Single</option>
                                                            <option>Married</option>
                                                            <option>Divorced</option>
                                                            <option>Widowed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="homeAddress" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="homeAddress" type="text" class="form-control{{ $errors->has('homeAddress') ? ' is-invalid' : '' }}" name="homeAddress" value="{{ old('homeAddress') }}" required autofocus>

                                                        @if ($errors->has('homeAddress'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('homeAddress') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <?php
                                                $policeOffice=db::table('police_offices')->get()->where('policeOfficeType',"Police Station");
                                                ?>
                                                <div class="form-group row">
                                                    <label for="policeOffice" class="col-md-4 col-form-label text-md-right">{{ __('Nearest Police Station') }}</label>
                                                    <div class="col-md-6">

                                                        <select class="form-control" name="policeStation" id="exampleFormControlSelect1" required autofocus>
                                                            <option>Temp</option>
                                                            @foreach($policeOffice as $office)
                                                                <option>{{$office->OfficeName}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="profession" type="text" class="form-control{{ $errors->has('profession') ? ' is-invalid' : '' }}" name="profession" value="{{ old('profession') }}" required autofocus>

                                                        @if ($errors->has('profession'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="mobNumber" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="mobNumber" type="text" maxlength="10" class="form-control{{ $errors->has('mobNumber') ? ' is-invalid' : '' }}" name="mobNumber" value="{{ old('mobNumber') }}" required autofocus>

                                                        @if ($errors->has('mobNumber'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobNumber') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="landNumber" class="col-md-4 col-form-label text-md-right">{{ __('Landline Number') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="landNumber" type="text" maxlength="10" class="form-control{{ $errors->has('landNumber') ? ' is-invalid' : '' }}" name="landNumber" value="{{ old('landNumber') }}" required autofocus>

                                                        @if ($errors->has('landNumber'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('landNumber') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>



                                                {{--<div class="form-group row">--}}
                                                {{--<label for="profileImage" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>--}}

                                                {{--<div class="col-md-6">--}}
                                                {{--<input class="form-group mb-2" id="profileImage" type="file" name="profileImage" value="{{ old('profileImage') }}" required>--}}

                                                {{--@if ($errors->has('profileImage'))--}}
                                                {{--<span class="invalid-feedback" role="alert">--}}
                                                {{--<strong>{{ $errors->first('profileImage') }}</strong>--}}
                                                {{--</span>--}}
                                                {{--@endif--}}
                                                {{--</div>--}}
                                                {{--</div>--}}



                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autofocus>

                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autofocus>
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

                    </div>
                    <!-- /.box -->

                    <!-- Form Element sizes -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Different Height</h3>
                        </div>
                        <div class="box-body">
                            <input class="form-control input-lg" type="text" placeholder=".input-lg">
                            <br>
                            <input class="form-control" type="text" placeholder="Default input">
                            <br>
                            <input class="form-control input-sm" type="text" placeholder=".input-sm">
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Different Width</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-3">
                                    <input type="text" class="form-control" placeholder=".col-xs-3">
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" placeholder=".col-xs-4">
                                </div>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" placeholder=".col-xs-5">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- Input addon -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Input Addon</h3>
                        </div>
                        <div class="box-body">
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <br>

                            <div class="input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon">.00</span>
                            </div>

                            <h4>With icons</h4>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <br>

                            <div class="input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>
                            </div>

                            <h4>With checkbox and radio inputs</h4>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox">
                        </span>
                                        <input type="text" class="form-control">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-group">
                        <span class="input-group-addon">
                          <input type="radio">
                        </span>
                                        <input type="text" class="form-control">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <!-- /.row -->

                            <h4>With buttons</h4>

                            <p class="margin">Large: <code>.input-group.input-group-lg</code></p>

                            <div class="input-group input-group-lg">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control">
                            </div>
                            <!-- /input-group -->
                            <p class="margin">Normal</p>

                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-danger">Action</button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control">
                            </div>
                            <!-- /input-group -->
                            <p class="margin">Small <code>.input-group.input-group-sm</code></p>

                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Go!</button>
                    </span>
                            </div>
                            <!-- /input-group -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Horizontal Form</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-info pull-right">Sign in</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box -->
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">General Elements</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form role="form">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Text</label>
                                    <input type="text" class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                    <label>Text Disabled</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                </div>

                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Textarea</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Textarea Disabled</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                                </div>

                                <!-- input states -->
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                                    <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">
                                    <span class="help-block">Help block with success</span>
                                </div>
                                <div class="form-group has-warning">
                                    <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with
                                        warning</label>
                                    <input type="text" class="form-control" id="inputWarning" placeholder="Enter ...">
                                    <span class="help-block">Help block with warning</span>
                                </div>
                                <div class="form-group has-error">
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with
                                        error</label>
                                    <input type="text" class="form-control" id="inputError" placeholder="Enter ...">
                                    <span class="help-block">Help block with error</span>
                                </div>

                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                            Checkbox 1
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                            Checkbox 2
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" disabled>
                                            Checkbox disabled
                                        </label>
                                    </div>
                                </div>

                                <!-- radio -->
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                            Option one is this and that&mdash;be sure to include why it's great
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                            Option two can be something else and selecting it will deselect option one
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                                            Option three is disabled
                                        </label>
                                    </div>
                                </div>

                                <!-- select -->
                                <div class="form-group">
                                    <label>Select</label>
                                    <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Disabled</label>
                                    <select class="form-control" disabled>
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>
                                </div>

                                <!-- Select multiple-->
                                <div class="form-group">
                                    <label>Select Multiple</label>
                                    <select multiple class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Multiple Disabled</label>
                                    <select multiple class="form-control" disabled>
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>
                                </div>

                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    @endsection
