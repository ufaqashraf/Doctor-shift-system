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
            <h1>Role Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Roles</h3>
              <div class="card-tools">
                <a href="{{route('admin.roles.create')}}" class="btn btn-info btn-sm pull-right">New Role</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($Roles) > 0)
                        @foreach ($Roles as $Role)
                            <tr data-entry-id="{{ $Role->id }}">
                                <td>{{ $Role->id }}</td>
                                <td>{{ $Role->name }}</td>
                                <td>{{ $Role->created_at }}</td>
                                <td>
                                    {{--@if($Role->status && Gate::check('roles_inactive'))--}}
                                        {{--{!! Form::open(array(--}}
                                                {{--'style' => 'display: inline-block;',--}}
                                                {{--'method' => 'PATCH',--}}
                                                {{--'onsubmit' => "return confirm('Are you sure to inactivate this record?');",--}}
                                                {{--'route' => ['admin.roles.inactive', $Role->id])) !!}--}}
                                        {{--{!! Form::submit('Inactivate', array('class' => 'btn btn-xs btn-warning')) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    {{--@elseif(!$Role->status && Gate::check('roles_active'))--}}
                                        {{--{!! Form::open(array(--}}
                                                {{--'style' => 'display: inline-block;',--}}
                                                {{--'method' => 'PATCH',--}}
                                                {{--'onsubmit' => "return confirm('Are you sure to activate this record?');",--}}
                                                {{--'route' => ['admin.roles.active', $Role->id])) !!}--}}
                                        {{--{!! Form::submit('Activate', array('class' => 'btn btn-xs btn-primary')) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    {{--@endif--}}
    
                                    {{--@if(Gate::check('roles_edit'))--}}
                                        <a href="{{ route('admin.roles.edit',[$Role->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {{--@endif--}}
    
                                    {{--@if(Gate::check('roles_destroy'))--}}
                                        {{--{!! Form::open(array(--}}
                                            {{--'style' => 'display: inline-block;',--}}
                                            {{--'method' => 'DELETE',--}}
                                            {{--'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",--}}
                                            {{--'route' => ['admin.roles.destroy', $Role->id])) !!}--}}
                                        {{--{!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    {{--@endif--}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('global.app_no_entries_in_table')</td>
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