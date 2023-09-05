@inject('request', 'Illuminate\Http\Request')
@extends('layouts.admin')
 <?php //$per = PermissionHelper::getUserPermissions();?> 
@section('breadcrumbs')
    <section class="content-header" style="padding: 10px 15px !important;">
        <h1>Projects</h1>
    </section>
        {{csrf_field()}}

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-list"></i><h3 class="box-title">List</h3>
            
                <a href="{{ route('admin.projects.create') }}" class="btn btn-success pull-right">Add New Project</a>
            
        </div>

        <!-- /.box-header -->
        <div class="panel-body pad table-responsive">
            <table class="table table-bordered table-striped {{ $Projects ? 'datatable' : '' }}">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Days</th>
                    <th>Director</th>
                    <th>Producer</th>
                    <th>Location</th>
                    <th>Created By</th>
                    <th>Create At</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @if($Projects)
                <?php $sr = 1;?>
                    @foreach($Projects as $Project)
                        <tr data-entry-id="{{ $Project->id }}">
                            <td>{{ $sr }}</td>
                            <td>
                                <a href="{{ route('admin.projects.show',[$Project->id]) }}" class="btn btn-xs btn-info">{{ $Project->name }}</a>
                            </td>
                            <td>{{ $Project->days_of_shooting }}</td>
                            <td>{{ $Project->director }}</td>
                            <td>{{ $Project->producer }}</td>
                            <td>{{ $Project->location_info }}</td>
                            <td>{{ $Project->user_name->name }}</td>
                            <td>{{ $Project->created_at }}</td>
                            <td>
                                @if($user->name !='Admin')
                                    @if(in_array('projects_edit',explode(",",$perm[$userProjects[$Project->id] ]) ))
                                        <a href="{{ route('admin.projects.edit',[$Project->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>

                                    @endif
                                @else
                                    <a href="{{ route('admin.projects.edit',[$Project->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>

                                @endif

                                 <a href="{{ route('admin.projects.schedule',[$Project->id]) }}" class="btn btn-xs btn-info">Add Schedule</a>

                                    <button id="recce_btn-{{$Project->id}}" onclick="openRecceModal({{$Project->id}}, {{$Project}});"  type="button" class="btn  btn-info btn-sm">Shooting Recce</button>
                                    <a href="{{ route('admin.projects.recce',[$Project->id]) }}" class="btn btn-xs btn-info">View Recce Detail</a>
                            </td>
                            
                        </tr>
                         <?php $sr++; ?>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>


<!-- Modal -->
<div id="recceModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width : 80%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="recceModalHeader">Recce of Project</h4>
            </div>
            <div class="modal-body" id = "recce_modal">

                <!-- form start -->
                {!! Form::model($Project, ['method' => 'post', 'id' => 'validation-form', 'enctype' => 'multipart/form-data','route' => ['admin.projects.reccedata', $Project->id ] ]) !!}

                {{ Form::hidden('project_id', $Project->id, ['id' =>"project_id"]) }}

                <div class="box-body">
                    @include('admin.projects.recce_fields')
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
                </div>

                {!! Form::close() !!}
                @include('admin.projects.recce_items_template')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@stop

@section('javascript') 
    <script>
        $(document).ready(function(){
            console.log()
        });
        var num_of_days_global = 0;
        function openRecceModal(project_id,project){
            console.log(project_id,project);
            num_of_days_global =project.days_of_shooting;
            $('#recceModal').modal('show');
            $('#recce_line_item-global_counter').val(0);
            $('#recce-table tbody').html('');
            loadRecceData( project_id);
            $('#project_id').val(project_id);
            $("#recceModalHeader").text("Recce of  "+project.name);


        }

        var createRecceLineItem =  function(){
            console.log('numOfDays : ', num_of_days_global);
            var options = '<option> Select Day</option>';
            for(var i=1; i <= num_of_days_global; i++){
                options +='<option value="'+ i +'">'+ i +'</option>';
            }

            var global_counter = parseInt($('#recce_line_item-global_counter').val()) + 1;
            var recce_line_item = $('#recce_line_item-container').html().replace(/########/g, '').replace(/######/g, global_counter);

            $('#recce-table tbody').append(recce_line_item);
            $('#recce_line_item-day-'+global_counter).html(options);
            $('#recce_line_item-global_counter').val(global_counter)
        }

        var destroyRecceLineItem = function (itemId) {
            var r = confirm("Are you sure to delete Line Item?");
            if (r == true) {

                $('#recce_line_item-'+itemId).remove();
            }
        }


        var loadRecceData= function( project_id){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('admin.projects.get_recce_data'),
                type: 'POST',
                data: {
                    project_id: project_id,


                },
                // success: function( data, textStatus, jQxhr ){
                success: function( data){
                    console.log('data : ', data);
                     if(data.length>0){
                        appendRecceData( data);
                    }

                    // if(data.status){
                    //     alert('Data saved');
                    // }else{
                    //     alert('Something  went wrong!');
                    // }
                }

            });

        }

        var appendRecceData =  function(recceData){
            var htmlData = '';
            console.log('num_of_days_global : ' , num_of_days_global, recceData);
            var base =window.location.origin;
            for(var i=1; i<= recceData.length; i++){
                htmlData += '<tr id="recce_line_item-'+i+'"><td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData += '<select id="recce_line_item-day-'+ i + '" class="form-control" name="recce_line_items[day_no]['+i+'][]" multiple="multiple">';
                // htmlData += '';
                var selected = '';

                for(var j=1; j<= num_of_days_global; j++){
                    selected = '';

                    if(jQuery.inArray(j.toString() , recceData[i-1].day_no.split(',')) != -1) {

                        selected = 'selected';
                    }
//
                    htmlData += '<option value="'+ j +'" '+ selected +'>'+ j +'</option>';
                }

                htmlData += '</select>';
                htmlData +='</div></div></td>';

                htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData +='<input id="recce_line_item-duration-'+i+'" value="'+recceData[i-1].duration+'" class="form-control" placeholder="" maxlength="50" required="" name="recce_line_items[duration]['+i+']" type="number">';
                htmlData +='</div></div></td>';

                htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData +='<input id="recce_line_item-scene-'+i+'" value="'+recceData[i-1].scene+'" class="form-control" placeholder="" maxlength="50" required="" name="recce_line_items[scene]['+i+']" type="text">';
                htmlData +='</div></div></td>';

                htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData +='<input id="recce_line_item-location-'+i+'" value="'+recceData[i-1].location+'" class="form-control" placeholder="" maxlength="50" required="" name="recce_line_items[location]['+i+']" type="text">';
                htmlData +='</div></div></td>';


                htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData +='<input id="recce_line_item-camera-'+i+'" value="'+recceData[i-1].camera+'" class="form-control" placeholder="" maxlength="50" required="" name="recce_line_items[camera]['+i+']" type="text">';
                htmlData +='</div></div></td>';

                htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData +='<input id="recce_line_item-cast-'+i+'" value="'+recceData[i-1].cast+'" class="form-control" placeholder="" maxlength="50" required="" name="recce_line_items[cast]['+i+']" type="text">';
                htmlData +='</div></div></td>';

                htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData +='<input id="recce_line_item-art-'+i+'" value="'+recceData[i-1].art+'" class="form-control" placeholder="" maxlength="50" required="" name="recce_line_items[art]['+i+']" type="text">';
                htmlData +='</div></div></td>';

                htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData +='<input id="recce_line_item-short_desc-'+i+'"  value="'+recceData[i-1].short_desc+'" class="form-control" placeholder="" maxlength="50" required="" name="recce_line_items[short_desc]['+i+']" type="text">';
                htmlData +='</div></div></td>';


                htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData +='<input id="recce_line_item-screen_notes-'+i+'"  value="'+recceData[i-1].screen_notes+'" class="form-control" placeholder="" maxlength="50" required="" name="recce_line_items[screen_notes]['+i+']" type="text">';
                htmlData +='</div></div></td>';


                htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
                htmlData +='<a href="'+base+'/'+recceData[i-1].image+'" target="_blank"> <img src="'+base+'/'+recceData[i-1].image+'" height="42" width="43"> </a>';
                htmlData +='<input id="recce_line_item-file_location-'+i+'"   name="recce_line_items[file_location]['+i+']" type="hidden" value="'+recceData[i-1].image+'">';

                htmlData +='</div></div></td>';

                htmlData +='<td><button id="recce_line_item-del_btn-'+i+'" onclick="destroyRecceLineItem('+i+');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>';
                htmlData +='</tr>';
            }

            $('#recce-table tbody').html(htmlData);
            $('#recce_line_item-global_counter').val(i)

        }
    </script>
@endsection