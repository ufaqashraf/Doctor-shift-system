@extends('layouts.app')

@section('breadcrumbs')
    <section class="content-header" style="padding: 10px 15px !important;">
        <h1>Projects</h1>
    </section>
@stop

@section('content')

<nav class="navbar navbar-default">
    <div class="container-fluid">

        <ul class="nav navbar-nav">
            @include('admin.projects.nav-bar')
        </ul>
    </div>
</nav>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Update Project's Detail </h3>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-success pull-right">Back</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($Project, ['method' => 'PUT', 'id' => 'validation-form', 'route' => ['admin.projects.update', $Project->id], 'enctype' => 'multipart/form-data']) !!}
        <div class="box-body">
            @include('admin.projects.fields')
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('javascript')
<!-- 
    <script src="{{ url('public/js/admin/projects/create_modify.js') }}" type="text/javascript"></script> -->
    
    
@endsection