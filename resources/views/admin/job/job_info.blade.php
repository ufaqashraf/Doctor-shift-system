
<table class="table table-bordered t table-responsive {{ isset ($EmpEduList) &&  count($EmpEduList) > 0 ? 'datatable' : '' }} " id="edu-history-table">
    <thead>
    <tr>

        <th width='30%'>Grade</th>
        <th >Rate (£)</th>

        <th>Time From</th>
        <th>Time To</th>
    </tr>
    </thead>
    <tbody>
    <?php  $counter=0 ?>
    @if(isset ($Jobdetail) && count($Jobdetail) )

        @foreach ($Jobdetail as $key => $val)

            <?php  $counter++; ?>
            <tr id="line_item-{{$counter}}" >


                <td>
                    <div class="form-group  @if($errors->has('grade_id')) has-error @endif">
                        {{ Form::hidden('line_items[db_id]['.$counter.']', $val->id) }}
                        {!! Form::select('line_items[grade_id]['.$counter.']', $grades , $val->grade_id, ['id' => 'line_item-category_id-1','class' => 'form-control']) !!}
                        @if($errors->has('grade_id'))
                            <span class="help-block">
                                            {{ $errors->first('grade_id') }}
                                        </span>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="form-group  @if($errors->has('rate')) has-error @endif">

                        {!! Form::text('line_items[rate]['.$counter.']', $val->rate, ['id' => 'line_item-rate_desc_id-1','class' => 'form-control ']) !!}
                        @if($errors->has('rate'))
                            <span class="help-block">
                                {{ $errors->first('rate') }}
                            </span>
                        @endif
                    </div>
                </td>

                <td>
                    <div class="form-group  @if($errors->has('vacancies')) has-error @endif">

                        {!! Form::time('line_items[time_from]['.$counter.']', $val->time_from, ['id' => 'line_item-time_from_id-1','class' => 'form-control ']) !!}
                        @if($errors->has('vacancies'))
                            <span class="help-block">
                                            {{ $errors->first('vacancies') }}
                                        </span>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="form-group  @if($errors->has('vacancies')) has-error @endif">

                        {!! Form::time('line_items[time_to]['.$counter.']', $val->time_to, ['id' => 'line_item-time_to_id-1','class' => 'form-control ']) !!}
                        @if($errors->has('time_to'))
                            <span class="help-block">
                                            {{ $errors->first('time_to') }}
                                        </span>
                        @endif
                    </div>
                </td>


                {{--@include('Admin\job\job_info')--}}


                {{--<td><button id="line_item-del_btn-{{$counter}}" onclick="FormControls.destroyLineItem('{{$counter}}');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>--}}

            </tr>

        @endforeach
    @else

    @endif
    <input type="hidden" id="line_item-global_counter" value="<?php  echo ++$counter ?>"   />

    </tbody>

</table>