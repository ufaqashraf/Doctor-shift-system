@extends('layouts.app')

@section('breadcrumbs')
    <section class="content-header" style="padding: 10px 15px !important;">
        <h1>Shooting Schedule</h1>
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
        <h3 class="box-title">Insert Project's Shooting schedule</h3>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-success pull-right">Back</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($Project, ['method' => 'post', 'id' => 'validation-form', 'route' => ['admin.projects.scheduledata', $Project->id ,'enctype' => 'multipart/form-data'] ]) !!}
    <div class="box-body">
        @include('admin.projects.schedule_fields')
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    </div>
    @include('admin.projects.schedule_items_template')
    {!! Form::close() !!}


    <!-- Modal -->
<div id="unitModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="unitModalHeader">Unit Calls of Day</h4>
      </div>
      <div class="modal-body" id = "unit_calls_modal">

            <!-- form start1 -->
    {!! Form::model($Project, ['method' => 'post', 'id' => 'unitcall-form', 'route' => ['admin.projects.callsdata', $Project->id]]) !!}
        {{ Form::hidden('project_id', $Project->id) }}
        {{ Form::hidden('unit_day_no', 1, array('id' => 'unit_day_no')) }}
    <div class="box-body">
        @include('admin.projects.unit_calls_fields')
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    </div>
    {!! Form::close() !!}
    @include('admin.projects.unit_calls_items_template')
    
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



    <!-- Modal -->
<div id="castModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width : 70%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="castModalHeader">Cast Calls of Day</h4>
      </div>
      <div class="modal-body" id = "cast_calls_modal">

            <!-- form start -->
   <!-- form start -->
    {!! Form::model($Project, ['method' => 'post', 'id' => 'castcall-form', 'route' => ['admin.projects.castcalldata', $Project->id]]) !!}
    {{ Form::hidden('project_id', $Project->id) }}
        {{ Form::hidden('cast_day_no', 1, array('id' => 'cast_day_no')) }}
    <div class="box-body">
        @include('admin.projects.cast_calls_fields')
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    </div>
    
    {!! Form::close() !!}
    @include('admin.projects.cast_calls_items_template')
    
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



    <!-- Modal -->
<div id="scheduleModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width : 80%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="scheduleModalHeader">Shooting schedule of Day</h4>
      </div>
      <div class="modal-body" id = "schedule_modal">

   <!-- form start -->
    {!! Form::model($Project, ['method' => 'post', 'id' => 'validation-form', 'enctype' => 'multipart/form-data','route' => ['admin.projects.scheduledata', $Project->id ] ]) !!}

     {{ Form::hidden('project_id', $Project->id) }}
    {{ Form::hidden('schedule_day_no', 1, array('id' => 'schedule_day_no')) }}
    <div class="box-body">
        @include('admin.projects.shooting_fields')
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    </div>
    
    {!! Form::close() !!}
    @include('admin.projects.shooting_items_template')
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<div id="successAlert" class="modal fade" role="dialog">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="successAlertHeader">Success</h4>
      </div>
      <div class="modal-body" id = "schedule_modal">
      <p>
        Data has been saved
      </p>
  
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




</div>
@stop

@section('javascript')
    
    <script src="{{ url('public/js') }}/admin/projects/schedule.js" type="text/javascript"></script>
@endsection