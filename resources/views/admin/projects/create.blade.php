@extends('layouts.app')


@section('breadcrumbs')
    <section class="content-header" style="padding: 10px 15px !important;">
        <h1>Projects</h1>
    </section>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create Project</h3>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-success pull-right">Back</a>
        </div>
        {!! Form::open(['method' => 'POST', 'route' => ['admin.projects.store'], 'id' => 'validation-form', 'enctype' => 'multipart/form-data']) !!}

        <div class="box-body">
            @include('admin.projects.fields')
        </div>

        <div class="box-footer">
            {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('javascript')
    
    <script src="{{ url('public/js/admin/projects/create_modify.js') }}" type="text/javascript"></script>
@endsection

