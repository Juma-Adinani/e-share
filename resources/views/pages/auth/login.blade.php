@extends('layouts.auth_layout')
@section('content')

<h4>let's get started</h4>
<h6 class="font-weight-light">Sign in to continue.</h6>
@if($errors->has('error'))
<div class="alert alert-danger border-0">{{ $errors->first('error') }}</div>
@endif
<form class="pt-3" action="{{route('loginuser')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="enter email" value="{{old('email')}}" />
        @error('email')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="enter password" />
        @error('password')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
    </div>
    <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
        </div>
        <a href="#" class="auth-link text-black">Forgot password?</a>
    </div>
    <div class="text-center mt-4 font-weight-light">
        Don't have an account?
        <a href="{{route('register')}}" class="text-primary">Create</a>
    </div>
</form>

@endsection('content')
