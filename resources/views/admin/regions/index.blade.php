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
            <h1>Regions Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Regions</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Regions</h3>
              <div class="card-tools">
                <a href="{{route('admin.regions.create')}}" class="btn btn-info btn-sm pull-right">New Region</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Company Name</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @if (count($Regions) > 0)
                    @foreach ($Regions as $Region)
                      <tr data-entry-id="{{ $Region->id }}">
                          <td>{{ $Region->id }}</td>
                          <td>{{ $Region->name }}</td>
                          <td>{{ $Region->companyName['name'] }}</td>
                          <td>{{ $Region->created_at }}</td>
                          <td>
                              @if(Gate::check('regions_edit'))
                                  <a href="{{ route('admin.regions.edit',[$Region->id]) }}" class="btn btn-sm btn-outline-info">@lang('global.app_edit')</a>
                              @endif

                              {{--@if(Gate::check('regions_destroy'))--}}
                                  {{--{!! Form::open(array(--}}
                                      {{--'style' => 'display: inline-block;',--}}
                                      {{--'method' => 'DELETE',--}}
                                      {{--'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",--}}
                                      {{--'route' => ['admin.regions.destroy', $Region->id])) !!}--}}
                                  {{--{!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}--}}
                                  {{--{!! Form::close() !!}--}}
                              {{--@endif--}}
                          </td>
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
@section('jsscript')


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@endsection