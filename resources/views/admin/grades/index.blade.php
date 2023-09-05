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
            <h1>Grade Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Grade</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Grade</h3>
                <div class="card-tools">
                    @if(in_array('grade_create',$per))
                        <a href="{{route('admin.grades.create')}}" class="btn btn-info btn-sm pull-right">New Grade</a>
                    @endif
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped {{ count($Grades) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    <th>Name</th>

                    <th>Create At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($Grades) > 0)
                        @foreach ($Grades as $Grade)
                            <tr data-entry-id="{{ $Grade->id }}">
                                <td>{{  $Grade->name }}</td>
                                <td>{{ $Grade->created_at }}</td>
                                <td>

                                    @if(in_array('grade_edit',$per))
                                        <a href="{{ route('admin.grades.edit',[$Grade->id]) }}" class="btn btn-sm btn-info">@lang('global.app_edit')</a>
                                    @endif

                                    @if(in_array('grade_destroy',$per))
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.grades.destroy', $Grade->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-sm btn-danger')) !!}
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
