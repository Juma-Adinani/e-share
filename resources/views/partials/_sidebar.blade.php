<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            @if(session('roleId') == 1)
            <a class="nav-link" href="{{route('home')}}">
                @endif
                @if(session('roleId') == 2)
                <a class="nav-link" href="{{route('sa-home')}}">
                    @endif
                    @if(session('roleId') == 3)
                    <a class="nav-link" href="{{route('t-home')}}">
                        @endif
                        @if(session('roleId') == 4)
                        <a class="nav-link" href="{{route('st-home')}}">
                            @endif
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
        </li>

        @if(session('roleId') == 1)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">System users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('users')}}">User list</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#school" aria-expanded="false" aria-controls="school">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Schools</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="school">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('schools')}}">School list</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#subject" aria-expanded="false" aria-controls="subject">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">subjects</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="subject">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('subjects')}}">Subject</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#school-admin" aria-expanded="false" aria-controls="school-admin">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">School admins</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="school-admin">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('school-admin')}}">Admins list</a></li>
                </ul>
            </div>
        </li>
        @endif

        @if(session('roleId') == 2)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#teachers" aria-expanded="false" aria-controls="teachers">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Teachers</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="teachers">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('teachers')}}">Teachers List</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#exam-materials" aria-expanded="false" aria-controls="exam-materials">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Exam materials</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="exam-materials">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('materials')}}">Materials list</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#students" aria-expanded="false" aria-controls="students">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Students</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="students">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('students')}}">Student list</a></li>
                </ul>
            </div>
        </li>
        @endif


        @if(session('roleId') == 3)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#teacher-material" aria-expanded="false" aria-controls="teacher-material">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Exam materials</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="teacher-material">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('teacher-materials')}}">
                            Materials list</a>
                    </li>
                </ul>
            </div>
        </li>
        @endif

        @if(session('roleId') == 4)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#schools" aria-expanded="false" aria-controls="schools">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Schools</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="schools">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('school-list')}}">School list</a></li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</nav>
