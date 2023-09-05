@inject('request', 'Illuminate\Http\Request')
<?php $per = PermissionHelper::getUserPermissions();?>
@extends('layouts.admin')

@section('content')

@if($message = Session::get('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
@endif

@if($message = Session::get('error'))
    <div class="alert alert-error">{{ Session::get('error') }}</div>
@endif
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Completed Shifts Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Shifts</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Job</h3>
                <div class="card-tools">
                    @if(in_array('job_create',$per))
                        <a href="{{route('admin.job.create')}}" class="btn btn-info btn-sm pull-right">Create New Shifts</a>
                    @endif
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped {{ count($Jobs) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    @if($logged_in->role_id == 1)
                        <th>Hospital</th>
                        <th>Department</th>
                    @endif
                    <th>Date</th>
                    <th width='20%'>Title</th>
                    <th>Doctor</th>                   
                    <th>Start</th>
                    <th>End</th>
                    <th>Grades</th>
                    <th>Status</th>
                    
                </tr>
                </thead>
                <tbody>
                    @if (count($Jobs) > 0)
                        @foreach ($Jobs as $Job)
                            <tr data-entry-id="{{ $Job->id }}">

                                @if($logged_in->role_id == 1)
                                    <td>{{$Job->hosp_name->name }}</td>
                                    <td>{{$Job->dep_name->name }}</td>
                                @endif
                                <td>{{ date("d/m/yy", strtotime($Job->date))}}</td>
                                <td>{{  strtoupper($Job->title) }}</td>
                                <td><a href="{{ route('admin.users.profile',[$Job->doctor_id]) }}" target='_blank' class="btn btn-sm btn-info">{{ $Job->doctor_name }}</a></td>                           
                                <td>{{ date("H:i", strtotime($Job->time_from) )  }}</td>
                                <td>{{ date("H:i", strtotime($Job->time_to) )  }}</td>
                                <td onclick="FormControls.loadJobData({{ $Job->id }})">

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"> {{ $Job->num_of_grades }} </button>

                                </td>
                                <td>{{ Config::get('locum.job_overall_status_array.'.$Job->overall_status) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
              </table>
            </div>



            <!-- /.card-body -->
          </div>
          <!-- /.card -->

</section>
    <!-- /.content -->


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <section class="content-header card-info">
                <div class="container-fluid ">
                    <div class="card card-info">
                        <div class="card-header" style='text-align: center'>
                            <h3>Job Grades</h3>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="card card-primary">

                    <!-- /.card-header -->
                    <div class="col-md-12" >
                        <!-- Horizontal Form -->
                        <table class="table table-bordered  datatable" id="grade_details">
                            <thead>
                            <tr>

                                <th width='30%'>Grade</th>
                                <th >Rate</th>

                                <th>Time From</th>
                                <th>Time To</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                            <!-- /.card -->
                        </div>
                </div>

            </section>
        </div>
    </div>
</div>

@endsection

@section('jsscript')
    <script src="{{ url('public/js/admin/job/list.js') }}" type="text/javascript"></script>
@endsection

