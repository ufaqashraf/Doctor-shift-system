@extends('layouts.admin')

@section('content')

@if($message = Session::get('success'))
    <script type="text/javascript">
        toastr.info('<?php echo $message; ?>', 'Success Alert', {timeOut: 5000})
    </script>

@endif
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Units Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Units</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Units</h3>
              <div class="card-tools">
                <a href="{{route('admin.units.create')}}" class="btn btn-info btn-sm pull-right">New Unit</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Short Code</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @if (count($Units) > 0)
                    @foreach ($Units as $Unit)
                      <tr data-entry-id="{{ $Unit->id }}">
                          <td>{{ $Unit->id }}</td>
                          <td>{{ $Unit->name }}</td>
                          <td>{{ $Unit->shortcode }}</td>
                          <td>{{ $Unit->created_at }}</td>
                          <td>
                              @if(Gate::check('units_edit'))
                                  <a href="{{ route('admin.units.edit',[$Unit->id]) }}" class="btn btn-sm btn-outline-info">@lang('global.app_edit')</a>
                              @endif

                              {{--@if(Gate::check('units_destroy'))--}}
                                  {{--{!! Form::open(array(--}}
                                      {{--'style' => 'display: inline-block;',--}}
                                      {{--'method' => 'DELETE',--}}
                                      {{--'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",--}}
                                      {{--'route' => ['admin.units.destroy', $Unit->id])) !!}--}}
                                  {{--{!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}--}}
                                  {{--{!! Form::close() !!}--}}
                              {{--@endif--}}
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


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@endsection