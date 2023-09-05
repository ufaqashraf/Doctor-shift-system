
<div class="row">
    <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
        {!! Form::text('name', old('name'), ['class' => 'form-control','maxlength' => 40 ,'data-parsley-required' => 'true']) !!}
        @if($errors->has('name'))
            <span class="help-block">
                {{ $errors->first('name') }}
            </span>
        @endif
    </div>
    <div class="form-group col-md-4 @if($errors->has('address')) has-error @endif">
        {!! Form::label('address', 'Address*', ['class' => 'control-label']) !!}
        {!! Form::text('address', old('address'), ['id' => 'address', 'class' => 'form-control', 'data-parsley-required' => 'true']) !!}
        @if($errors->has('address'))
            <span class="help-block">
                {{ $errors->first('address') }}
            </span>
        @endif
    </div>
    <div class="form-group col-md-4 @if($errors->has('currency')) has-error @endif">
        {!! Form::label('currency', 'Currency*', ['class' => 'control-label']) !!}
        {!! Form::select('currency', array('' => 'Select Currency') + Config::get('support.currency_array'), old('type'), ['class' => 'form-control', 'data-parsley-required' => 'true']) !!}
        @if($errors->has('currency'))
            <span class="help-block">
                {{ $errors->first('currency') }}
            </span>
        @endif
    </div>
    <div class="form-group col-md-4 @if($errors->has('logo')) has-error @endif">
        {!! Form::label('logo', 'Logo*', ['class' => 'control-label']) !!}
        <input type="file" name="image" id="image" required>
        @if($errors->has('logo'))
            <span class="help-block">
                {{ $errors->first('logo') }}
            </span>
        @endif
    </div>
    {!! Form::hidden('id', old('id')) !!}
</div>