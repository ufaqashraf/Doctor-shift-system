<table style="display: none;">
    <tbody id="schedule_line_item-container" >
    <tr id="schedule_line_item-######">
        <td >
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                {!! Form::text('schedule_line_items[duration][######]', old('duration'),
                ['id' => 'schedule_line_item-duration-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50', 'required' => true]) !!}
                    
                </div>
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

               {!! Form::text('schedule_line_items[scene][######]', old('scene'),
                ['id' => 'schedule_line_item-scene-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('schedule_line_items[camera][######]', old('camera'),
                ['id' => 'schedule_line_item-camera-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('schedule_line_items[cast][######]', old('cast'),
                ['id' => 'schedule_line_item-cast-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>



        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('schedule_line_items[art][######]', old('art'),
                ['id' => 'schedule_line_item-art-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>


        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('schedule_line_items[short_desc][######]', old('short_desc'),
                ['id' => 'schedule_line_item-short_desc-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

         <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('schedule_line_items[screen_notes][######]', old('screen_notes'),
                ['id' => 'schedule_line_item-screen_notes-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            {!! Form::file('schedule_line_items[file_location][######]', ['class' => 'form-control', 'id' => 'schedule_line_item-file_location-######']) !!}
        </td>


        <td><button id="schedule_line_item-del_btn-######" onclick="FormControls.destroyScheduleLineItem('######');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
    </tr>
    </tbody>
</table>