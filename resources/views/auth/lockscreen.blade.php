@extends('layouts.auth')

@push('css')
{{-- Html::style('css/css.js') --}}
@endpush

@push('js')
{{Html::script('js/pages/lockscreen.js')}}
@endpush

<?php
$title = config("app.app")
?>

@section('title', 'Lockscreen | '.$title)

@section('content-header')
    <h1>
        {{config("app.name")}}
        <small>COntoh Page</small>
    </h1>
@endsection

@section('content')
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href=""><b>Admin</b>LTE</a>
        </div>
        <!-- User name -->
        <div class="lockscreen-name">John Doe</div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="{{asset('img/user1-128x128.jpg')}}" alt="User Image">
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->
            <form class="lockscreen-credentials">
                <div class="input-group">
                    <input type="password" class="form-control" placeholder="password">

                    <div class="input-group-btn">
                        <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                    </div>
                </div>
            </form>
            <!-- /.lockscreen credentials -->

        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            Enter your password to retrieve your session
        </div>
        <div class="text-center">
            <a href="/login-bank">Or sign in as a different user</a>
        </div>
        <div class="lockscreen-footer text-center">
            Copyright &copy; 2016 <b>{{config('app.name')}}</b><br>
            All rights reserved
        </div>
    </div>
@endsection