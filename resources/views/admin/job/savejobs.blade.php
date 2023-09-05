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
            <h1>Shift Management</h1>
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


<section class="content">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="card card-info">
            
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::open(['method' => 'POST', 'route' => ['admin.job.Schoolfilter'], 'data-parsley-validate']) !!}
            <div class="card-body">
                <div class="row">
                @if($logged_in->role_id == 1)
                    <div class="col-sm-4">
                            {!! Form::select('hospital_id', $Hospital, old('hospital_id'), ['class' => 'form-control select2']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('hospital_id'))
                                <p class="help-block">
                                    {{ $errors->first('hospital_id') }}
                                </p>
                            @endif
                    </div>
                    <div class="col-sm-4">
                        {!! Form::select('dept_id', $Departments, old('dept_id'), ['class' => 'form-control select2','id' => 'dept_id' ] )!!}
                        <p class="help-block"></p>
                        @if($errors->has('dept_id'))
                            <p class="help-block">
                                {{ $errors->first('dept_id') }}
                            </p>
                        @endif
                    </div>
                @endif
                @if($logged_in->role_id == 2)
                    <div class="col-sm-4">
                            {!! Form::text('date', $filter_date, ['class' => 'form-control datepicker','placeholder'=>'Select date']) !!}
                                <p class="help-block"></p>
                            @if($errors->has('date'))
                                <p class="help-block">
                                    {{ $errors->first('date') }}
                                </p>
                            @endif
                    </div>
                    <div class="col-sm-4">
                        {!! Form::select('status', $status_array, $filter_status, ['class' => 'form-control select2','id' => 'status','placeholder'=>'Select status' ] )!!}
                        <p class="help-block"></p>
                        @if($errors->has('status'))
                            <p class="help-block">
                                {{ $errors->first('status') }}
                            </p>
                        @endif
                    </div>
                @endif        
                    <button  type='submit' class="btn btn-outline-danger " style= 'height: 37px'>Search</button>
                </div>
                {!! Form::close() !!}   
            </div>
        </div>    
        <!-- /.card -->
    </div>       
</section>



<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Shifts</h3>
                <div class="card-tools">
                    @if(Auth::user()->role_id == 2)
                        @if(in_array('job_create',$per))
                            <a href="{{route('admin.job.create')}}" class="btn btn-info btn-sm pull-right">Create New Shift</a>
                        @endif
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
                    <th>Start</th>
                    <th>End</th>
                    <th>Grades</th>
                    <th>Status</th>
                    <th style="width: 250px;">Actions</th>
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
                                <td>{{ date("d/m/Y", strtotime($Job->date))  }}</td>
                                <td>{{  strtoupper($Job->title) }}</td>                               
                                <td>{{ date("H:i", strtotime($Job->time_from) )  }}</td>
                                <td>{{ date("H:i", strtotime($Job->time_to) )  }}</td>
                                <td onclick="FormControls.loadJobData({{ $Job->id }})">

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"> {{ $Job->num_of_grades }} </button>

                                </td>
                                    <td>{{ Config::get('locum.job_overall_status_array.'.$Job->overall_status) }}</td>
                                {{--<td>{{ Config::get('locum.job_hire_array.'.$Job->hire_status) }}</td>--}}
                                {{--<td>{{ Config::get('locum.job_status_array.'.$Job->status) }}</td>--}}
                            
                                <td>

                                    @if($logged_in->role_id == 2)

                                        <a href="{{ route('admin.job.edit',[$Job->id]) }}" class="btn btn-sm btn-info">@lang('global.app_edit')</a>
                                            <a href="{{ route('admin.job.repost',[$Job->id]) }}" class="btn btn-sm  btn-outline-success">Re Post</a>
                                        {{--{!! Form::open(array(--}}
                                        {{--'style' => 'display: inline-block;',--}}
                                        {{--'method' => 'DELETE',--}}
                                        {{--'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",--}}
                                        {{--'route' => ['admin.hospital.destroy', $Job->id])) !!}--}}
                                        {{--{!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-sm btn-danger')) !!}--}}
                                        {{--{!! Form::close() !!}--}}

                                        <a href="{{ route('admin.job.job_status',[$Job->id,'close']) }}" class="btn btn-sm btn-success">Close</a>
                                        @if($Job->save_status==0)
                                                <a href="{{ route('admin.job.save_status',[$Job->id]) }}" class="btn btn-sm btn-outline-success">Save</a>
                                        @elseif(Config::get('locum.job_overall_status_array.'.$Job->overall_status) == 'Published' )
                                            
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


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
       
            <section class="content-header card-info">
                <div class="container-fluid ">
                    <div class="card card-info">
                        <div class="card-header">
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
                                <th >Rate (£)</th>

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

