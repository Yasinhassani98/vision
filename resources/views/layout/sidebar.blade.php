
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    {{-- <a href="{{ route('login') }}"><img src="{{ asset('/images/logo/logo.png') }}" alt="Logo" srcset=""></a> --}}
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                @if(Auth::user()->hasRole('admin'))

                <li class="sidebar-item">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-map-fill"></i>
                        <span>Maps</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class='sidebar-link '>
                        <i class="bi bi-person-circle"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.payments.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.payments.index') }}" class='sidebar-link'>
                        <i class="bi bi-cash-stack"></i>
                        <span>Payments</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.levels.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.levels.index') }}" class='sidebar-link'>
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Levels</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.students.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.students.index') }}" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Students</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.grades.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.grades.index') }}" class='sidebar-link'>
                        <i class="bi bi-journal-check"></i>
                        <span>Grades</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.schedules.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.schedules.index') }}" class='sidebar-link'>
                        <i class="bi bi-calendar-week-fill"></i>
                        <span>Schedules</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.comments.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.comments.index') }}" class='sidebar-link'>
                        <i class="bi bi-chat-dots-fill"></i>
                        <span>Comments</span>
                    </a>
                </li>
                @endif
                

                <li class="sidebar-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="#" class="sidebar-link d-flex align-items-center text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2 text-danger"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </li>

                

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>