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
            <h1>Branches Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Branches</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Branches</h3>
              <div class="card-tools">
                <a href="{{route('admin.branches.create')}}" class="btn btn-info btn-sm pull-right">New Branch</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Region Name</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $regions = \App\Models\Admin\Regions::get()->getDictionary(); ?>
                    @if (count($Branches) > 0)
                      @foreach ($Branches as $Branche)
                        <tr data-entry-id="{{ $Branche->id }}">
                          <td>{{ $Branche->id }}</td>
                          <td>{{ $Branche->name }}</td>
                          <td>{{  $regions[$Branche->region_id]->name }}</td>
                          <td>{{ $Branche->created_at }}</td>
                          <td>
                              @if(Gate::check('branches_edit'))
                                  <a href="{{ route('admin.branches.edit',[$Branche->id]) }}" class="btn btn-sm btn-outline-info">@lang('global.app_edit')</a>
                              @endif

                              {{--@if(Gate::check('branches_destroy'))--}}
                                  {{--{!! Form::open(array(--}}
                                      {{--'style' => 'display: inline-block;',--}}
                                      {{--'method' => 'DELETE',--}}
                                      {{--'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",--}}
                                      {{--'route' => ['admin.branches.destroy', $Branche->id])) !!}--}}
                                  {{--{!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-sm btn-danger')) !!}--}}
                                  {{--{!! Form::close() !!}--}}
                              {{--@endif--}}
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