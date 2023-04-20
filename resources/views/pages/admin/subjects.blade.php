@extends('layouts.main_layout')
@section('content')

<!-- a modal to save subject -->
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
                <h5 class="modal-title" id="exampleModalLabel">Register subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('save-subject') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-12 mb-2">
                                <label for="subject">subject name</label>
                                <input type="text" name="subject" id="subject" class="form-control @error('name') is-invalid @enderror" placeholder="Enter subject name" value="{{old('name')}}">
                                @error('subject')
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
<!-- end a modal to save a subject -->

<div class="col-12 d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>&nbsp;Add subject
    </button>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List of subjects</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> subject name </th>
                            <th> Registered date </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($subjects->count() == 0)
                        <tr>
                            <td colspan="4">No registered subjects for now!</td>
                        </tr>
                        @else
                        @foreach ($subjects as $subject)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$subject->subject_name}}</td>
                            <td>{{$subject->created_at}}</td>
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
