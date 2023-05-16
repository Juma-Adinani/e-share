<div class="modal fade" id="quizModal" tabindex="-1" role="dialog" aria-labelledby="quizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1>&#128578;</h1> -->
                <h5 class="modal-title" id="quizModalLabel">Upload Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('save-material') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if (count($subjects) == 0) <h1 class="alert alert-warning border-0">
                        <i class="fa fa-exclamation-circle">&nbsp;</i>
                        You have got no subjects, you cannot upload exam material!, contact your school administrator to assign you a subject.
                    </h1>
                    @else
                    <input type="text" name="material_id" id="" value="3" class="form-control" hidden>
                    <input type="text" name="exam_id" id="" value="1" class="form-control" hidden>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">title</label>
                                    <input type="text" name="title" class="form-control form-control-lg" id="title" placeholder="enter title (e.g Biology examination)" value="{{old('title')}}">
                                    @error('title')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="thumbnail">Cover image</label>
                                    <input type="file" name="thumbnail" class="form-control form-control-lg" id="thumbnail" placeholder="enter document" value="{{old('thumbnail')}}">
                                    @error('thumbnail')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="document">Material document</label>
                                    <input type="file" name="document" class="form-control form-control-lg" id="document" placeholder="enter document" value="{{old('document')}}">
                                    @error('document')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="scheme">Marking scheme</label>
                                    <input type="file" name="scheme" class="form-control form-control-lg" id="scheme" placeholder="enter scheme" value="{{old('scheme')}}">
                                    @error('scheme')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group d-flex flex-column">
                                    <label for="subject">subject</label>
                                    <select class="js-example-basic-single form-control" id="subject" name="subject">
                                        <option value="">select subject...</option>
                                        @foreach ($subjects as $subject )
                                        <option value="{{$subject->first()->subject_id}}" {{old('subject')? 'selected' :''}}>{{$subject->first()->subject_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('subject')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group d-flex flex-column">
                                    <label for="class">Class</label>
                                    <select class="js-example-basic-single form-control" id="class" name="class">
                                        <option value="">select class...</option>
                                        @foreach ($classes as $class )
                                        <option value="{{$class->first()->class_id}}" {{old('class') ? 'selected':''}}>{{$class->first()->class_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('class')
                                    <div class=" text-danger">{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input type="number" name="year" class="form-control form-control-sm" id="year" placeholder="year" value="{{old('year')}}" min="1985" max="{{ date('Y') }}">
                                    @error('year')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @include('pages.teacher.modals.submit')
            </form>
        </div>
    </div>
</div>
<!-- end a modal to save a school -->
