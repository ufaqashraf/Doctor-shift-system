@extends('layouts.admin')

@section('content')
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
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">Update Regions</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::model($Branche, ['method' => 'PUT', 'id' => 'validation-form', 'route' => ['admin.regions.update', $Branche->id], 'data-parsley-validate']) !!}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                            {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control','maxlength' => 40 , 'data-parsley-required' => 'true']) !!}
                            @if($errors->has('name'))
                                <span class="help-block">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('start_date')) has-error @endif">
                            {!! Form::label('company', 'Company *', ['class' => 'control-label']) !!}
                            <select id="company" name="location" class="form-control select2" required>
                                <option value="">Select Location</option>
                                @foreach($companies  as $company)
                                    <option value="{{$company->id}}" {{$Branche->company == $company->id ? 'selected="selected"' : ''}}>{{$company->name}}</option>
                                @endforeach
                            </select>
        
                            <span id="company_handler"></span>
                            @if($errors->has('company'))
                                <span class="help-block">
                                    {{ $errors->first('company') }}
                                </span>
                            @endif
                        </div>
                        {!! Form::hidden('id', old('id')) !!}
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-outline-danger']) !!}
                    <a href="{{route('admin.financial_years.index')}}" class="btn btn-outline-secondary float-right">{{trans('global.app_back')}}</a>
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