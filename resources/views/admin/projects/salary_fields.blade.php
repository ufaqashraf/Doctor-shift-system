<div style="display:inline-block">
<div class="form-group  col-md-3 @if($errors->has('bank_name')) has-error @endif">
    <?php
    $Bankname =\App\Models\Admin\BanksModel::pluck('bank_name','id');
    ?>
    {!! Form::label('bank_name', 'Bank Name', ['class' => 'control-label']) !!}
    {!! Form::select('bank_name', $Bankname->prepend('Select Bank Name', ''),old('bank_name'), ['class' => 'form-control select2']) !!}
    @if($errors->has('bank_name'))
        <span class="help-block">
            {{ $errors->first('bank_name') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3  col-md-3 @if($errors->has('account_type')) has-error @endif">
   
    {!! Form::label('account_type', 'Account Type', ['class' => 'control-label']) !!}
    {!! Form::select('account_type', array('' => 'Select a type') + Config::get('hrm.account_type') ,old('account_type'),
     ['class' => 'form-control' ]) !!}
    @if($errors->has('account_type'))
        <span class="help-block">
                        {{ $errors->first('account_type') }}
                    </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('iban_number')) has-error @endif">
    {!! Form::label('iban_number', 'IBAN Number', ['class' => 'control-label']) !!}
    {!! Form::text('iban_number', old('iban_number'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('iban_number'))
        <span class="help-block">
            {{ $errors->first('iban_number') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('account_title')) has-error @endif">
    {!! Form::label('account_title', 'Account Title', ['class' => 'control-label']) !!}
    {!! Form::text('account_title', old('account_title'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('account_title'))
        <span class="help-block">
            {{ $errors->first('account_title') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('account_number')) has-error @endif">
    {!! Form::label('account_number', 'Account Number', ['class' => 'control-label']) !!}
    {!! Form::text('account_number', old('account_number'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('account_number'))
        <span class="help-block">
                        {{ $errors->first('account_number') }}
                    </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('branch_name')) has-error @endif">
    {!! Form::label('branch_name', 'Branch', ['class' => 'control-label']) !!}
    {!! Form::text('branch_name', old('branch_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('branch_name'))
        <span class="help-block">
                        {{ $errors->first('branch_name') }}
                    </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('branch_code')) has-error @endif">
    {!! Form::label('branch_code', 'Branch Code', ['class' => 'control-label']) !!}
    {!! Form::text('branch_code', old('branch_code'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('branch_code'))
        <span class="help-block">
                        {{ $errors->first('branch_code') }}
                    </span>
    @endif
</div>
</div>


<div class="clearfix">
</div>

<hr>
<div class="form-group  col-md-3 @if($errors->has('gross_salary')) has-error @endif">
    {!! Form::label('gross_salary', 'Total Gross Salary', ['class' => 'control-label']) !!}
    {!! Form::number('gross_salary', old('gross_salary'), ['class' => 'form-control', 'placeholder' => '', 'onchange' => 'FormControls.CalcSal(this.value)' ,'min'=>0]) !!}
    @if($errors->has('gross_salary'))
        <span class="help-block">
            {{ $errors->first('gross_salary') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('basic_salary')) has-error @endif">
    {!! Form::label('basic_salary', 'Basic Salary', ['class' => 'control-label']) !!}
    {!! Form::number('basic_salary', old('basic_salary'), ['class' => 'form-control', 'placeholder' => '','min'=>0]) !!}
    @if($errors->has('basic_salary'))
        <span class="help-block">
            {{ $errors->first('basic_salary') }}
        </span>
    @endif
</div>

<div style="display:none;" class="form-group  col-md-3 @if($errors->has('current_basic_salary')) has-error @endif">
    {!! Form::label('current_basic_salary', 'Current Basic Salary', ['class' => 'control-label']) !!}
    {!! Form::number('current_basic_salary', old('current_basic_salary'), ['class' => 'form-control', 'placeholder' => '','min'=>0]) !!}
    @if($errors->has('current_basic_salary'))
        <span class="help-block">
            {{ $errors->first('current_basic_salary') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('house_rent_allowance')) has-error @endif">
    {!! Form::label('house_rent_allowance', 'House Rent Allowance', ['class' => 'control-label']) !!}
    {!! Form::number('house_rent_allowance', old('house_rent_allowance'), ['class' => 'form-control', 'placeholder' => '','min'=>0]) !!}
    @if($errors->has('house_rent_allowance'))
        <span class="help-block">
            {{ $errors->first('house_rent_allowance') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('utilities_allowance')) has-error @endif">
    {!! Form::label('utilities_allowance', 'Utilities Allowance', ['class' => 'control-label']) !!}
    {!! Form::number('utilities_allowance', old('utilities_allowance'), ['class' => 'form-control', 'placeholder' => '','min'=>0]) !!}
    @if($errors->has('utilities_allowance'))
        <span class="help-block">
            {{ $errors->first('utilities_allowance') }}
        </span>
    @endif
</div>


<div class="clearfix">
</div>

<hr>
<div class="form-group  col-md-3 @if($errors->has('conveyance_allowance')) has-error @endif">
    {!! Form::label('conveyance_allowance', 'Convenyance Allowance', ['class' => 'control-label']) !!}
    {!! Form::number('conveyance_allowance', old('conveyance_allowance'), ['class' => 'form-control', 'placeholder' => '', 'onchange' => 'FormControls.CalcAll(this.value)','min'=>0]) !!}
    @if($errors->has('conveyance_allowance'))
        <span class="help-block">
            {{ $errors->first('conveyance_allowance') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('accommodation_allowance')) has-error @endif">
    {!! Form::label('accommodation_allowance', 'Accomodation Allowance', ['class' => 'control-label']) !!}
    {!! Form::number('accommodation_allowance', old('accommodation_allowance'), ['class' => 'form-control', 'placeholder' => '', 'onchange' => 'FormControls.CalcAll(this.value)','min'=>0]) !!}
    @if($errors->has('accommodation_allowance'))
        <span class="help-block">
            {{ $errors->first('accommodation_allowance') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('total_add_allowance')) has-error @endif">
    {!! Form::label('total_add_allowance', 'Total Additional Allowance', ['class' => 'control-label']) !!}
    {!! Form::number('total_add_allowance', old('total_add_allowance'), ['class' => 'form-control', 'placeholder' => '','min'=>0]) !!}
    @if($errors->has('total_add_allowance'))
        <span class="help-block">
            {{ $errors->first('total_add_allowance') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('total_remuneration ')) has-error @endif">
    {!! Form::label('total_remuneration', 'Total Remuneration ', ['class' => 'control-label']) !!}
    {!! Form::number('total_remuneration', old('total_remuneration'), ['class' => 'form-control', 'placeholder' => '','min'=>0]) !!}
    @if($errors->has('total_remuneration'))
        <span class="help-block">
            {{ $errors->first('total_remuneration') }}
        </span>
    @endif
</div>
<div class="clearfix">
</div>

<div class="form-group  col-md-3 @if($errors->has('gratuity_figure')) has-error @endif">
    {!! Form::label('gratuity_figure', 'Gratuity Figure', ['class' => 'control-label']) !!}
    {!! Form::number('gratuity_figure', old('gratuity_figure'), ['class' => 'form-control', 'placeholder' => '','min'=>0]) !!}
    @if($errors->has('gratuity_figure'))
        <span class="help-block">
            {{ $errors->first('gratuity_figure') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('mobile_allowance')) has-error @endif">
    {!! Form::label('mobile_allowance', 'Mobile Allowance', ['class' => 'control-label']) !!}
    {!! Form::number('mobile_allowance', old('mobile_allowance'), ['class' => 'form-control', 'placeholder' => '','min'=>0]) !!}
    @if($errors->has('mobile_allowance'))
        <span class="help-block">
            {{ $errors->first('mobile_allowance') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('fuel_allowance')) has-error @endif">
    {!! Form::label('fuel_allowance', 'Fuel Allowance', ['class' => 'control-label']) !!}
    {!! Form::number('fuel_allowance', old('fuel_allowance'), ['class' => 'form-control', 'placeholder' => '','min'=>0]) !!}
    @if($errors->has('fuel_allowance'))
        <span class="help-block">
            {{ $errors->first('fuel_allowance') }}
        </span>
    @endif
</div>

</div>

<!--
<div class="form-group col-md-3  @if($errors->has('is_sc')) has-error @endif">
    {!! Form::label('is_sc', 'Apply Social Security ? ', ['class' => 'control-label']) !!}
    {{ Form::checkbox('is_sc', 1, old('is_sc') , ['id' => 'is_sc',
    'onchange' => 'FormControls.CalculateGrandTotal();' ] ) }}

    @if($errors->has('is_sc'))
        <span class="help-block">
            {{ $errors->first('is_sc') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('sc_amount')) has-error @endif">
    {!! Form::label('sc_amount', 'Social Security Amount', ['class' => 'control-label']) !!}
    {!! Form::number('sc_amount', old('sc_amount'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('sc_amount'))
        <span class="help-block">
                        {{ $errors->first('sc_amount') }}
        </span>
    @endif
</div>

<div class="form-group col-md-2  @if($errors->has('is_house_rent')) has-error @endif">
    {!! Form::label('is_house_rent', 'Apply House Rent ? ', ['class' => 'control-label']) !!}
    {{ Form::checkbox('is_house_rent', 1, old('is_house_rent') , ['id' => 'is_house_rent',
    'onchange' => 'FormControls.CalculateGrandTotal();' ] ) }}

    @if($errors->has('is_house_rent'))
        <span class="help-block">
            {{ $errors->first('is_house_rent') }}
        </span>
    @endif
</div>

<div class="form-group col-md-2  @if($errors->has('is_utility')) has-error @endif">
    {!! Form::label('is_utility', 'Apply Utility ? ', ['class' => 'control-label']) !!}
    {{ Form::checkbox('is_utility', 1, old('is_utility') , ['id' => 'is_utility',
    'onchange' => 'FormControls.CalculateGrandTotal();' ] ) }}

    @if($errors->has('is_utility'))
        <span class="help-block">
            {{ $errors->first('is_utility') }}
        </span>
    @endif
</div>

<div class="form-group col-md-2  @if($errors->has('is_overtime')) has-error @endif">
    {!! Form::label('is_overtime', 'Apply Over Time ? ', ['class' => 'control-label']) !!}
    {{ Form::checkbox('is_overtime', 1, old('is_overtime') , ['id' => 'is_overtime',
    'onchange' => 'FormControls.CalculateGrandTotal();' ] ) }}

    @if($errors->has('is_overtime'))
        <span class="help-block">
            {{ $errors->first('is_overtime') }}
        </span>
    @endif
</div> -->