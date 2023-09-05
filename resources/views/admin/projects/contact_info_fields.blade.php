<div class="form-group  col-md-3 @if($errors->has('mobile')) has-error @endif">
    {!! Form::label('mobile', 'Personal Mobile', ['class' => 'control-label']) !!}
    {!! Form::text('mobile', old('mobile'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'15']) !!}
    @if($errors->has('mobile'))
        <span class="help-block">
            {{ $errors->first('mobile') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Personal Email ID*', ['class' => 'control-label']) !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50','required'=>true]) !!}
    @if($errors->has('email'))
        <span class="help-block">
            {{ $errors->first('email') }}
        </span>
    @endif
</div>
                       
                        


<div class="form-group  col-md-3 @if($errors->has('current_address')) has-error @endif">
    {!! Form::label('current_address', 'Current Address', ['class' => 'control-label']) !!}
    {!! Form::text('current_address', old('current_address'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('current_address'))
        <span class="help-block">
            {{ $errors->first('current_address') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('address')) has-error @endif">
    {!! Form::label('address', 'Permanent Address', ['class' => 'control-label']) !!}
    {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('address'))
        <span class="help-block">
            {{ $errors->first('address') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('emergency_contact_person')) has-error @endif">
    {!! Form::label('emergency_contact_person', 'Emergency Contact Person', ['class' => 'control-label']) !!}
    {!! Form::text('emergency_contact_person', old('emergency_contact_person'), ['class' => 'form-control']) !!}
    @if($errors->has('emergency_contact_person'))
        <span class="help-block">
            {{ $errors->first('emergency_contact_person') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('emergency_mobile')) has-error @endif">
    {!! Form::label('emergency_mobile', 'Emergency Contact No.', ['class' => 'control-label']) !!}
    {!! Form::text('emergency_mobile', old('emergency_mobile'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'15']) !!}
    @if($errors->has('emergency_mobile'))
        <span class="help-block">
            {{ $errors->first('emergency_mobile') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('official_contact_no')) has-error @endif">
    {!! Form::label('official_contact_no', 'Official Contact No.', ['class' => 'control-label']) !!}
    {!! Form::text('official_contact_no', old('official_contact_no'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('official_contact_no'))
        <span class="help-block">
            {{ $errors->first('official_contact_no') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('official_email')) has-error @endif">
    {!! Form::label('official_email', 'Official Email ID', ['class' => 'control-label']) !!}
    {!! Form::text('official_email', old('official_email'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('official_email'))
        <span class="help-block">
            {{ $errors->first('official_email') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('ext_no')) has-error @endif">
    {!! Form::label('ext_no', 'Extension No.', ['class' => 'control-label']) !!}
    {!! Form::text('ext_no', old('ext_no'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('ext_no'))
        <span class="help-block">
            {{ $errors->first('ext_no') }}
        </span>
    @endif
</div>
