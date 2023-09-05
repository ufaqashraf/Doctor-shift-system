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
            <h1>User Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">User</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Users</h3>
              <div class="card-tools">
                  @if(in_array('users_create',$per))
                <a href="{{route('admin.users.create')}}" class="btn btn-info btn-sm pull-right">New User</a>
                  @endif
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th>Name</th>
                    <th>Hospital</th>
                    <th>Department</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->admin_hosp->name }}</td>
                                <td>{{ $user->admin_dept->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role_name->role_name }}</td>
                                <td>
                                    @if(in_array('users_create',$per))
                                        <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endif
                                    @if(in_array('users_destroy',$per))
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
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

{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> --}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@endsection