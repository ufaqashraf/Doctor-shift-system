<table style="display: none;">
    <tbody id="line_item-container" >
    <tr id="line_item-######">
        <td >
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                {!! Form::text('line_items[full_name][######]', old('full_name'),
                ['id' => 'line_item-full_name-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50', 'required' => true]) !!}
                    
                </div>
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

               {!! Form::text('line_items[relationship][######]', old('relationship'),
                ['id' => 'line_item-relationship-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

               {!! Form::text('line_items[company][######]', old('company'),
                ['id' => 'line_item-company-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('line_items[contact_no][######]', old('contact_no'),
                ['id' => 'line_item-contact_no-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >
            {!! Form::text('line_items[residentional_address][######]', old('residentional_address'),
                ['id' => 'line_item-residentional_address-######','class' => 'form-control ', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td><button id="line_item-del_btn-######" onclick="FormControls.destroyLineItem('######');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
    </tr>
    </tbody>
</table>