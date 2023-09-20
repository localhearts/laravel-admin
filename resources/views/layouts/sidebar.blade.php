<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ URL('/') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                </li>
                <li class="menu-title" key="t-apps">@lang('translation.Apps')</li>
            @if(Auth::user()->roles == '1')
                <li>
                    <a href="{{ URL('employee') }}" class="waves-effect">
                        <i class="bx bx-body"></i>
                        <span key="t-employee">@lang('translation.Employee')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL('attendance') }}" class="waves-effect">
                        <i class="bx bx-check-shield"></i>
                        <span key="t-attendance">@lang('translation.Attendance')</span>
                    </a>
                </li>
            @endif
                <!-- <li>
<a href="{{ URL('reimbursement') }}" class="waves-effect">
<i class="bx bx-money"></i>
<span key="t-reimbursement">@lang('translation.Reimbursement')</span>
</a>
</li> -->
                <li>
                    <a href="{{ URL('tasks') }}" class="waves-effect">
                        <i class="bx bx-task"></i>
                        <span key="t-task">@lang('translation.Tasks')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL('daily') }}" class="waves-effect">
                        <i class="bx bx-check-double"></i>
                        <span key="t-daily">@lang('translation.Daily_Report')</span>
                    </a>
                </li>
            @if(Auth::user()->roles == '1')
                <li>
                    <a href="{{ URL('user-management') }}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-management">@lang('translation.User_Management')</span>
                    </a>
                </li>
            @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->