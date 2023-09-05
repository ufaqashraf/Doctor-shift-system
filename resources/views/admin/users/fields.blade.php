<div class="form-group row">
    {!! Form::label('name', 'Name*', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'data-parsley-required' => 'true']) !!}
        <p class="help-block"></p>
        @if($errors->has('name'))
            <p class="help-block">
                {{ $errors->first('name') }}
            </p>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('mobile', 'Mobile', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('mobile', old('mobile'), ['class' => 'form-control', 'placeholder' => '', 'data-parsley-required' => 'true']) !!}
        <p class="help-block"></p>
        @if($errors->has('mobile'))
            <p class="help-block">
                {{ $errors->first('mobile') }}
            </p>
        @endif
    </div>
</div>

<div class="form-group row">
    {!! Form::label('email', 'Email*', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'data-parsley-required' => 'true']) !!}
        <p class="help-block"></p>
        @if($errors->has('email'))
            <p class="help-block">
                {{ $errors->first('email') }}
            </p>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('password', 'Password*', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('password', '', ['class' => 'form-control', 'placeholder' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('password'))
            <p class="help-block">
                {{ $errors->first('password') }}
            </p>
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('hospital_id', 'Hospital *', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::select('hospital_id', $Hospital, old('hospital_id'), ['class' => 'form-control select2',  'required' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('hospital_id'))
            <p class="help-block">
                {{ $errors->first('hospital_id') }}
            </p>
        @endif
    </div>
</div>


<div class="form-group row">
    {!! Form::label('dept_id', 'Department *', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::select('dept_id', $Departments, old('dept_id'), ['class' => 'form-control select2',  'required' => '', 'id' => 'dept_id' ] )!!}
        <p class="help-block"></p>
        @if($errors->has('dept_id'))
            <p class="help-block">
                {{ $errors->first('dept_id') }}
            </p>
        @endif
    </div>
</div>

<div class="form-group row">
    {!! Form::label('roles', 'Roles*', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::select('roles[]', $roles, old('roles'), ['class' => 'form-control select2',  'required' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('roles'))
            <p class="help-block">
                {{ $errors->first('roles') }}
            </p>
        @endif
    </div>
</div>