@extends('layouts.admin')

@section('content')
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
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">Departments Registration</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::model($Departments, ['method' => 'PUT', 'id' => 'validation-form', 'route' => ['admin.departments.update', $Departments->id], 'data-parsley-validate']) !!}
                <div class="card-body">
                    <div class="row">
                        @include('admin.departments.field')
                        {!! Form::hidden('id', old('id')) !!}
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-outline-danger']) !!}
                    <a href="{{route('admin.departments.index')}}" class="btn btn-outline-secondary float-right">{{trans('global.app_back')}}</a>
                </div>
                <!-- /.card-footer -->
            {!! Form::close() !!}
        </div>
        <!-- /.card -->
    </div>       
</section>
    <!-- /.content -->

@endsection
@section('jsscript')
<script src="{{ url('public/js/admin/financial_years/create_modify.js') }}" type="text/javascript"></script>

@endsection