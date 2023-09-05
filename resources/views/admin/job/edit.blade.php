@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Job Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
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
                    <h3 class="card-title">Update Job</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::model($Job, ['method' => 'PUT', 'id' => 'validation-form', 'route' => ['admin.job.update', $Job->id]]) !!}
                <div class="card-body">
                    <div class="row">
                        @include('admin.job.field')
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-outline-danger']) !!}
                        <a href="{{route('admin.job.index')}}" class="btn btn-outline-secondary float-right">{{trans('global.app_back')}}</a>
                    </div>

                    <!-- /.card-footer -->

                    {!! Form::close() !!}
                    @include('admin.job.job-info-templates')
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->

@endsection