@extends('layouts.main_layout')
@section('content')

<!-- a modal to save school -->
@if (session()->has('error'))
<div class="alert alert-danger border-0">{{session('error')}}</div>
@endif
@if (session()->has('success'))
<div class="alert alert-success border-0">{{session('success')}}</div>
@endif

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card bg-light">
        <div class="card-body">
            <div class="mb-3">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="search school..." aria-label="school name" id="search-input">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($schools as $school)
                <a href="{{route('school-materials', ['schoolid' => $school->id])}}" class="col-md-4 grid-margin stretch-card school-card">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">{{$school->index_no}}</h4>
                            <div class="card-description text-capitalize">
                                {{$school->school_name}}
                            </div>
                            <p class="card-text">{{ $school->totalDocs }} materials</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
