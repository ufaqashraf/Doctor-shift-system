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
            <h1>Timesheet Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Timesheet</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Timesheets</h3>
                <div class="card-tools">

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped {{ count($Timesheets) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    <th>Actions</th>
                    @if($logged_in->role_id == 1)
                        <th>Hospital</th>
                        <th>Department</th>
                    @endif

                    <th width="12%">Doctor</th>
                    <th>Shifts</th>
                    
                    <th>Start</th>
                    <th>End</th>
                    <th>Break</th>
                    <th>Hours</th>
                    <th>Rate</th>
                    <th width='10%'>Calculated Amount</th>
                    

                    

                </tr>
                </thead>
                <tbody>
                    @if (count($Timesheets) > 0)
                        @foreach ($Timesheets as $tim)
                            <tr data-entry-id="{{ $tim->id }}" style="bgcolor: {{$tim->is_time_changed == 1 ? '#FF0000' : ''}}">
                                <td>
                                    @if($logged_in->role_id == 2)
                                        <a href="timesheet/{{$tim->id}}" style="margin-bottom:2px" class="btn btn-sm    btn-primary"><i class="glyphicon glyphicon-edit"></i>View</a>
                                        @if(Config::get('locum.job_overall_status_array.'.$tim->job_name->overall_status) == 'Timesheet Submitted' )
                                            <a href="{{ route('admin.timesheet.change_status',[$tim->job_name->id,'notify']) }}" class="btn btn-sm btn-success">Notify</a>
                                        @elseif(Config::get('locum.job_overall_status_array.'.$tim->job_name->overall_status) == 'Notified By Manager' )
                                            <a href="{{ route('admin.timesheet.change_status',[$tim->job_name->id,'approved']) }}" class="btn btn-sm btn-success">Approve Time Sheet</a>
                                        @elseif(Config::get('locum.job_overall_status_array.'.$tim->job_name->overall_status) == 'Approved By Manager' )
                                            <a href="{{ route('admin.timesheet.change_status',[$tim->job_name->id,'payroll']) }}" class="btn btn-sm btn-success">Send to Payroll</a>
                                        @endif
                                    @endif
                                </td>

                                @if($logged_in->role_id == 1)
                                    <td>{{$tim->hosp_name->name }}</td>
                                    <td>{{$tim->dep_name->name }}</td>
                                @endif

                                <td><a href="{{ route('admin.users.profile',[$tim->users_id]) }}" target='_blank' class="btn btn-sm btn-info">{{$tim->Doc_name->first_name }} {{$tim->Doc_name->sur_name }}</a></td>
                                <td>{{strtoupper($tim->job_name->title) }}</td>
                                
                                <td>{{ date("H:i", strtotime($tim->time_from) )  }} </td>
                                <td>{{ date("H:i", strtotime($tim->time_to) ) }} </td>
                                <td>{{ $tim->break_time }}</td>
                                {{--<td> {{gmdate('H:i', floor($tim->job_hours * 3600))}}</td>--}}
                                <td> {{$tim->job_hours}}</td>
                                <td>£ {{ $tim->rate }}</td>
                                <td>£ {{ $tim->calculated_amount }}</td>
                                


                                


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
<script>
    $(document).ready(function() {
        $('#example1').DataTable( {
            "scrollX": true
        } );
    } );
</script>
@endsection
