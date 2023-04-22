@extends('layouts.auth_layout')
@section('content')

<h4>New here?</h4>
<h6 class="font-weight-light">Signing up is easy. It only takes a few seconds</h6>
<form class="pt-3" action="{{route('registeruser')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="firstname">Firstname&nbsp;<sup class="text-danger" style="font-size:15px">*</sup></label>
                <input type="text" name="firstname" class="form-control form-control-lg" id="firstname" placeholder="enter firstname" value="{{old('firstname')}}">
                @error('firstname')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="middlename">Middlename</label>
                <input type="text" name="middlename" class="form-control form-control-lg" id="middlename" placeholder="enter middlename" value="{{old('middlename')}}">
                @error('middlename')
                <div class=" text-danger">{{$message}}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-md-6">
            <div class="form-group">
                <label for="lastname">Lastname&nbsp;<sup class="text-danger" style="font-size:15px">*</sup></label>
                <input type="text" name="lastname" class="form-control form-control-lg" id="lastname" placeholder="enter lastname" value="{{old('lastname')}}">
                @error('lastname')
                <div class=" text-danger">{{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Gender:&nbsp;<sup class="text-danger" style="font-size:15px">*</sup></label>
                <div class="input-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="male" value="M" />
                            Male
                        </label>
                    </div>
                    <div class="form-check ml-5">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="female" value="F" />
                            Female
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email" value="{{old('email')}}">
                @error('email')
                <div class=" text-danger">{{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="phone">Phone Number&nbsp;<sup class="text-danger" style="font-size:15px">*</sup></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+255</span>
                    </div>
                    <input type="tel" name="phone" class="form-control form-control-lg" id="phone" placeholder="7XXXXXXXX" value="{{old('phone')}}">
                    @error('phone')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="password">Password&nbsp;<sup class="text-danger" style="font-size:15px">*</sup></label>
                <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="enter password">
                @error('password')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="confirmpassword">Confirm password&nbsp;<sup class="text-danger" style="font-size:15px">*</sup></label>
                <input type="password" name="password_confirmation" class="form-control form-control-lg" id="confirmpassword" placeholder="Repeat password">
                @error('password')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="mb-4">
        <div class="form-check">
            <label class="form-check-label text-muted">
                <input type="checkbox" class="form-check-input" />I agree to all Terms & Conditions </label>
        </div>
    </div>
    <div class="mt-3">
        <button name="register" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
    </div>
    <div class="text-center mt-4 font-weight-light">
        Already have an account?
        <a href="{{route('login')}}" class="text-primary">Login</a>
    </div>
</form>
@endsection('content')
