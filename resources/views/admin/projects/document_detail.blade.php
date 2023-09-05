@extends('layouts.app')

@section('breadcrumbs')
    <section class="content-header" style="padding: 10px 15px !important;">
        <h1>Employees</h1>
    </section>
@stop
@section('stylesheet')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('public/adminlte') }}/bower_components/select2/dist/css/select2.min.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('public/adminlte') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ url('public/adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


    <link rel="stylesheet" href="{{ url('public/adminlte') }}/bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">



@stop
@section('content')

<nav class="navbar navbar-default">
    <div class="container-fluid">

        <ul class="nav navbar-nav">
            <li ><a href="{{ route('admin.employees.edit',[$Employee->id]) }}">Personal Details</a></li>
            <li><a href="{{ route('admin.employees.education',[$Employee->id]) }}">Educational History</a></li>
            <li><a href="{{ route('admin.employees.employment_history',[$Employee->id]) }}">Employment History</a></li>
            <li ><a href="{{ route('admin.employees.certification',[$Employee->id]) }}">Certifications & Trainings</a></li>
            <li ><a href="{{ route('admin.employees.references',[$Employee->id]) }}">References</a></li>
            <li class="active"><a href="{{ route('admin.employees.documents',[$Employee->id]) }}">Documents</a></li>
        </ul>
    </div>
</nav>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Insert Employee's Document Detail</h3>
        <a href="{{ route('admin.employees.index') }}" class="btn btn-success pull-right">Back</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($Employee, ['method' => 'post', 'id' => 'validation-form', 'route' => ['admin.employees.documentdata', $Employee->id], 'enctype' => 'multipart/form-data']) !!}
    <div class="box-body">
        @include('admin.employees.document_fields')
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    </div>
    @include('admin.employees.document_items_template')
    {!! Form::close() !!}
</div>
@stop

@section('javascript')
    <!-- date-range-picker -->
    <script src="{{ url('public/adminlte') }}/bower_components/moment/min/moment.min.js"></script>
    <script src="{{ url('public/adminlte') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap datepicker -->
    {{--<script src="{{ url('public/adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>--}}

    <script src="{{ url('public/adminlte') }}/bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Select2 -->
    <script src="{{ url('public/adminlte') }}/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="{{ url('public/js') }}/admin/employees/document.js" type="text/javascript"></script>
@endsection