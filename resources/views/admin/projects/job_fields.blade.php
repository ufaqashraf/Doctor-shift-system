<div class="form-group mt-2 col-md-3 @if($errors->has('designation')) has-error @endif">
    <?php
    $JobTitle =\App\Models\HRM\JobTitle::pluck('name','id');
    ?>
    {!! Form::label('designation', 'Designation*', ['class' => 'control-label']) !!}
    {!! Form::select('designation', $JobTitle->prepend('Select Designation', '') ,old('designation'),
    ['class' => 'form-control select2' ,'id'=> 'designation','required'=>true]) !!}
    @if($errors->has('designation'))
        <span class="help-block">
            {{ $errors->first('designation') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('department_id')) has-error @endif">
    {!! Form::label('department_id', 'Department*', ['class' => 'control-label']) !!}
    {!! Form::select('department_id', $Departments, old('department_id'),
    ['id' => 'department_id','class' => 'form-control select2' ,'onchange' => 'FormControls.departmentChange(this.value);','required'=>true]) !!}
    @if($errors->has('department_id'))
        <span class="help-block">
            {{ $errors->first('department_id') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('employment_grade')) has-error @endif">
    {!! Form::label('employment_grade', 'Grade', ['class' => 'control-label']) !!}
    {!! Form::select('employment_grade', $PayGrades, old('employment_grade'), ['class' => 'form-control select2']) !!}
    @if($errors->has('employment_grade'))
        <span class="help-block">
            {{ $errors->first('employment_grade') }}
        </span>
    @endif
</div>


<!-- <div class="form-group  col-md-3 @if($errors->has('job_category')) has-error @endif">
    <?php
$JobCategories =\App\Models\HRM\JobCategories::pluck('name','id');
?>
{!! Form::label('job_category', 'Job Category', ['class' => 'control-label']) !!}
{!! Form::select('job_category', $JobCategories->prepend('Select a Category', ''), old('job_category'), ['class' => 'form-control select2']) !!}
@if($errors->has('job_category'))
    <span class="help-block">
{{ $errors->first('job_category') }}
            </span>
@endif
        </div> -->

<div class="form-group mt-2 col-md-3 @if($errors->has('region_id')) has-error @endif">
    <?php
    $Offices =\App\Models\HRM\OrganizationLocations::pluckActiveOnly();
    ?>
    {!! Form::label('region_id', 'Branch Office*', ['class' => 'control-label']) !!}
    {!! Form::select('region_id', $Offices->prepend('Select Office', '') ,old('region_id'),
    ['class' => 'form-control select2' ,'id'=> 'region_id','required'=>true]) !!}
    @if($errors->has('region_id'))
        <span class="help-block">
            {{ $errors->first('region_id') }}
        </span>
    @endif
</div>

<!-- <div style="display:none;" id="region_id_h" class="form-group  col-md-3 @if($errors->has('region_id')) has-error @endif">
    <?php
$RegionName =\App\Models\Admin\Regions::pluck('name','id');
?>
{!! Form::label('region_id', 'Region Name*', ['class' => 'control-label']) !!}
{!! Form::select('region_id', $RegionName->prepend('Select Region', ''),old('region_id'),
 ['class' => 'form-control select2','onchange' => 'FormControls.fetchBranches(this.value);']) !!}
@if($errors->has('region_id'))
    <span class="help-block">
{{ $errors->first('region_id') }}
            </span>
@endif
        </div> -->
<div style="display:none;" id="territory_id_h" class="form-group  col-md-3 @if($errors->has('territory_id')) has-error @endif">

    {!! Form::label('territory_id', 'Territory Name*', ['class' => 'control-label']) !!}
    @if(isset($Employee->id))
        <?php $newTerr =\App\Models\Admin\Territory::where(['branch_id'=> $Employee->branch_id])->pluck('name','id'); ?>
        {!! Form::select('territory_id', $newTerr->prepend('Select Territory', ''),old('territory_id'),
         ['class' => 'form-control', 'id' => 'territory_id' , 'onchange' => 'FormControls.fetchsalesman();']) !!}
    @else
        {!! Form::select('territory_id', array(),old('territory_id'),
        ['class' => 'form-control', 'id' => 'territory_id' , 'onchange' => 'FormControls.fetchsalesman();']) !!}
    @endif
    @if($errors->has('territory_id'))
        <span class="help-block">
            {{ $errors->first('territory_id') }}
        </span>
    @endif
</div>

<div style="display:none;" class="form-group  col-md-3 @if($errors->has('employee_status')) has-error @endif">
    <?php
    $EmploymentStatuses =\App\Models\HRM\EmploymentStatuses::pluck('name','id');
    ?>
    {!! Form::label('employee_status', 'Employee Status', ['class' => 'control-label']) !!}
    {!! Form::select('employee_status select2', $EmploymentStatuses->prepend('Select Status', ''),old('employee_status'), ['class' => 'form-control']) !!}

    @if($errors->has('employee_status'))
        <span class="help-block">
            {{ $errors->first('employee_status') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('date_of_hiring')) has-error @endif">
    {!! Form::label('date_of_hiring', 'Date of Hiring', ['class' => 'control-label']) !!}
    {!! Form::text('date_of_hiring', old('date_of_hiring'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
    @if($errors->has('date_of_hiring'))
        <span class="help-block">
            {{ $errors->first('date_of_hiring') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('date_of_joining')) has-error @endif">
    {!! Form::label('date_of_joining', 'Date of Joining', ['class' => 'control-label']) !!}
    {!! Form::text('date_of_joining', old('date_of_joining'), ['class' => 'form-control datepicker', 'placeholder' => '','id' => 'joiningData']) !!}
    @if($errors->has('date_of_joining'))
        <span class="help-block">
            {{ $errors->first('date_of_joining') }}
        </span>
    @endif
</div>


<div class="form-group  col-md-3  col-md-3 @if($errors->has('employment_mode')) has-error @endif">

    {!! Form::label('employment_mode', 'Employment Mode', ['class' => 'control-label']) !!}
    {!! Form::select('employment_mode', array('' => 'Select a mode') + Config::get('hrm.employment_mode') ,old('employment_mode'),
     ['class' => 'form-control' ]) !!}
    @if($errors->has('employment_mode'))
        <span class="help-block">
                       {{ $errors->first('employment_mode') }}
                   </span>
    @endif
</div>
<div class="form-group  col-md-3  col-md-3 @if($errors->has('employment_type')) has-error @endif">

    {!! Form::label('employment_type', 'Employment Type', ['class' => 'control-label']) !!}
    {!! Form::select('employment_type', array('' => 'Select a type') + Config::get('hrm.employment_type') ,old('employment_type'),
     ['class' => 'form-control', 'onchange' => 'FormControls.CalcSal()' ,'required'=>true]) !!}
    @if($errors->has('employment_type'))
        <span class="help-block">
                       {{ $errors->first('employment_type') }}
                   </span>
    @endif
</div>
<!-- <div  class="form-group  col-md-3  col-md-3 @if($errors->has('employment_status')) has-error @endif">

   {!! Form::label('employment_status', 'Employment Status', ['class' => 'control-label']) !!}
{!! Form::select('employment_status', array('' => 'Select a status') + Config::get('hrm.employment_status') ,old('employment_status'),
 ['class' => 'form-control' ]) !!}
@if($errors->has('employment_status'))
    <span class="help-block">
{{ $errors->first('employment_status') }}
            </span>
@endif
        </div> -->

<div class="form-group  col-md-3 @if($errors->has('employee_card_no')) has-error @endif">
    {!! Form::label('employee_card_no', 'Employee Card No.', ['class' => 'control-label']) !!}
    {!! Form::text('employee_card_no', old('employee_card_no'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @if($errors->has('employee_card_no'))
        <span class="help-block">
            {{ $errors->first('employee_card_no') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('probation_period')) has-error @endif">
    {!! Form::label('probation_period', 'Probation Period (Months)', ['class' => 'control-label']) !!}
    {!! Form::number('probation_period',old('probation_period') , ['class' => 'form-control','id' => 'prob-month' ]) !!}

    @if($errors->has('probation_period'))
        <span class="help-block">
            {{ $errors->first('probation_period') }}
        </span>
    @endif
</div>


<div class="form-group  col-md-3 @if($errors->has('probation_expiry')) has-error @endif">
    {!! Form::label('probation_expiry', 'Probation Expiry Date', ['class' => 'control-label']) !!}
    {!! Form::text('probation_expiry', old('probation_expiry'), ['class' => 'form-control', 'placeholder' => '','readonly'=>true,'id' => 'prob-datepick']) !!}
    @if($errors->has('probation_expiry'))
        <span class="help-block">
            {{ $errors->first('probation_expiry') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('probation_extention_period')) has-error @endif">
    {!! Form::label('probation_extention_period', 'Probation Extention Period(Months)', ['class' => 'control-label']) !!}
    {!! Form::text('probation_extention_period', old('probation_extention_period'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('probation_extention_period'))
        <span class="help-block">
            {{ $errors->first('probation_extention_period') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('confirmation_date')) has-error @endif">
    {!! Form::label('confirmation_date', 'Confirmation Date', ['class' => 'control-label']) !!}
    {!! Form::text('confirmation_date', old('confirmation_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
    @if($errors->has('confirmation_date'))
        <span class="help-block">
            {{ $errors->first('confirmation_date') }}
        </span>
    @endif
</div>



<div class="form-group  col-md-3 @if($errors->has('contract_start_date')) has-error @endif">
    {!! Form::label('contract_start_date', 'Start Date of Contract', ['class' => 'control-label']) !!}
    {!! Form::text('contract_start_date', old('contract_start_date'), ['class' => 'form-control datepicker ', 'placeholder' => '']) !!}
    @if($errors->has('contract_start_date'))
        <span class="help-block">
            {{ $errors->first('contract_start_date') }}
        </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('contract_end_date')) has-error @endif">
    {!! Form::label('contract_end_date', 'End Date of Contract', ['class' => 'control-label']) !!}
    {!! Form::text('contract_end_date', old('contract_end_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
    @if($errors->has('contract_end_date'))
        <span class="help-block">
            {{ $errors->first('contract_end_date') }}
        </span>
    @endif
</div>
<div class="form-group col-md-3 @if($errors->has('report_to')) has-error @endif">
    {!! Form::label('report_to', 'Reports To *', ['class' => 'control-label']) !!}

    {{-- {!! Form::select('report_to', $Employees->prepend('Select Reports To',''), old('report_to'), ['class' => 'form-control select2' , 'id' => 'report_to']) !!} --}}
    @if(isset($Employe))
        {!! Form::select('report_to', $Employe->prepend('Select Reports To',''), old('report_to'), ['class' => 'form-control select2' , 'id' => 'report_to','required'=>true]) !!}

    @endif
    @if(isset($Employee))
        @if($Employee->id==1)
            {!! Form::select('report_to', $Employees->prepend('Select Reports To',''), old('report_to'), ['class' => 'form-control select2' , 'id' => 'report_to']) !!}
        @else
            {!! Form::select('report_to', $Employees->prepend('Select Reports To',''), old('report_to'), ['class' => 'form-control select2' , 'id' => 'report_to','required'=>true]) !!}
        @endif
    @endif
    @if($errors->has('report_to'))
        <span class="help-block">
            {{ $errors->first('report_to') }}
        </span>
    @endif
</div>

<?php $Shifts = \App\Models\HRM\WorkShifts::pluckActiveOnly(); ?>

<div style="display:none;" class="form-group col-md-3 @if($errors->has('shift_id')) has-error @endif">
    {!! Form::label('shift_id', 'Shift *', ['class' => 'control-label']) !!}
    {!! Form::select('shift_id', $Shifts, old('shift_id'), ['class' => 'form-control select2' , 'id' => 'shift_id']) !!}
    @if($errors->has('shift_id'))
        <span class="help-block">
            {{ $errors->first('shift_id') }}
        </span>
    @endif
</div>


<div class="form-group  col-md-3 @if($errors->has('notice_period')) has-error @endif">
    {!! Form::label('notice_period', 'Notice Period (Days)', ['class' => 'control-label']) !!}
    @if(UserHelper::isHr())
        {!! Form::number('notice_period', old('notice_period'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255']) !!}
    @else

        {!! Form::number('notice_period', old('notice_period'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'255','readonly'=>true]) !!}
    @endif
    @if($errors->has('notice_period'))
        <span class="help-block">
            {{ $errors->first('notice_period') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('resignation_date')) has-error @endif">
    {!! Form::label('resignation_date', 'Resignation Date', ['class' => 'control-label']) !!}
    {!! Form::text('resignation_date', old('resignation_date'), ['class' => 'form-control ', 'placeholder' => '','readonly'=>true]) !!}
    @if($errors->has('resignation_date'))
        <span class="help-block">
            {{ $errors->first('resignation_date') }}
        </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('last_working_day')) has-error @endif">
    {!! Form::label('last_working_day', 'Last Working Day', ['class' => 'control-label']) !!}
    {!! Form::text('last_working_day', old('last_working_day'), ['class' => 'form-control', 'placeholder' => '','readonly'=>true]) !!}
    @if($errors->has('last_working_day'))
        <span class="help-block">
            {{ $errors->first('last_working_day') }}
        </span>
    @endif
</div>

@if(isset($Employee))
    @if(isset($Employee->id))
        <input type="hidden" name="prev_report" id="prev_report" value="{{ $Employee->report_to }}">
    @endif
@else
    <input type="hidden" name="prev_report" id="prev_report" value="0">
@endif


<script>
    var allBranches = <?php echo $Branches; ?>;
    var allTerritory = <?php echo $Territory; ?>;
    var allSalesman = <?php echo $allSalesman; ?>;
    console.log('allSalesman :', allSalesman);
        <?php if(isset($Employee->id)){ ?>
    var jobTitlee =  "<?php echo $Employee->job_title; ?>";
    <?php }
        else{ ?>
        jobTitlee = 0;
    <?php }
    ?>
</script>