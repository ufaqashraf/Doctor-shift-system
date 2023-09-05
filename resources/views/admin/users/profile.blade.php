@inject('request', 'Illuminate\Http\Request')
<?php $per = PermissionHelper::getUserPermissions();?>
@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="row col-md-12" style="top: 20px;font-family: auto">
    <div class="col-md-4">
        <section class="content">
          <div class="container-fluid" style='font-family: auto'>
          @foreach ($users as $user)
            <div class="col-md-12">

              <!-- Profile Image -->
              <div class="card card-primary" style='height:490px'>
              <div class="card-header">
                  <h3 class="card-title">Profile</h3>
                </div>
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile img-circle" width="180" height="160"
                    src="/public/uploads/doctors/{{$user->image}}"
                        alt="User profile picture">
                       
                  </div>

                  <h3 class="profile-username text-center">{{ $user->first_name }} {{ $user->sur_name }}</h3>

                  <p class="text-muted text-center">GMC: &nbsp&nbsp{{ $user->gmc }}</p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Mobile</b> <a class="float-right">{{ $user->mobile }}</a>
                    </li>
                
                  </ul>
                </div>
                <!-- /.card-body -->

          </div>
            </div>
            @endforeach
          </div>
            <!-- /.card -->

        </section>
      </div>  
<div class="col-md-8">
          <section>
              <!-- About Me Box -->
              <div class="card card-primary" style='height:auto; width:700px'>
                <div class="card-header">
                  <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                
                <strong><i class="fas fa-hospital mr-1"></i> Current Hospital</strong><a class="float-right">{{ $user->hosp_name->name }}</a>
                    <hr>
                    <strong><i class="fas fa-building mr-1"></i>Current Department</strong><a class="float-right">{{ $user->dep_name->name }}</a>
  
                  <hr>

                  <strong><i class="fas fa-pencil-alt mr-1"></i> Experience</strong>
                  <?php
                    $count = 0;
                    ?>
                    <table class="table table-bordered table-striped datatable dataTable" >
                        <thead>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Hospital</th>
                        <th>Department</th>

                        </thead>
                  @foreach ($experience as $experiences)
                
                    


                            <tr>
                               <td class="text-muted" style="border:none"><i class="fas fa-clock mr-2"></i>{{ $experiences->from_date }}</td>
                               <td class="text-muted" style="border:none">{{ $experiences->to_date }}</td>
                               <td class="text-muted" style="border:none"><i class="fas fa-hospital mr-2"></i>{{ $experiences->hospital_id }}</td>
                               <td class="text-muted" style="border:none"><i class="fas fa-building mr-2"></i>{{ $experiences->dept_id }}</td>

                      <!-- <span>{{$count++}}</span>) -->
                      
                    
                    @endforeach
                    </table>
                  <hr>

    
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

        <!-- /.container-fluid -->
      </section>
    </div>  
    <!-- /.content -->
  </div>
    <!-- /.content -->

@endsection
@section('jsscript')

{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> --}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@endsection