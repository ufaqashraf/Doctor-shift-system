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
            <h1>Published Jobs</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active"> Published Job </li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Published </h3>
                <div class="card-tools">

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped {{ count($Jobs_application) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    @if($logged_in->role_id == 1)
                        <th>Hospital</th>
                        <th>Department</th>
                    @endif
                    <th>Job Date</th>
                    <th>Shift</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>No. Of Grades</th>
                    <th>Applications</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($Jobs_application) > 0)
                        @foreach ($Jobs_application as $app)
                            <tr data-entry-id="{{ $app->id }}">

                                @if($logged_in->role_id == 1)
                                    <td>{{$app->hosp_name->name }}</td>
                                    <td>{{$app->dep_name->name }}</td>
                                @endif
                                <td>{{ date("d/m/Y", strtotime( $app->job_date )) }}</td>
                                <td>{{ strtoupper($app->title) }}</td>
                                {{--<td><a href="{{ route('admin.users.profile',[$app->user_id]) }}" target='_blank' class="btn btn-sm btn-info">{{  $app->user_name->first_name }} {{$app->user_name->sur_name}}</a></td>--}}
                                    {{--<td>{{ $app->detail_name->grade_name->name }}</td>--}}
                                <td>{{ date("H:i", strtotime($app->time_from) )  }}</td>
                                <td>{{ date("H:i", strtotime($app->time_to) )  }}</td>
                                <td>{{ $app->num_of_grades  }}</td>
                                <td> <button type="button" class="btn btn-primary"  onclick="FormControls.loadJobData({{ $app->id }})">  {{ $app->apps }} </button>
                                </td>
                                <td>
                                    @if($logged_in->role_id == 2)

                                        @if(Config::get('locum.application_status_array.'.$app->status) == 'New')
                                            <a href="{{ route('admin.application.change_status',[$app->id,$app->status + 1]) }}" class="btn btn-sm btn-success">Hire</a>

                                        @endif

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
@section('jsscript')
    <script src="{{ url('public/js/admin/job/list.js') }}" type="text/javascript"></script>
@endsection