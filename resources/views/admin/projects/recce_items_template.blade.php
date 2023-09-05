<table style="display: none;">
    <tbody id="recce_line_item-container" >
    <tr id="recce_line_item-######">

        <td >
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">

                    {!! Form::select('recce_line_items[day_no][######][]',  array('') , old('day'), ['id' => 'recce_line_item-day-######','class' => 'form-control', 'required' => true,'multiple'=>'multiple']) !!}

                </div>
            </div>
        </td>

        <td >
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                {!! Form::number('recce_line_items[duration][######]', old('duration'),
                ['id' => 'recce_line_item-duration-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50', 'required' => true]) !!}
                    
                </div>
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

               {!! Form::text('recce_line_items[scene][######]', old('scene'),
                ['id' => 'recce_line_item-scene-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

                {!! Form::text('recce_line_items[location][######]', old('location'),
                 ['id' => 'recce_line_item-location-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'100']) !!}
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('recce_line_items[camera][######]', old('camera'),
                ['id' => 'recce_line_item-camera-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('recce_line_items[cast][######]', old('cast'),
                ['id' => 'recce_line_item-cast-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>



        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('recce_line_items[art][######]', old('art'),
                ['id' => 'recce_line_item-art-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>


        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('recce_line_items[short_desc][######]', old('short_desc'),
                ['id' => 'recce_line_item-short_desc-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

         <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('recce_line_items[screen_notes][######]', old('screen_notes'),
                ['id' => 'recce_line_item-screen_notes-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            {!! Form::file('recce_line_items[file_location][######]', ['class' => 'form-control', 'id' => 'recce_line_item-file_location-######']) !!}
        </td>


        <td><button id="recce_line_item-del_btn-######" onclick="destroyRecceLineItem('######');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
    </tr>
    </tbody>
</table>