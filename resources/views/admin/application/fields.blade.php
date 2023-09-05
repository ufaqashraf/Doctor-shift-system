<div class="form-group col-md-4 @if($errors->has('title')) has-error @endif">
    {!! Form::label('title', 'Title*', ['class' => 'control-label']) !!}
    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
    @if($errors->has('title'))
        <span class="help-block">
            {{ $errors->first('title') }}
        </span>
    @endif
</div>
<div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
    @if($errors->has('name'))
        <span class="help-block">
            {{ $errors->first('name') }}
        </span>
    @endif
</div>
<div class="form-group col-md-4 @if($errors->has('parent_id')) has-error @endif">
    {!! Form::label('parent_id', 'Parent*', ['class' => 'control-label']) !!}
    {!! Form::select('parent_id', $Permissions, old('parent_id'), ['class' => 'form-control select2']) !!}
    <span id="parent_id_handler"></span>
    @if($errors->has('parent_id'))
        <span class="help-block">
            {{ $errors->first('parent_id') }}
        </span>
    @endif
</div>