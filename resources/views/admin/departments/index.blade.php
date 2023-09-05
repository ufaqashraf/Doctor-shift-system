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
            <h1>Departments Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Departments</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Departments</h3>
              <div class="card-tools">
                <a href="{{route('admin.departments.create')}}" class="btn btn-info btn-sm pull-right">New Departments</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

                    <th>Department</th>
                    {{--<th>Hospital</th>--}}
                    <th>Create At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  @if (count($Departments) > 0)
                    @foreach ($Departments as $Department)
                      <tr data-entry-id="{{ $Department->id }}">

                            <td>{{ $Department->name }}</td>
                            {{--<td>{{  $Department->hosp_name->name }}</td>--}}

                            <td>{{ $Department->created_at }}</td>
                          <td>
                              
                                  <a href="{{ route('admin.departments.edit',[$Department->id]) }}" class="btn btn-sm btn-info">@lang('global.app_edit')</a>
                             

                              
                                  {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.departments.destroy', $Department->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-sm btn-danger')) !!}
                                        {!! Form::close() !!}
                             
                          </td>
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

@endsection