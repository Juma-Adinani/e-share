@extends('layouts.main_layout')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List of users</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fullname</th>
                            <th>Phone number</th>
                            <th>Email address</th>
                            <th>Role</th>
                            <th>Registered date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count() == 0)
                        <tr>
                            <td colspan="4">No registered users for now!</td>
                        </tr>
                        @else
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->firstname}} {{$user->middlename ?? ''}} {{$user->lastname}}</td>
                            <td>{{$user->phone }}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roles->role_type}}</td>
                            <td>{{$user->created_at}}</td>
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
