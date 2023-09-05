<div class="form-group  col-md-3 @if($errors->has('name')) has-error @endif">
                                {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                                                
                            </div>
                            <div class="form-group  col-md-3 @if($errors->has('time_to')) has-error @endif">
                                {!! Form::label('time_to', 'Start time*', ['class' => 'control-label']) !!}
                                {!! Form::time('time_to', old('time_to'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                @if($errors->has('time_to'))
                                    <span class="help-block">
                                        {{ $errors->first('time_to') }}
                                    </span>
                                @endif
                                            
                            </div>
                            <div class="form-group  col-md-3 @if($errors->has('time_from')) has-error @endif">
                                {!! Form::label('time_from', 'End time*', ['class' => 'control-label']) !!}
                                {!! Form::time('time_from', old('time_from'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                @if($errors->has('time_from'))
                                    <span class="help-block">
                                        {{ $errors->first('time_from') }}
                                    </span>
                                @endif
                                            
                            </div>