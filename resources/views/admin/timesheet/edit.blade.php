@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Hospital Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Hospitals</li>
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
            <h3 class="card-title">Update Hospital</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::model($Hospitals, ['method' => 'PUT', 'id' => 'validation-form', 'route' => ['admin.hospital.update', $Hospitals->id]]) !!}
                <div class="card-body">

                    <div class="form-group  col-md-3 @if($errors->has('name')) has-error @endif">
                        {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        @if($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                                    
                    </div>
                    <div class="form-group  col-md-3 @if($errors->has('name')) has-error @endif">
                        {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                        {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        @if($errors->has('email'))
                            <span class="help-block">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                                    
                    </div>
                    <div class="form-group  col-md-3 @if($errors->has('name')) has-error @endif">
                        {!! Form::label('phone', 'Phone*', ['class' => 'control-label']) !!}
                        {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        @if($errors->has('phone'))
                            <span class="help-block">
                                {{ $errors->first('phone') }}
                            </span>
                        @endif
                                    
                    </div>
                    <div class="form-group  col-md-3 @if($errors->has('name')) has-error @endif">
                        {!! Form::label('address', 'Address*', ['class' => 'control-label']) !!}
                        {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        @if($errors->has('address'))
                            <span class="help-block">
                                {{ $errors->first('address') }}
                            </span>
                        @endif
                                    
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-outline-danger']) !!}
                    <a href="{{route('admin.permissions.index')}}" class="btn btn-outline-secondary float-right">{{trans('global.app_back')}}</a>
                </div>
                <!-- /.card-footer -->
            {!! Form::close() !!}
        </div>
        <!-- /.card -->
    </div>       
</section>
    <!-- /.content -->

@endsection