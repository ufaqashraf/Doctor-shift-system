
<div class="row">
    <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
        {!! Form::text('name', old('name'), ['class' => 'form-control','maxlength' => 40 , 'data-parsley-required' => 'true']) !!}
        @if($errors->has('name'))
            <span class="help-block">
                {{ $errors->first('name') }}
            </span>
        @endif
    </div>
    <div class="form-group col-md-4 @if($errors->has('start_date')) has-error @endif">
        {!! Form::label('start_date', 'Start Date*', ['class' => 'control-label']) !!}
        {!! Form::text('start_date', old('start_date'), ['id' => 'start_date', 'class' => 'form-control datepicker', 'data-parsley-required' => 'true']) !!}
        @if($errors->has('start_date'))
            <span class="help-block">
                {{ $errors->first('start_date') }}
            </span>
        @endif
    </div>
    <div class="form-group col-md-4 @if($errors->has('end_date')) has-error @endif">
        {!! Form::label('end_date', 'End Date*', ['class' => 'control-label']) !!}
        {!! Form::text('end_date', old('end_date'), ['readonly' => 'true', 'class' => 'form-control datepicker']) !!}
        @if($errors->has('end_date'))
            <span class="help-block">
                {{ $errors->first('end_date') }}
            </span>
        @endif
    </div>
    {!! Form::hidden('id', old('id')) !!}
</div>