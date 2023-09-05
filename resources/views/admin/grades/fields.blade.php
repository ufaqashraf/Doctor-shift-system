<div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Title*', ['class' => 'control-label']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
    @if($errors->has('name'))
        <span class="help-block">
            {{ $errors->first('name') }}
        </span>
    @endif
</div>
