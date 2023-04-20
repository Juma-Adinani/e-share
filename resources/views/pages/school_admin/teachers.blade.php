@extends('layouts.main_layout')
@section('content')

<!-- a modal to save class -->
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
                <h5 class="modal-title" id="exampleModalLabel">Register teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('save-teacher') }}" method="POST">
                @csrf
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end a modal to save a class -->

<div class="col-12 d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>&nbsp;Add teacher
    </button>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List of teachers</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Registered date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($teachers->count() == 0)
                        <tr>
                            <td colspan="6">No registered class teacher for now!</td>
                        </tr>
                        @else
                        @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$teacher->users->firstname}} {{$teacher->users->middlename}} {{$teacher->users->lastname}}</td>
                            <td>{{$teacher->users->email}}</td>
                            <td>+255{{$teacher->users->phone}}</td>
                            <td>{{$teacher->users->created_at}}</td>
                            <td class="d-flex flex-row">
                                <a href="" class="nav-link" type="button" data-toggle="modal" data-target="#assignModal{{$teacher->id}}">
                                    <i class="fa fa-edit"></i>Assign class
                                </a>

                                <a href="" class="nav-link text-success" type="button" data-toggle="modal" data-target="#detailModal{{$teacher->id}}">
                                    <i class="fa fa-eye"></i>details
                                </a>
                            </td>

                            <!-- view teacher some details -->
                            @include('pages.school_admin.modals.teacher-detail',['teachers'=>$teachers,'teacher' => $teacher, 'subjects' => $subjects, 'classes' => $classes, 'teacherSubjects'=>$teacherSubjects])
                            <!-- end view teacher some details -->

                            <!-- assign class with subjects -->
                            @include('pages.school_admin.modals.teacher-assign', ['teacher' => $teacher, 'subjects' => $subjects, 'classes' => $classes])
                            <!-- end assign class with subject -->
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
