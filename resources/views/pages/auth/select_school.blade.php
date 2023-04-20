@extends('layouts.auth_layout')
@section('content')

<h3>School & class of study</h3>
<form action="" method="POST" class="pt-3 row">

    @if ($schools->count() == 0)
    <div class="alert alert-danger border-0 col-12">Please wait, schools are not yet added to the system!</div>
    @else
    <div class="col-md-12">
        <div class="form-group">
            <label>School</label>
            <select class="js-example-basic-single w-100">
                <option value="">select school...</option>
                @foreach ($schools as $school)
                <option value="{{$school->id}}">{{$school->school_name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Class</label>
            <select class="js-example-basic-single w-100">
                <option value="">select class...</option>
                @foreach ($classes as $class)
                <option value="{{$class->id}}">{{$class->class_name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="container d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Proceed</button>
    </div>
    @endif
    <!-- <div class="text-center mt-4 font-weight-light">
        Already have an account? <a href="./login.php" class="text-primary">Login</a>
    </div> -->
</form>

@endsection('content')
