<meta name="csrf-token" content="{{ csrf_token() }}">
<input type="hidden" name="days_of_shooting" id="days_of_shooting"  value="{{$Project->days_of_shooting}}">
<table class="table table-bordered table-striped {{ count($ShootingSchedule) > 0 ? 'datatable' : '' }} " id="shooting-days">
    <thead>
        <tr>
                <th>Day</th>
                <th>Date</th>
                <th>Main Unit</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Est wrap</th>
                <th>Action</th>                
        </tr>
    </thead>
    <tbody>

        @for($day =1; $day<= $Project->days_of_shooting; $day++ )

        <tr id="line_item-{{$day}}" >
                            <td> 
                                <div class="form-group  @if($errors->has('unit_type')) has-error @endif">

                                    {!! Form::text('day_items[day_no]['.$day.']', $day, ['id' => 'day_item-day_no-'.$day.'','class' => 'form-control', 'required' => true, 'readonly' => true ]) !!}
                                    @if($errors->has('unit_type'))
                                        <span class="help-block">
                                            {{ $errors->first('unit_type') }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td> 
                                <div class="form-group  @if($errors->has('time')) has-error @endif">

                                    {!! Form::text('day_items[day_date]['.$day.']', isset($days_info[$day])? $days_info[$day]->day_date : '', ['id' => 'day_item-day_date-'.$day.'','class' => 'form-control datepicker ' ]) !!}
                                    @if($errors->has('day_date'))
                                        <span class="help-block">
                                            {{ $errors->first('day_date') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <div class="form-group  @if($errors->has('unit_type')) has-error @endif">

                                    {!! Form::time('day_items[main_unit]['.$day.']', isset($days_info[$day])? $days_info[$day]->main_unit : '', ['id' => 'day_item-main_unit-'.$day.'','class' => 'form-control', 'required' => true ]) !!}
                                    @if($errors->has('main_unit'))
                                        <span class="help-block">
                                            {{ $errors->first('main_unit') }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td> 
                                <div class="form-group  @if($errors->has('time')) has-error @endif">

                                    {!! Form::time('day_items[break_fast]['.$day.']', isset($days_info[$day])? $days_info[$day]->break_fast : '', ['id' => 'day_item-break_fast-'.$day.'','class' => 'form-control' ]) !!}
                                    @if($errors->has('break_fast'))
                                        <span class="help-block">
                                            {{ $errors->first('break_fast') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <div class="form-group  @if($errors->has('lunch')) has-error @endif">

                                    {!! Form::time('day_items[lunch]['.$day.']', isset($days_info[$day])? $days_info[$day]->lunch : '', ['id' => 'day_item-lunch-'.$day.'','class' => 'form-control', 'required' => true ]) !!}
                                    @if($errors->has('lunch'))
                                        <span class="help-block">
                                            {{ $errors->first('lunch') }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td> 
                                <div class="form-group  @if($errors->has('time')) has-error @endif">

                                    {!! Form::time('day_items[dinner]['.$day.']', isset($days_info[$day])? $days_info[$day]->dinner : '', ['id' => 'day_item-dinner-'.$day.'','class' => 'form-control' ]) !!}
                                    @if($errors->has('dinner'))
                                        <span class="help-block">
                                            {{ $errors->first('dinner') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            
                            
                            
                            
                            <td>
                                <button id="save_info_btn-{{$day}}" onclick="FormControls.saveDayInfo('{{$day}}','{{$Project->id}}');" type="button" class="btn btn-block btn-success btn-sm">Save</button>
                            <div id="actionButtons-{{$day}}">
                                <button id="unit_calls_btn-{{$day}}" onclick="FormControls.openUnitModal('{{$day}}','{{$Project->id}}');" type="button" class="btn btn-block btn-danger btn-sm">Unit Calls</button>

                                <button id="cast_calls_btn-{{$day}}" onclick="FormControls.openCastModal('{{$day}}','{{$Project->id}}');" type="button" class="btn btn-block btn-warning btn-sm">Cast Calls</button>

                                <button id="schedule_btn-{{$day}}" onclick="FormControls.openScheduleModal('{{$day}}','{{$Project->id}}');" type="button" class="btn btn-block btn-info btn-sm">Shooting Schedule</button>
                            </div>

                            </td>

                        </tr>

        @endfor
    </tbody>
</table>



















<!-- <button onclick="FormControls.createLineItem();" type="button" style="margin-bottom: 5px;" class="btn pull-right btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i>&nbsp;Add <u>R</u>ow</button>
<table class="table table-bordered table-striped {{ count($ShootingSchedule) > 0 ? 'datatable' : '' }} " id="schedule-table">
    <thead>
        <tr>
                <th>Time Start</th>
                <th>Time End</th>
                <th>Scene</th>
                <th>Date</th>
                <th>Camera</th>
                <th>Cast</th>
                <th>Art</th>
                <th>Short Desc</th>
                <th>Notes</th>
                <th>Image</th>
                <th>Remove</th>

        </tr>
    </thead>
    <tbody>
            <?php  $counter=0 ?>
            @if(count($ShootingSchedule) )

                    @foreach ($ShootingSchedule as $key => $val)

                        <?php  $counter++ ?>
                        <tr id="line_item-{{$counter}}" >
                            <td> 
                                <div class="form-group  @if($errors->has('time_start')) has-error @endif">

                                    {!! Form::text('line_items[time_start]['.$counter.']', '0', ['id' => 'line_item-time_start_id-1','class' => 'form-control', 'required' => true ]) !!}
                                    @if($errors->has('time_start'))
                                        <span class="help-block">
                                            {{ $errors->first('time_start') }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td> 
                                <div class="form-group  @if($errors->has('time_end')) has-error @endif">

                                    {!! Form::text('line_items[time_end]['.$counter.']', '0', ['id' => 'line_item-time_end_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('time_end'))
                                        <span class="help-block">
                                            {{ $errors->first('time_end') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <div class="form-group  @if($errors->has('scene')) has-error @endif">

                                    {!! Form::text('line_items[scene]['.$counter.']', $val->scene, ['id' => 'line_item-scene_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('scene'))
                                        <span class="help-block">
                                            {{ $errors->first('scene') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <div class="form-group  @if($errors->has('sc_date')) has-error @endif">

                                    {!! Form::text('line_items[sc_date]['.$counter.']', $val->sc_date, ['id' => 'line_item-sc_date_id-1','class' => 'form-control datepicker' ]) !!}
                                    @if($errors->has('sc_date'))
                                        <span class="help-block">
                                            {{ $errors->first('sc_date') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <div class="form-group  @if($errors->has('camera')) has-error @endif">

                                    {!! Form::text('line_items[camera]['.$counter.']', $val->camera, ['id' => 'line_item-camera_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('camera'))
                                        <span class="help-block">
                                            {{ $errors->first('camera') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                             <td> 
                                <div class="form-group  @if($errors->has('cast')) has-error @endif">

                                    {!! Form::text('line_items[cast]['.$counter.']', $val->cast, ['id' => 'line_item-cast_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('cast'))
                                        <span class="help-block">
                                            {{ $errors->first('cast') }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                             <td> 
                                <div class="form-group  @if($errors->has('art')) has-error @endif">

                                    {!! Form::text('line_items[art]['.$counter.']', $val->art, ['id' => 'line_item-art_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('art'))
                                        <span class="help-block">
                                            {{ $errors->first('art') }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                             <td> 
                                <div class="form-group  @if($errors->has('short_desc')) has-error @endif">

                                    {!! Form::text('line_items[short_desc]['.$counter.']', $val->short_desc, ['id' => 'line_item-short_desc_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('short_desc'))
                                        <span class="help-block">
                                            {{ $errors->first('short_desc') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <div class="form-group  @if($errors->has('screen_notes')) has-error @endif">

                                    {!! Form::text('line_items[screen_notes]['.$counter.']', $val->screen_notes, ['id' => 'line_item-screen_notes_id-1','class' => 'form-control' ]) !!}
                                    @if($errors->has('screen_notes'))
                                        <span class="help-block">
                                            {{ $errors->first('screen_notes') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            
                            <td>

                                <a id="line_item-view_btn-{{$counter}}" href="../../../{{$val->image}}" class="btn btn-block btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            </td>

                            <td><button id="line_item-del_btn-{{$counter}}" onclick="FormControls.destroyLineItem('{{$counter}}');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>

                        </tr>

                    @endforeach
            @else

            @endif
            <input type="hidden" id="line_item-global_counter" value="<?php  echo ++$counter ?>"   />

    </tbody>

</table> -->