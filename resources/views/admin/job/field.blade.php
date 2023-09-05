@inject('request', 'Illuminate\Http\Request')
                            <div class="form-group  col-md-3 @if($errors->has('title')) has-error @endif">
                                {!! Form::label('title', 'Job title*', ['class' => 'control-label']) !!}
                                {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                @if($errors->has('title'))
                                    <span class="help-block">
                                        {{ $errors->first('title') }}
                                    </span>
                                @endif
                                                
                            </div>

                            <div class="form-group  col-md-3 @if($errors->has('date')) has-error @endif">
                                {!! Form::label('date', 'Date*', ['class' => 'control-label']) !!}
                                {!! Form::text('date', $job_date, ['class' => 'form-control datepicker','placeholder' => '']) !!}
                                @if($errors->has('date'))
                                    <span class="help-block">
                                        {{ $errors->first('date') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group  col-md-3 @if($errors->has('time_from')) has-error @endif">
                                {!! Form::label('time_from', 'Start Time *', ['class' => 'control-label']) !!}
                                {!! Form::time('time_from', '08:00' , ['class' => 'form-control', 'placeholder' => '']) !!}
                                @if($errors->has('time_from'))
                                    <span class="help-block">
                                        {{ $errors->first('time_from') }}
                                    </span>
                                @endif
                                            
                            </div>
                            <div class="form-group  col-md-3 @if($errors->has('time_to')) has-error @endif">
                                {!! Form::label('time_to', 'End Time*', ['class' => 'control-label']) !!}
                                {!! Form::time('time_to', '16:30' , ['class' => 'form-control', 'placeholder' => '']) !!}
                                @if($errors->has('time_to'))
                                    <span class="help-block">
                                        {{ $errors->first('time_to') }}
                                    </span>
                                @endif
                                            
                            </div>

                            <div class="form-group  col-md-3 @if($errors->has('num_of_grades')) has-error @endif">
                                {!! Form::label('num_of_grades', 'Grades*', ['class' => 'control-label']) !!}
                                @if($request->segment(4) == 'edit')
                                {!! Form::number('num_of_grades', old('num_of_grades'), ['id'=>'appendFields','class' => 'form-control','placeholder' => '', 'readonly']) !!}
                                @else
                                {!! Form::number('num_of_grades', old('num_of_grades'), ['id'=>'appendFields','class' => 'form-control', 'onchange'=>'FormControls.createLineItem()',
                                'onkeyup'=>'FormControls.createLineItem()', 'placeholder' => '']) !!}
                                @endif

                                @if($errors->has('num_of_grades'))
                                    <span class="help-block">
                                        {{ $errors->first('num_of_grades') }}
                                    </span>
                                @endif
                                            
                            </div>


                            <div class="form-group  col-md-6 @if($errors->has('description')) has-error @endif">
                                {!! Form::label('description', 'Description*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => '' , 'rows' => 3, 'cols' => 10]) !!}
                                @if($errors->has('description'))
                                    <span class="help-block">
                                                                    {{ $errors->first('description') }}
                                                                </span>
                                @endif

                            </div>
                            <div id= 'user_tbl' class="form-group  col-md-3 @if($errors->has('hospital_id')) has-error @endif">
                                
                                                
                            </div>
                            <div>
{{--                                @include('Admin\job\job_info')--}}
                        </div>
                </div>
                            @include('admin.job.job_info')
            </div>
@section('jsscript')
<script src="{{ url('public/js/admin/job/create.js') }}" type="text/javascript"></script>
@endsection


