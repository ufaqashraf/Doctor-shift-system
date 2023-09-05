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
            <h1>Shift Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Shift Management</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Shift Management</h3>
                <div class="card-tools">
                        <a href="{{route('admin.shift_management.create')}}" class="btn btn-info btn-sm pull-right">New Shift</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped {{ count($Shifts) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Create At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($Shifts) > 0)
                        @foreach ($Shifts as $Shift)
                            <tr data-entry-id="{{ $Shift->id }}">
                                <td>{{  $Shift->name }}</td>                        
                                <td>{{ $Shift->time_to }}</td>
                                <td>{{ $Shift->time_from }}</td>
                                <td>{{ $Shift->created_at }}</td>
                                <td>

                                    @if(in_array('shift_management_edit',$per))
                                        <a href="{{ route('admin.shift_management.edit',[$Shift->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endif

                                    @if(in_array('shift_management_destroy',$per))
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.shift_management.destroy', $Shift->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xl btn-danger')) !!}
                                        {!! Form::close() !!}
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
