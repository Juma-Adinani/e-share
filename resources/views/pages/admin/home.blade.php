@extends('layouts.main_layout')
@section('content')
@if (session('success'))
<div class="alert alert-success border-0">Welcome!, {{session('success')}}</div>
@endif
<div class="row">
    @foreach($dashboards as $dashboard)
    <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card {{$dashboard['class']}}">
            <a href="{{route($dashboard['route'])}}" class="text-white">
                <div class="card-body">
                    <p class="mb-4 h2">{{$dashboard['title']}}</p>
                    <p class="fs-30 mb-2">{{$dashboard['total']}}</p>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection
