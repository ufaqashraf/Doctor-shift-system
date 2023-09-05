<button onclick="FormControls.createLineItem();" type="button" style="margin-bottom: 5px;" class="btn pull-right btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i>&nbsp;Add <u>R</u>ow</button>
<table class="table table-bordered table-striped {{ count($EmpDocuments) > 0 ? 'datatable' : '' }} " id="document-table">
    <thead>
        <tr>
                <th>Sr:No</th>
                <th>Document Type</th>
                <th>Document Name</th>
                <th>View</th>
                <th>Remove</th>

        </tr>
    </thead>
    <tbody>
            <?php  $counter=0; ?>
            @if(count($EmpDocuments) )

                    @foreach ($EmpDocuments as $key => $val)

                        <?php  $counter++; ?>
                        <tr id="line_item-{{$counter}}" >
                            <td>{!! Form::number('line_items[sr_no]['.$counter.']', $counter, ['id' => 'line_item-sr_no-######','class' => 'form-control', 'placeholder' => '','readonly' => 'true' ,'maxlength'=>'50', 'required' => true]) !!}</td>
                            <td>
                                <div class="form-group  @if($errors->has('document_type')) has-error @endif">

                                    {!! Form::select('line_items[document_type]['.$counter.']', $EmployeeDocumentTypes->prepend('Select a Type', '') , $val->document_type, ['class' => 'form-control' ,'id' => 'line_item-document_type-######', 'required'=>true]) !!}
                                    @if($errors->has('document_type'))
                                        <span class="help-block">
                                            {{ $errors->first('document_type') }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td> 
                                <div class="form-group  @if($errors->has('name')) has-error @endif">

                                    {!! Form::text('line_items[name]['.$counter.']', $val->name, ['id' => 'line_item-name-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <?php $val->file_location = str_replace('/home/netrootserp/tuv.netrootserp.com/', '', $val->file_location) ?>
                                {!! Form::hidden('line_items[file_location]['.$counter.']', $val->file_location, ['id' => 'line_item-file_location-1','class' => 'form-control' ]) !!}
                                <a id="line_item-view_btn-{{$counter}}" href="../../../{{$val->file_location}}" class="btn btn-block btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            </td>
                            
                            <td><button id="line_item-del_btn-{{$counter}}" onclick="FormControls.destroyLineItem('{{$counter}}');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>

                        </tr>

                    @endforeach
            @else

            @endif
            <input type="hidden" id="line_item-global_counter" value="<?php  echo ++$counter ?>"   />

    </tbody>

</table>