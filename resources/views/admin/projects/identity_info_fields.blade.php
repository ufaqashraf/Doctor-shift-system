<div class="form-group  col-md-3 @if($errors->has('cnic')) has-error @endif">
    {!! Form::label('cnic', 'CNIC*', ['class' => 'control-label']) !!}
    {!! Form::text('cnic', old('name'), ['class' => 'form-control cnicmask', 'placeholder' => '' ,'maxlength'=>'15', 'data-inputmask'=>"'mask': '99999-9999999-9'",'required'=>true]) !!}
    @if($errors->has('cnic'))
        <span class="help-block">
            {{ $errors->first('cnic') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('cnic_issue_place')) has-error @endif">
    {!! Form::label('cnic_issue_place', 'CNIC Place of issue ', ['class' => 'control-label']) !!}
    {!! Form::text('cnic_issue_place', old('cnic_issue_place'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('cnic_issue_place'))
        <span class="help-block">
            {{ $errors->first('cnic_issue_place') }}
        </span>
    @endif
</div>
<!-- <div class="form-group  col-md-3 @if($errors->has('cnic_issue_date')) has-error @endif">
    {!! Form::label('cnic_issue_date', 'CNIC Issue Date ', ['class' => 'control-label']) !!}
    {!! Form::text('cnic_issue_date', old('cnic_issue_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
    @if($errors->has('cnic_issue_date'))
        <span class="help-block">
            {{ $errors->first('cnic_issue_date') }}
        </span>
    @endif
</div> -->
<div class="form-group  col-md-3 @if($errors->has('cnic_expiry_date')) has-error @endif">
    {!! Form::label('cnic_expiry_date', 'CNIC Expiry Date ', ['class' => 'control-label']) !!}
    {!! Form::text('cnic_expiry_date', old('cnic_expiry_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
    @if($errors->has('cnic_expiry_date'))
        <span class="help-block">
            {{ $errors->first('cnic_expiry_date') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('cnic_father')) has-error @endif">
    {!! Form::label('cnic_father', 'Father\'s CNIC No. ', ['class' => 'control-label']) !!}
    {!! Form::text('cnic_father', old('cnic_father'), ['class' => 'form-control cnicmask', 'placeholder' => '' ,'maxlength'=>'255', 'data-inputmask'=>"'mask': '99999-9999999-9'"]) !!}
    @if($errors->has('cnic_father'))
        <span class="help-block">
            {{ $errors->first('cnic_father') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('cnic_spouse')) has-error @endif">
    {!! Form::label('cnic_spouse', 'Spouse CNIC No. ', ['class' => 'control-label']) !!}
    {!! Form::text('cnic_spouse', old('cnic_spouse'), ['class' => 'form-control cnicmask', 'placeholder' => '' ,'maxlength'=>'255', 'data-inputmask'=>"'mask': '99999-9999999-9'"]) !!}
    @if($errors->has('cnic_spouse'))
        <span class="help-block">
            {{ $errors->first('cnic_spouse') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('ntn_no')) has-error @endif">
    {!! Form::label('ntn_no', 'NTN No. ', ['class' => 'control-label']) !!}
    {!! Form::text('ntn_no', old('ntn_no'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('ntn_no'))
        <span class="help-block">
            {{ $errors->first('ntn_no') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('eobi_no')) has-error @endif">
    {!! Form::label('eobi_no', 'EOBI No. ', ['class' => 'control-label']) !!}
    {!! Form::text('eobi_no', old('eobi_no'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('eobi_no'))
        <span class="help-block">
            {{ $errors->first('eobi_no') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('social_security_no')) has-error @endif">
    {!! Form::label('social_security_no', 'Social Security No. ', ['class' => 'control-label']) !!}
    {!! Form::text('social_security_no', old('social_security_no'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('social_security_no'))
        <span class="help-block">
            {{ $errors->first('social_security_no') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('driving_license_no')) has-error @endif">
    {!! Form::label('driving_license_no', 'Driving License No. ', ['class' => 'control-label']) !!}
    {!! Form::text('driving_license_no', old('driving_license_no'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('driving_license_no'))
        <span class="help-block">
            {{ $errors->first('driving_license_no') }}
        </span>
    @endif
</div>
<!-- <div class="form-group  col-md-3 @if($errors->has('driving_license_issue_date')) has-error @endif">
    {!! Form::label('driving_license_issue_date', 'Driving License Issue Date ', ['class' => 'control-label']) !!}
    {!! Form::text('driving_license_issue_date', old('driving_license_issue_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
    @if($errors->has('driving_license_issue_date'))
        <span class="help-block">
            {{ $errors->first('driving_license_issue_date') }}
        </span>
    @endif
</div> -->
<div class="form-group  col-md-3 @if($errors->has('driving_license_expiry_date')) has-error @endif">
    {!! Form::label('driving_license_expiry_date', 'Driving License Expiry Date ', ['class' => 'control-label']) !!}
    {!! Form::text('driving_license_expiry_date', old('driving_license_expiry_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
    @if($errors->has('driving_license_expiry_date'))
        <span class="help-block">
            {{ $errors->first('driving_license_expiry_date') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('passport_no')) has-error @endif">
    {!! Form::label('passport_no', 'Passport No. ', ['class' => 'control-label']) !!}
    {!! Form::text('passport_no', old('passport_no'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('passport_no'))
        <span class="help-block">
            {{ $errors->first('passport_no') }}
        </span>
    @endif
</div>

<!-- <div class="form-group  col-md-3 @if($errors->has('passport_issue_date')) has-error @endif">
    {!! Form::label('passport_issue_date', 'Passport Issue Date ', ['class' => 'control-label']) !!}
    {!! Form::text('passport_issue_date', old('passport_issue_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
    @if($errors->has('passport_issue_date'))
        <span class="help-block">
            {{ $errors->first('passport_issue_date') }}
        </span>
    @endif
</div> -->
<div class="form-group  col-md-3 @if($errors->has('passport_expiry_date')) has-error @endif">
    {!! Form::label('passport_expiry_date', 'Passport Expiry Date ', ['class' => 'control-label']) !!}
    {!! Form::text('passport_expiry_date', old('passport_expiry_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
    @if($errors->has('passport_expiry_date'))
        <span class="help-block">
            {{ $errors->first('passport_expiry_date') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('health_ins_no')) has-error @endif">
    {!! Form::label('health_ins_no', 'Health Insurance No.', ['class' => 'control-label']) !!}
    {!! Form::text('health_ins_no', old('health_ins_no'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('health_ins_no'))
        <span class="help-block">
            {{ $errors->first('health_ins_no') }}
        </span>
    @endif
</div>