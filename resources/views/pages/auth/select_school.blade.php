@extends('layouts.auth_layout')
@sec tion('content')

@if (session()->has('error'))
<div  class="alert alert-danger border-0">{{session('error')}}</div>
@endif
@if (session()->has('success'))
<div  class="alert alert-success border-0">{{session('success')}}</div>
@endif

<h3> School & class of study</h3>
<form action="{{route('student-school')}}" method="POST" class="pt-3 row">
        @csrf
             @if ($schools->count() == 0)
            <div class="alert alert-danger border-0 col-12">Please wait, schools are not yet added to the system!</div>
       @else
        <div class="col-md-12">
           <div class="form-group">
            <label>School</label>
             <select class="js-example-basic-single w-100" name="school">
                <option value="">select school...</option>
                @foreach ($schools as $school)
                 <option value="{{$school->id}}" {{old('school') ? 'selected' : ''}}>{{$school->school_name}}</option>
                @endforeach
            </select>
             @error('school')
            <div class="text-danger">{{$message}}</div>
            @enderror
         </div>
    </div>

        <div class="col-md-12">
           <div class="form-group">
            <label>Class</label>
            <select class="
js-example-basic-single w-100" name="class">
                <option value="">select class...</option>
                @foreach ($classes as $class)

 <option value="{{$class->id}}" {{old('class') ? 'selected' : ''}}>{{$class->class_name}}</option>
                @endforeach
            </select>
             @error('class')


            <div class="text-danger">{{$message}}</div>
            @enderror
         </div>


    </div>

         <div class="container
        d
    -flex justify-content-end">
            <button type="submit" class="btn btn-primary">Proceed</button>
      </div>
      @en dif


      <!-- <div class="text-center mt-4 font-weight-light">
        Already have an account? <a href="./login.php" class="text-primary">Login</a>
    </div> -->
 </form>
 @endsec tion('content')


