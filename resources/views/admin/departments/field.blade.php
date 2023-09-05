
<div class="form-group  col-md-3 @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Department name*', ['class' => 'control-label']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('name'))
        <span class="help-block">
                        {{ $errors->first('name') }}
                    </span>
    @endif

</div>


