@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                       <img src="<?php echo auth()->user()->user_image_url ? asset('profiles')."/". auth()->user()->user_image_url : asset("profiles/default.png")?>" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <a href="#">
                                <img id="image" class="avatar border-gray" src="<?php echo auth()->user()->user_image_url ? asset('profiles')."/". auth()->user()->user_image_url : asset("profiles/default.png")?>" alt="...">
                                <form class="col-md-12 row" action="{{ route('profile.update_picture') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-9">
                                        <input type="file"  name="images" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                    </div>
                                    <div class="col-md-2">
                                    <button type="submit" class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                                class="fa fa-check"></i></button>
                                    </div>
                                </form>
                                <h5 class="title">{{ __(auth()->user()->user_first_name)}}</h5>
                            </a>
                            <p class="description">
                            @ {{ __(auth()->user()->user_last_name)}}
                            </p>
                        </div>
                        <p class="description text-center">
                        {{ __(auth()->user()->short_description)}}
                        </p>
                    </div>
                    <!-- <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                    <h5>{{ __('12') }}
                                        <br>
                                        <small>{{ __('Files') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5>{{ __('2GB') }}
                                        <br>
                                        <small>{{ __('Used') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-3 mr-auto">
                                    <h5>{{ __('24,6$') }}
                                        <br>
                                        <small>{{ __('Spent') }}</small>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Recent Followers') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled team-members">
                            @foreach($customers as $customer)
                            <li>
                                <div class="row">
                                    <div class="col-md-2 col-2">
                                        <div class="avatar">
                                            <img src="<?php echo $customer->user_image_url ? asset('profiles')."/". $customer->user_image_url : asset("paper/img/faces/ayo-ogunseinde-2.jpg")?>" alt="Circle Image"
                                                class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        {{ $customer->user_first_name. " ". $customer->user_last_name }}
                                        <br />
                                        <span class="text-muted">
                                            <small>{{ $customer->email}}</small>
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-3 text-right">
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                                class="fa fa-envelope"></i></button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-center">
                <form class="col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Edit Profile') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Last Name') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="user_last_name" class="form-control" placeholder="Last Name" value="{{ auth()->user()->user_last_name }}" required>
                                    </div>
                                    @if ($errors->has('user_last_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('user_last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('First Name') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="user_first_name" class="form-control" placeholder="First Name" value="{{ auth()->user()->user_first_name}}" required>
                                    </div>
                                    @if ($errors->has('user_first_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('user_first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Email') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="col-md-12" action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Change Password') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Old Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="old_password" class="form-control" placeholder="Old password" required>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('New Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Password Confirmation') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="col-md-12" action="{{ route('profile.update_category') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header row">
                            <div class="col-10">
                                <h5 class="title">{{ __('Change Category') }}</h5>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-sm btn-outline-success" id="add_cat">add</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-12 row" id="cat_list">
                                            <div class="tags col-12 row" id="cats">
                                                <div class="col-8 rem">
                                                    <input type="text" name="seller_categories[]" class="form-control" placeholder="e.g phone accessories, ladies wear..." required>
                                                </div>
                                                <div class="col-4 rem">
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove_cat">X</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('seller_categories'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('seller_categories') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection