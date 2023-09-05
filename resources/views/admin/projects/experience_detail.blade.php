@extends('layouts.app')

@section('breadcrumbs')
    <section class="content-header" style="padding: 10px 15px !important;">
        <h1>Employees</h1>
    </section>
@stop
@section('stylesheet')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('adminlte') }}/bower_components/select2/dist/css/select2.min.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('adminlte') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ url('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


    <link rel="stylesheet" href="{{ url('adminlte') }}/bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">



@stop
@section('content')
    <?php
    if(count($Employee1)!=0)
    { ?>

    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <ul class="nav navbar-nav">
                <li ><a href="{{ route('admin.employees.edit',[$Employee1->id]) }}">Personal Details</a></li>
                <li ><a href="{{ route('admin.employees.job',[$Employee1->id]) }}">Job</a></li>
                <li ><a href="{{ route('admin.employees.salary',[$Employee1->id]) }}">Salary</a></li>
                <li class="active"><a href="{{ route('admin.employees.experience',[$Employee1->id]) }}">Work Experience</a></li>
                <li><a href="{{ route('admin.employees.education',[$Employee1->id]) }}">Education</a></li>
                <li><a href="{{ route('admin.employees.resignation',[$Employee1->id]) }}">Resignation</a></li>
                <li><a href="{{ route('admin.employees.documents',[$Employee1->id]) }}">Documents</a></li>
            </ul>
        </div>
    </nav>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Update Employee's Experience detail</h3>
            <a href="{{ route('admin.employees.index') }}" class="btn btn-success pull-right">Back</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($Employee1, ['method' => 'post', 'id' => 'validation-form', 'route' => ['admin.employees.experiencedata', $Employee1->id]]) !!}
        <div class="box-body">
            @include('admin.employees.experience_fields')
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>

   <?php }if(count($Employee)!=0)
    {?>
        <nav class="navbar navbar-default">
        <div class="container-fluid">

            <ul class="nav navbar-nav">
                <li ><a href="{{ route('admin.employees.edit',[$Employee->id]) }}">Personal Details</a></li>
                <li ><a href="{{ route('admin.employees.job',[$Employee->id]) }}">Job</a></li>
                <li ><a href="{{ route('admin.employees.salary',[$Employee->id]) }}">Salary</a></li>
                <li class="active"><a href="{{ route('admin.employees.experience',[$Employee->id]) }}">Work Experience</a></li>
                <li><a href="{{ route('admin.employees.education',[$Employee->id]) }}">Education</a></li>
                <li><a href="{{ route('admin.employees.resignation',[$Employee->id]) }}">Resignation</a></li>
            </ul>
        </div>
    </nav>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Insert Employee's Experience detail</h3>
            <a href="{{ route('admin.employees.index') }}" class="btn btn-success pull-right">Back</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($Employee, ['method' => 'post', 'id' => 'validation-form', 'route' => ['admin.employees.experiencedata', $Employee->id]]) !!}
        <div class="box-body">
            @include('admin.employees.experience_fields')
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
   <?php }?>

@stop

@section('javascript')
    <!-- date-range-picker -->
    <script src="{{ url('adminlte') }}/bower_components/moment/min/moment.min.js"></script>
    <script src="{{ url('adminlte') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap datepicker -->
    {{--<script src="{{ url('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>--}}

    <script src="{{ url('adminlte') }}/bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Select2 -->
    <script src="{{ url('adminlte') }}/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="{{ url('js/admin/employees/job_create_modify.js') }}" type="text/javascript"></script>
@endsection