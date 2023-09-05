<table style="display: none;">
    <tbody id="line_item-container" >
    <tr id="line_item-######">
        <td class="col-md-1">
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                {!! Form::number('line_items[sr_no][######]', old('sr_no'),
                ['id' => 'line_item-sr_no-######','class' => 'form-control', 'placeholder' => '','readonly' => 'true' ,'maxlength'=>'50', 'required' => true]) !!}
                    
                </div>
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;">
                {!! Form::select('line_items[document_type][######]', $EmployeeDocumentTypes->prepend('Select a Type', '') , old('document_type'),
                ['class' => 'form-control' ,'id' => 'line_item-document_type-######', 'required'=>true]) !!}
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;" >

               {!! Form::text('line_items[name][######]', old('name'),
                ['id' => 'line_item-name-######','class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
            </div>
        </td>

        <td>
            {!! Form::file('line_items[file_location][######]', ['class' => 'form-control', 'id' => 'line_item-file_location-######']) !!}
        </td>

        <td><button id="line_item-del_btn-######" onclick="FormControls.destroyLineItem('######');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
    </tr>
    </tbody>
</table>