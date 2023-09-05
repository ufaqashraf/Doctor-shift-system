<table style="display: none;">
    <tbody id="line_item-container" >
    <tr id="line_item-######">
        <td>
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                    {!! Form::select('line_items[grade_id][######]', $grades, old('grade_id'),
                    ['id' => 'line_item-grade_id-######','class' => 'form-control', 'required' => true]) !!}

                </div>
            </div>
        </td>
        <td >
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                    {!! Form::text('line_items[rate][######]' , old('rate'),
                    ['id' => 'line_item-rate_desc-######','class' => 'form-control', 'required' => true]) !!}

                </div>
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                    {!! Form::time('line_items[time_from][######]' , old('time_from'),
                    ['id' => 'line_item-time_from-######','class' => 'form-control', 'required' => true]) !!}

                </div>
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                    {!! Form::time('line_items[time_to][######]' , old('time_to'),
                    ['id' => 'line_item-time_to-######','class' => 'form-control', 'required' => true]) !!}

                </div>
            </div>
        </td>

        {{--<td><button id="line_item-del_btn-######" onclick="FormControls.destroyLineItem('######');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>--}}
    </tr>
    </tbody>
</table>



<table style="display: none;">
    <tbody id="other_line_item-container" >
    <tr id="other_line_item-######">
        <td>
        </td>
        <td >
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                    {!! Form::text('other_line_items[rate][######]' , old('rate'),
                    ['id' => 'other_line_item-rate_desc-######','class' => 'form-control', 'required' => true]) !!}

                </div>
            </div>
        </td>
        <td>

        </td>


        <td>

        </td>

        <td>
            <div class="form-group" style="margin-bottom: 0px !important;">
                <div class="form-group" style="margin-bottom: 0px !important;">
                    {!! Form::text('other_line_items[time_to][######]' , old('time_to'),
                    ['id' => 'other_line_item-time_to-######','class' => 'form-control', 'required' => true]) !!}

                </div>
            </div>
        </td>

        {{--<td><button id="line_item-del_btn-######" onclick="FormControls.destroyLineItem('######');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>--}}
    </tr>
    </tbody>
</table>


@section('jsscript')
    <script src="{{ url('public/js/admin/job/create.js') }}" type="text/javascript"></script>
@endsection