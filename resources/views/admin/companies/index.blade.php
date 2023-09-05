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
            <h1>Companies Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Companies</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Companies</h3>
              <div class="card-tools">
                <a href="{{route('admin.companies.create')}}" class="btn btn-info btn-sm pull-right">New Financial Year</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Logo</th>
                  <th>Currency</th>
                  <th>Address</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @if (count($Companies) > 0)
                    @foreach ($Companies as $Companie)
                        <tr {{ $Companie->id }}>
                            <td>{{ $Companie->id }}</td>
                            <td>{{ $Companie->name }}</td>
                            <td><img src='<?php echo url("public/uploads/$Companie->image")?>' style="width:50px;height:50px"></td>
                            <td>{{Config::get('support.currency_array.'.$Companie->currency )}}</td>
                            <td>{{ $Companie->address }}</td>
                            <td>{{ $Companie->created_at }}</td>
                            <td>
                                @if($Companie->status && Gate::check('companies_inactive'))
                                    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'PATCH',
                                            'onsubmit' => "return confirm('Are you sure to inactivate this record?');",
                                            'route' => ['admin.companies.inactive', $Companie->id])) !!}
                                    {!! Form::submit('Inactivate', array('class' => 'btn btn-sm btn-outline-warning')) !!}
                                    {!! Form::close() !!}
                                @elseif(!$Companie->status && Gate::check('companies_active'))
                                    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'PATCH',
                                            'onsubmit' => "return confirm('Are you sure to activate this record?');",
                                            'route' => ['admin.companies.active', $Companie->id])) !!}
                                    {!! Form::submit('Activate', array('class' => 'btn btn-sm btn-outline-success')) !!}
                                    {!! Form::close() !!}
                                @endif

                                @if(Gate::check('companies_edit'))
                                    <a href="{{ route('admin.companies.edit',[$Companie->id]) }}" class="btn btn-sm btn-outline-info">@lang('global.app_edit')</a>
                                @endif

                                {{--@if(Gate::check('companies_destroy'))--}}
                                    {{--{!! Form::open(array(--}}
                                        {{--'style' => 'display: inline-block;',--}}
                                        {{--'method' => 'DELETE',--}}
                                        {{--'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",--}}
                                        {{--'route' => ['admin.companies.destroy', $Companie->id])) !!}--}}
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