@inject('request', 'Illuminate\Http\Request')
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
            <h1>Permissions Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Permissionss</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Permissions</h3>
              <div class="card-tools">
                @if(App\Helpers\PermissionHelper::has_permission('permissions_create'))
                    <a href="{{route('admin.permissions.create')}}" class="btn btn-info btn-sm pull-right">New Permission</a>
                @endif
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped {{ count($Permissions) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Create At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($Permissions) > 0)
                        @foreach ($Permissions as $Permission)
                            <tr data-entry-id="{{ $Permission->id }}">
                                <td>{{ $Permission->id }}</td>
                                <td>{{ $Permission->title }}</td>
                                <td>{{ $Permission->name }}</td>
                                <td>{{ $Permission->created_at }}</td>
                                <td>
                                    @if($Permission->status && App\Helpers\PermissionHelper::has_permission('permissions_inactive'))
                                        {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'PATCH',
                                                'onsubmit' => "return confirm('Are you sure to inactivate this record?');",
                                                'route' => ['admin.permissions.inactive', $Permission->id])) !!}
                                        {!! Form::submit('Inactivate', array('class' => 'btn btn-xs btn-warning')) !!}
                                        {!! Form::close() !!}
                                    @elseif(!$Permission->status && App\Helpers\PermissionHelper::has_permission('permissions_active'))
                                        {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'PATCH',
                                                'onsubmit' => "return confirm('Are you sure to activate this record?');",
                                                'route' => ['admin.permissions.active', $Permission->id])) !!}
                                        {!! Form::submit('Activate', array('class' => 'btn btn-xs btn-primary')) !!}
                                        {!! Form::close() !!}
                                    @endif

                                    @if(App\Helpers\PermissionHelper::has_permission('permissions_edit'))
                                        <a href="{{ route('admin.permissions.edit',[$Permission->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endif

                                    @if(App\Helpers\PermissionHelper::has_permission('permissions_destroy'))
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.permissions.destroy', $Permission->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">@lang('global.app_no_entries_in_table')</td>
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
