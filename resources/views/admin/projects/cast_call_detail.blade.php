@extends('layouts.app')

@section('breadcrumbs')
    <section class="content-header" style="padding: 10px 15px !important;">
        <h1>Cast Calls</h1>
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
        <h3 class="box-title">Insert Cast Call Detail</h3>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-success pull-right">Back</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($Project, ['method' => 'post', 'id' => 'validation-form', 'route' => ['admin.projects.castcalldata', $Project->id]]) !!}
    <div class="box-body">
        @include('admin.projects.cast_calls_fields')
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    </div>
    @include('admin.projects.cast_calls_items_template')
    {!! Form::close() !!}
</div>
@stop

@section('javascript')
    <script src="{{ url('public/js') }}/admin/projects/cast_calls.js" type="text/javascript"></script>
@endsection