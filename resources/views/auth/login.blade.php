@extends('layouts.auth')

@push('css')
{{-- Html::style('css/css.js') --}}
@endpush

@push('js')
{{Html::script('js/pages/login.js')}}
@endpush

@section('title', 'Login '.config('app.name'))

@section('content-header')
    <h1>
        {{config("app.name")}}
    </h1>
@endsection

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Login {{config('app.name')}}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">

                {{csrf_field()}}
                <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" placeholder="Username" name="username" {{old('username')}}>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-primary btn-block btn-flat" id="sign">Sign In</button>
                    </div>
                </div>

        </div>
    </div>
@endsection