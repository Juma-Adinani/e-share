<div class="modal fade" id="detailModal{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1>&#128578;</h1> -->
                <h5 class="modal-title" id="detailModalLabel">
                    <div class="card-title">Mwl. {{ $teacher->users->firstname }} {{ $teacher->users->middlename }} {{ $teacher->users->lastname }}</div>
                    <p class="lead">List of subjects teaching:</p>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl>
                    @foreach($teacherSubjects as $class_name => $subjects)
                    <dt>{{ $class_name }}</dt>
                    @foreach($subjects as $subject)
                    <dd class="ml-5">{{ $subject->subject_name }}</dd>
                    @endforeach
                    @endforeach
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
