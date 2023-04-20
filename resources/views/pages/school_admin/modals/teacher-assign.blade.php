<div class="modal fade" id="assignModal{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1>&#128578;</h1> -->
                <h5 class="modal-title" id="detailModalLabel">
                    <div class="card-title">Mwl. {{ $teacher->users->firstname }} {{ $teacher->users->middlename }} {{ $teacher->users->lastname }}</div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('assign-subject') }}" method="POST">
                @csrf
                @if ($subjects->count() == 0)
                <div class="container alert alert-warning">Subjects have not yet registered!, contact admin to register the subjects</div>
                @else
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group d-flex flex-column">
                                    <input type="text" name="teacher_id" hidden id="" class="form-control" value="{{$teacher->id}}">
                                    <label for="class">Class</label>
                                    <select class="js-example-basic-single form-control" id="class" name="class">
                                        <option value="">select class...</option>
                                        @foreach ($classes as $class)
                                        <option value="{{$class->id}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('class')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group d-flex flex-column">
                                    <label for="subject">Subject</label>
                                    <select class="js-example-basic-single form-control" id="subject" name="subject">
                                        <option value="">select subject...</option>
                                        @foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('subject')
                                    <div class=" text-danger">{{$message}}
                                    </div>
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
                @endif
            </form>
        </div>
    </div>
</div>
