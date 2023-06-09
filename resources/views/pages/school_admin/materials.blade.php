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
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List of school materials</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Material type</th>
                            <th>Exam term</th>
                            <th>Year</th>
                            <th>Posted by</th>
                            <th>Posted date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($materials) == 0)
                        <tr>
                            <td colspan="9" class="bg-secondary">No document material posted!</td>
                        </tr>
                        @else
                        @foreach ($materials as $material)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$material['title']}}</td>
                            <td>{{$material['subjects']['subject_name']}}</td>
                            <td>{{$material['exam_materials']['material_type']}}</td>
                            <td>{{$material['exam_categories']['exam_type']}}</td>
                            <td>{{$material['year']}}</td>
                            <td>Mwl. {{$material['firstname']}}&nbsp;{{$material['middlename']}}&nbsp;{{$material['lastname']}}</td>
                            <td>{{\Carbon\Carbon::parse($material['created_at'])->format('M d, Y h:i A')}}
                            </td>
                            <td>
                                hello world!
                            </td>
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
