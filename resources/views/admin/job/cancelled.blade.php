@inject('request', 'Illuminate\Http\Request')
<?php $per = PermissionHelper::getUserPermissions();?>
@extends('layouts.admin')

@section('content')

@if($message = Session::get('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
@endif
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Shifts Cancelled by Doctors</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Cancelled Shifts</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cancelled Shifts</h3>
                <div class="card-tools">

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped {{ count($Applications) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    @if($logged_in->role_id == 1)
                        <th>Hospital</th>
                        <th>Department</th>
                    @endif
                    <th>Applied Date</th>
                    <th>Shift</th>
                    <th>Doctor</th>
                    <th>Grade</th>                   
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($Applications) > 0)
                        @foreach ($Applications as $app)
                            <tr data-entry-id="{{ $app->id }}">

                                @if($logged_in->role_id == 1)
                                    <td>{{$app->hosp_name->name }}</td>
                                    <td>{{$app->dep_name->name }}</td>
                                @endif
                                <td>{{ date("d/m/Y", strtotime($app->applied_date)) }}</td>
                                <td>{{ strtoupper($app->job_name->title) }}</td>
                                <td><a href="{{ route('admin.users.profile',[$app->user_id]) }}" target='_blank' class="btn btn-sm btn-info">{{  $app->user_name->first_name }} {{$app->user_name->sur_name}}</a></td>
                                    <td>{{ $app->detail_name->grade_name->name }}</td>    
                                <td>{{ Config::get('locum.application_status_array.'.$app->status) }}</td>

                                <td>
                                    @if($logged_in->role_id == 2)
                                        <a href="{{ route('admin.job.repost',[$app->job_id]) }}" class="btn btn-sm  btn-outline-success">Re Post</a>
                                    @endif
                                </td>

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

@endsection
