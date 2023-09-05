<div class="form-group  col-md-3 @if($errors->has('date_of_resign')) has-error @endif">
    {!! Form::label('date_of_resign', 'Resignation Date', ['class' => 'control-label']) !!}
    {!! Form::text('date_of_resign', old('date_of_resign'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
@if($errors->has('date_of_resign'))
        <span class="help-block">
            {{ $errors->first('date_of_resign') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-6 @if($errors->has('termination_reason')) has-error @endif">
    {!! Form::label('termination_reason', 'Termination Reason', ['class' => 'control-label']) !!}
    {!! Form::textarea('termination_reason', old('termination_reason'), ['class' => 'form-control', 'placeholder' => '', 'maxlength'=>'200']) !!}
    @if($errors->has('termination_reason'))
        <span class="help-block">
            {{ $errors->first('termination_reason') }}
        </span>
    @endif
</div>