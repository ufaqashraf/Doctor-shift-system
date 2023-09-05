@inject('request', 'Illuminate\Http\Request')


<?php $per = PermissionHelper::getUserPermissions();
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/www.locumset.com/locumset" target="_blank" class="brand-link">
      <img src="{{ asset('public/AdminLTE/dist/img') }}/set.gif" style="width:180px;height:50px;margin-left:10px">
      <br>
      <span style="font-family: inherit;font-variant-caps: small-caps;color: white;font-size: medium;">
      "A Family of Doctors For Your Hospital"
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info" style="color:white;padding-top: 25px">
            <br>
            <div style="text-align:center">
              <span style="font-family: inherit;font-variant-caps: small-caps;color: white;font-size:   larger;">
                  Welcome to Locumset
              </span>
            </div>


          <div style="text-align:center;padding-top:10px">
            <i class="fas fa-user-alt" style="color:#fd7e14"></i>
            <span style="font-family: inherit;font-variant-caps: small-caps;text-decoration: underline; color:white; font-size: 18px;">
              {{ucfirst(Auth::user()->name)}}
            </span>
          </div>
          <div style="padding-top:10px">
            <i class="fas fa-clock" style="color:white"></i>
            {{$ldate = date('H:i:s')}} &nbsp &nbsp &nbsp
            <i class="fas fa-calendar" style="color:white"></i>
             {{$ldate = date('d/m/yy')}}
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{route('admin.home')}}" class="{{ $request->segment(2) == 'home' ? 'nav-link active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt" style="color:white"></i>
              <p style="color:white">
                Dashboard
                <i class="right fas"></i>
              </p>
            </a>
          </li>
          @if(in_array('timesheet_manage',$per) )
            <li class="nav-item {{ $request->segment(2) == 'timesheet' ? 'nav-link active' : '' }}">
              <a href="{{route('admin.timesheet.index')}}" class="nav-link">
                <i class="nav-icon fa fa-clock" aria-hidden="true"></i>
                <p>
                  Time Sheet
                </p>
              </a>
            </li>
          @endif

          @if(in_array('job_manage',$per) )
          <li class="nav-item {{ $request->segment(2) == 'jobs' ? 'active active-sub' : '' }}">
            <a href="{{route('admin.job.index')}}" class="nav-link">
              <i class="nav-icon fas  fa-object-group"></i>
              <p>
                Shifts
              </p>
            </a>
          </li>
          @endif
          @if(in_array('application_manage',$per) )
            <li class="nav-item {{ $request->segment(2) == 'application' ? 'nav-link active' : '' }}">
              <a href="{{route('admin.application.index')}}" class="nav-link">

                <i class="nav-icon fas fa-envelope-open"></i>
                <p>
                  Applications
                </p>
              </a>
            </li>
          @endif
          {{--@if(in_array('shift_management_manage',$per) )--}}
          {{--<li class="nav-item {{ $request->segment(2) == 'shift_management' ? 'nav-link active' : '' }}">--}}
            {{--<a href="{{route('admin.shift_management.index')}}" class="nav-link">--}}
              {{--<i class="fa fa-tasks nav-icon"></i>--}}
              {{--<p>Shift Management</p>--}}
            {{--</a>--}}
          {{--</li>--}}
          {{--@endif--}}

          @if(in_array('job_manage',$per) )
            <li class="nav-item {{ $request->segment(2) == 'hired' ? 'nav-link active' : '' }}">
              <a href="{{route('admin.job.hired')}}" class="nav-link">
                <i class="fa fa-spinner nav-icon"></i>
                <p>Hired Shifts</p>
              </a>
            </li>
          @endif

          @if(in_array('job_manage',$per) )
            <li class="nav-item {{ $request->segment(2) == 'hired' ? 'nav-link active' : '' }}">
              <a href="{{route('admin.job.cancelled')}}" class="nav-link">
                <i class="fa fa-ban nav-icon"></i>
                <p>Cancelled Shifts</p>
              </a>
            </li>
          @endif

          @if(in_array('job_manage',$per) )
            <li class="nav-item {{ $request->segment(2) == 'hired' ? 'nav-link active' : '' }}">
              <a href="{{route('admin.job.save_jobs')}}" class="nav-link">
                <i class="fa fa-bookmark nav-icon"></i>
                <p>Saved Shifts</p>
              </a>
            </li>
          @endif

          @if(in_array('job_manage',$per) )
            <li class="nav-item {{ $request->segment(2) == 'completed' ? 'nav-link active' : '' }}">
              <a href="{{route('admin.job.completed')}}" class="nav-link">
                <i class="fa fa-check-square nav-icon"></i>
                <p>Completed Shifts</p>
              </a>
            </li>
          @endif

          @if(in_array('job_manage',$per) )
            <li class="nav-item {{ $request->segment(2) == 'archived' ? 'nav-link active' : '' }}">
              <a href="{{route('admin.job.archived')}}" class="nav-link">
                <i class="fa fa-archive nav-icon"></i>
                <p>Archived Shifts</p>
              </a>
            </li>
          @endif

          <li class="nav-item {{ $request->segment(2) == 'new' ? 'nav-link active' : '' }}">
            <a href="{{route('admin.users.new')}}" class="nav-link">
              <i class="fa fa-user-md nav-icon"></i>
              <p>New Doctors</p>
            </a>
          </li>

          @if(in_array('users_manage',$per) )
            <li class="nav-item {{ $request->segment(2) == 'hospital' ? 'nav-link active' : '' }}">
              <a href="{{route('admin.hospital.index')}}" class="nav-link">
                <i class="nav-icon fas fa-hospital"></i>
                <p>
                  Hospital
                </p>
              </a>
            </li>
          @endif
        @if(in_array('users_manage',$per) )
          <li class="nav-item {{ $request->segment(2) == 'doctors' ? 'nav-link active' : '' }}">
            <a href="{{route('admin.users.doctors')}}" class="nav-link">
              <i class="fa fa-user-md nav-icon"></i>
              <p>Doctors</p>
            </a>
          </li>

          <li class="nav-item {{ $request->segment(2) == 'users' ? 'nav-link active' : '' }}">
            <a href="{{route('admin.users.index')}}" class="nav-link">
              <i class="fa fa-user-circle nav-icon"></i>
              <p>Admins</p>
            </a>
          </li>

          <li class="nav-item {{ $request->segment(2) == 'departments' ? 'active active-sub' : '' }}">
            <a href="{{route('admin.departments.index')}}" class="nav-link">
              <i class="nav-icon fa fa-building"></i>
              <p>
                Departments
              </p>
            </a>
          </li>

        @endif
          @if(in_array('grade_manage',$per) )
          <li class="nav-item {{ $request->segment(2) == 'grades' ? 'active active-sub' : '' }}">
            <a href="{{route('admin.grades.index')}}" class="nav-link">
              <i class="nav-icon fa fa-address-card"></i>
              <p>
                Grades
              </p>
            </a>
          </li>


        @endif

          @if(in_array('users_manage',$per) )
            <li class="nav-item has-treeview {{ ($request->segment(2) == 'permissions' || $request->segment(2) == 'roles' || $request->segment(2) == 'users') ? 'active' : '' }}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  User Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ">
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }} nav-item">
                  <a href="{{route('admin.roles.index')}}" class="nav-link">
                    <i class="fas fa-briefcase nav-icon"></i>
                    <span>Roles</span>
                  </a>
                </li>
                <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }} nav-link">
                  <a href="{{ route('admin.permissions.index') }}">
                      <i class="fa fa-briefcase nav-icon"></i>
                      <span >Permissions</span>
                  </a>
              </li>

              </ul>
            </li>

          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>