@extends('layouts.main_layout')
@section('content')

<!-- a modal to save school -->
@if (session()->has('error'))
<div class="alert alert-danger border-0">{{session('error')}}</div>
@endif
@if (session()->has('success'))
<div class="alert alert-success border-0">{{session('success')}}</div>
@endif
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1>&#128578;</h1> -->
                <h5 class="modal-title" id="exampleModalLabel">Register school admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('save-admin') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if ($schools->count() == 0)
                    <h1 class="alert alert-warning border-0">
                        <i class="fa fa-exclamation-circle">&nbsp;</i>
                        You should register schools first!,
                        click <a href="{{route('schools')}}">here</a> to register school
                    </h1>
                    @else
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" class="form-control form-control-lg" id="firstname" placeholder="enter firstname" value="{{old('firstname')}}">
                                    @error('firstname')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middlename">Middlename</label>
                                    <input type="text" name="middlename" class="form-control form-control-lg" id="lastname" placeholder="enter lastname" value="{{old('middlename')}}">
                                    @error('middlename')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" class="form-control form-control-lg" id="lastname" placeholder="enter lastname" value="{{old('lastname')}}">
                                    @error('lastname')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email" value="{{old('email')}}">
                                    @error('email')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
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
                            <div class="col-sm-4">
                                <div class="form-group d-flex flex-column">
                                    <label for="school">School</label>
                                    <select class="js-example-basic-single" id="school" name="school">
                                        <option value="">select school...</option>
                                        @foreach ($schools as $school)
                                        <option value="{{ $school->id }}" {{ old('school') == $school->id ? 'selected' : '' }}>{{ $school->school_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('school')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender:</label>
                                    <div class="input-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="gender" id="male" value="M" {{ old('gender') == 'M' ? 'checked' : '' }} />
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check ml-5">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="gender" id="female" value="F" {{ old('gender') == 'F' ? 'checked' : '' }} />
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end a modal to save a school -->

<div class="col-12 d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>&nbsp;Add school admin
    </button>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List of school admins</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>School</th>
                            <th>Registered date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($admins->count() == 0)
                        <tr>
                            <td colspan="6">No registered school admin for now!</td>
                        </tr>
                        @else
                        @foreach ($admins as $admin)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$admin->users->firstname}} {{$admin->users->middlename}} {{$admin->users->lastname}}</td>
                            <td>{{$admin->users->email}}</td>
                            <td>{{$admin->users->phone}}</td>
                            <td>{{$admin->schools->school_name}}</td>
                            <td>{{$admin->users->created_at}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
