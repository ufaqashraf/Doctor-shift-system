<table style="display: none;">
    <tbody id="cast_line_item-container" >
    <tr id="cast_line_item-######">
      <!--   <td class="col-md-1">
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                {!! Form::number('cast_line_items[sr_no][######]', old('sr_no'),
                ['id' => 'cast_line_item-sr_no-######','class' => 'form-control', 'placeholder' => '','readonly' => 'true' ,'maxlength'=>'50', 'required' => true]) !!}
                    
                </div>
            </div>
        </td> -->
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;">
                {!! Form::text('cast_line_items[name][######]', old('name'), ['id' => 'cast_line_item-name-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
               {!! Form::text('cast_line_items[artist_name][######]', old('artist_name'), ['id' => 'cast_line_item-artist_name-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>
       
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
               {!! Form::time('cast_line_items[call_time][######]', old('call_time'), ['id' => 'cast_line_item-call_time-######','class' => 'form-control', 'placeholder' => '' ]) !!}
            </div>
        </td>
         <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
               {!! Form::time('cast_line_items[call_to][######]', old('call_to'), ['id' => 'cast_line_item-call_to-######','class' => 'form-control', 'placeholder' => '' ]) !!}
            </div>
        </td>
         <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
               {!! Form::text('cast_line_items[s_by][######]', old('s_by'), ['id' => 'cast_line_item-s_by-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'100']) !!}
            </div>
        </td>
         <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
               {!! Form::text('cast_line_items[screen_notes][######]', old('screen_notes'), ['id' => 'cast_line_item-screen_notes-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'100']) !!}
            </div>
        </td>

        <td><button id="cast_line_item-del_btn-######" onclick="FormControls.destroyCastLineItem('######');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
    </tr>
    </tbody>
</table>