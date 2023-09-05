<table style="display: none;">
    <tbody id="unit_line_item-container" >
    <tr id="unit_line_item-######">
        <td >
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">

                    {!! Form::select('unit_line_items[unit_type][######]',  $Unittype , old('unit_type'), ['id' => 'unit_line_item-unit_type_id-######','class' => 'form-control', 'required' => true]) !!}

                    
                </div>
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

               {!! Form::time('unit_line_items[time][######]', old('time'),
                ['id' => 'unit_line_item-time-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>
       
      

        <td><button id="unit_line_item-del_btn-######" onclick="FormControls.destroyLineItem('######');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
    </tr>
    </tbody>
</table>