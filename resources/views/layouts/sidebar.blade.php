<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item">
            <li class="{{ request()->is('dasbor') ? 'active pcoded-trigger' : '' }}">
                <a href="{{URL::to('/dasbor')}}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="pcoded-hasmenu {{ request()->is('employees') || request()->is('categories')  || request()->is('departements') || request()->is('jobs') || request()->is('joblevels') ? 'active pcoded-trigger' : '' }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                    <span class="pcoded-mtext">Master</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ request()->is('employees') ? 'active' : '' }}">
                        <a href="{{URL::to('/employees')}}">
                            <span class="pcoded-mtext">Employee</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('categories') ? 'active' : '' }}">
                        <a href="{{URL::to('/categories')}}">
                            <span class="pcoded-mtext">Category</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('departements') ? 'active' : '' }}">
                        <a href="{{URL::to('/departements')}}">
                            <span class="pcoded-mtext">Department</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('job') ? 'active' : '' }}">
                        <a href="{{URL::to('/jobs')}}">
                            <span class="pcoded-mtext">Job</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('joblevel') ? 'active' : '' }}">
                        <a href="{{URL::to('/joblevels')}}">
                            <span class="pcoded-mtext">Job Level</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu {{ request()->is('attendances') || request()->is('workplans') || request()->is('payrolls')  ? 'active pcoded-trigger' : '' }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                    <span class="pcoded-mtext">Feature</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ request()->is('attendances') ? 'active' : '' }}">
                        <a href="{{URL::to('/attendances')}}">
                            <span class="pcoded-mtext">Attendance</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('workplans') ? 'active' : '' }}">
                        <a href="{{URL::to('/workplans')}}">
                            <span class="pcoded-mtext">Work Plan</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('payrolls') ? 'active' : '' }}">
                        <a href="{{URL::to('/payrolls')}}">
                            <span class="pcoded-mtext">Payroll</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->is('user') ? 'active pcoded-trigger' : '' }} ">
                <a href="{{URL::to('/user')}}">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">User</span>
                </a>
            </li>
            <li class="pcoded-hasmenu {{ request()->is('report') ? 'active pcoded-trigger' : '' }}">
                <a href="{{URL::to('/report')}}">
                    <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                    <span class="pcoded-mtext">Report</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
