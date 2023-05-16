@extends('layouts.main_layout')
@section('content')

<!-- a modal to save material -->
@if (session()->has('error'))
<div class="alert alert-danger border-0">{{session('error')}}</div>
@endif
@if (session()->has('success'))
<div class="alert alert-success border-0">{{session('success')}}</div>
@endif

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card bg-light">
        <div class="card-body">
            @if(count($materials) == 0)
            <div class="alert alert-warning lead border-0" style="font-size:xx-large">
                At the moment, {{$schoolName}} has not posted any material. Please check again later. &#x1F60A;
            </div>
            @else
            <!-- <div class="mb-3">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="search material..." aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                @foreach($materials as $material)
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card shadow">
                        <center class="card-text mt-2 text-muted"> {{$material['subject_name']}}
                        </center>
                        <img class="card-img-top" src="{{ asset($material['thumbnail']) }}" alt="{{$material['thumbnail']}}" height="200">
                        <div class="card-body">
                            <h4 class="card-title">{{$material['title']}}</h4>
                            <div class="card-description text-capitalize">
                                {{$material['material_type']}}
                            </div>
                            <p class="card-text text-muted"><b>Posted:&nbsp;</b>{{ \Carbon\Carbon::parse($material['posted_at'])->diffForHumans() }}</p>
                            @if($material['marking_scheme'] != 'null')
                            <a href="{{route('scheme-detail', ['materialid' => $material['id']])}}" class="text-primary fs-sm">
                                <i class="fa fa-eye text-primary"></i>&nbsp;marking scheme
                            </a>
                            <br>
                            @endif
                            <a href="{{route('material-detail', ['materialid' => $material['id']])}}" class="text-success">
                                <i class="fa fa-eye text-success"></i>&nbsp;view document
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
