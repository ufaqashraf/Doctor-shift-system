<button onclick="FormControls.createLineItem();" type="button" style="margin-bottom: 5px;" class="btn pull-right btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i>&nbsp;Add <u>R</u>ow</button>
<table class="table table-bordered table-striped {{ count($EmpEduList) > 0 ? 'datatable' : '' }} " id="edu-history-table">
    <thead>
        <tr>
                <th>Full Name</th>
                <th>Relationship</th>
                <th>Company</th>
                <th>Contact No.</th>
                <th>Residentional Address</th>
                <th>Remove</th>

        </tr>
    </thead>
    <tbody>
            <?php  $counter=0 ?>
            @if(count($EmpEduList) )

                    @foreach ($EmpEduList as $key => $val)

                        <?php  $counter++ ?>
                        <tr id="line_item-{{$counter}}" >
                            <td> 
                                <div class="form-group  @if($errors->has('full_name')) has-error @endif">

                                    {!! Form::text('line_items[full_name]['.$counter.']', $val->full_name, ['id' => 'line_item-full_name_id-1','class' => 'form-control', 'required' => true ]) !!}
                                    @if($errors->has('full_name'))
                                        <span class="help-block">
                                            {{ $errors->first('full_name') }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td> 
                                <div class="form-group  @if($errors->has('relationship')) has-error @endif">

                                    {!! Form::text('line_items[relationship]['.$counter.']', $val->relationship, ['id' => 'line_item-relationship_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('relationship'))
                                        <span class="help-block">
                                            {{ $errors->first('relationship') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <div class="form-group  @if($errors->has('company')) has-error @endif">

                                    {!! Form::text('line_items[company]['.$counter.']', $val->company, ['id' => 'line_item-company_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('company'))
                                        <span class="help-block">
                                            {{ $errors->first('company') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <div class="form-group  @if($errors->has('contact_no')) has-error @endif">

                                    {!! Form::text('line_items[contact_no]['.$counter.']', $val->contact_no, ['id' => 'line_item-contact_no_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('contact_no'))
                                        <span class="help-block">
                                            {{ $errors->first('contact_no') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <div class="form-group  @if($errors->has('residentional_address')) has-error @endif">

                                    {!! Form::text('line_items[residentional_address]['.$counter.']', $val->residentional_address, ['id' => 'line_item-residentional_address_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('residentional_address'))
                                        <span class="help-block">
                                            {{ $errors->first('residentional_address') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            
                            <td><button id="line_item-del_btn-{{$counter}}" onclick="FormControls.destroyLineItem('{{$counter}}');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>

                        </tr>

                    @endforeach
            @else

            @endif
            <input type="hidden" id="line_item-global_counter" value="<?php  echo ++$counter ?>"   />

    </tbody>

</table>