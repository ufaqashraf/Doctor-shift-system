<table style="display: none;">
    <tbody id="line_item-container" >
    <tr id="line_item-######">
        <td >
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                {!! Form::text('line_items[time_start][######]', old('time_start'),
                ['id' => 'line_item-time_start-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50', 'required' => true]) !!}
                    
                </div>
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

               {!! Form::text('line_items[time_end][######]', old('time_end'),
                ['id' => 'line_item-time_end-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

               {!! Form::text('line_items[scene][######]', old('scene'),
                ['id' => 'line_item-scene-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

               {!! Form::text('line_items[sc_date][######]', old('sc_date'),
                ['id' => 'line_item-sc_date-######','class' => 'form-control datepicker', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('line_items[camera][######]', old('camera'),
                ['id' => 'line_item-camera-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('line_items[cast][######]', old('cast'),
                ['id' => 'line_item-cast-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>



        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('line_items[art][######]', old('art'),
                ['id' => 'line_item-art-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>


        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('line_items[short_desc][######]', old('short_desc'),
                ['id' => 'line_item-short_desc-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

         <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('line_items[screen_notes][######]', old('screen_notes'),
                ['id' => 'line_item-screen_notes-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            {!! Form::file('line_items[file_location][######]', ['class' => 'form-control', 'id' => 'line_item-file_location-######']) !!}
        </td>


        <td><button id="line_item-del_btn-######" onclick="FormControls.destroyLineItem('######');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
    </tr>
    </tbody>
</table>