  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin/home" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="mailto:support@locumset.com" class="nav-link">Contact us</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <div style='color:white; margin-left: 180px'>
          @if(Auth::user()->role_id == 2)
<?php
              $dep = \App\Models\Admin\Departments::where(['id'=> Auth::user()->dept_id])->get('name');
              $hosp = \App\Models\Admin\Hospital::where(['id'=> Auth::user()->hospital_id])->get('name');
?>
            <i class="nav-icon fas fa-hospital" aria-hidden="true"></i>&nbsp
            <span> {{$hosp[0]['name']}} </span> &nbsp &nbsp &nbsp
            <i class="nav-icon fa fa-building"></i>&nbsp
            <span> {{$dep[0]['name']}} </span>
          @endif
          </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
       <!-- Logout Dropdown Menu -->
       <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" title="Logout"  href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <i>LOGOUT</i>
            <span class="badge badge-warning navbar-badge"></span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->