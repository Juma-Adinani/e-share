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
                <h5 class="modal-title" id="exampleModalLabel">Register school</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('save-school') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-12 mb-2">
                                <label for="index">Index number</label>
                                <input type="text" name="index" id="index" class="form-control @error('index') is-invalid @enderror" placeholder="Enter school index" value="{{old('index')}}">
                                @error('index')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-2">
                                <label for="school">School name</label>
                                <input type="text" name="name" id="school" class="form-control @error('name') is-invalid @enderror" placeholder="Enter school name" value="{{old('name')}}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
<!-- end a modal to save a school -->

<div class="col-12 d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>&nbsp;Add school
    </button>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List of schools</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Index no </th>
                            <th> School name </th>
                            <th> Registered date </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($schools->count() == 0)
                        <tr>
                            <td colspan="4">No registered schools for now!</td>
                        </tr>
                        @else
                        @foreach ($schools as $school)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$school->index_no}}</td>
                            <td>{{$school->school_name}}</td>
                            <td>{{$school->created_at}}</td>
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
