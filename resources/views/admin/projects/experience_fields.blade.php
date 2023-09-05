<div class="form-group  col-md-3 @if($errors->has('pre_job_title')) has-error @endif">
    <?php
//    $JobTitle =\App\Models\HRM\JobTitle::pluck('name','id');
    ?>
    {!! Form::label('pre_job_title', 'Job Title', ['class' => 'control-label']) !!}
        {!! Form::text('pre_job_title', old('pre_job_title'), ['class' => 'form-control', 'placeholder' => '']) !!}

        {{--{!! Form::select('pre_job_title', $JobTitle->prepend('Select a job title', ''),old('pre_job_title'), ['class' => 'form-control']) !!}--}}
    @if($errors->has('pre_job_title'))
        <span class="help-block">
                        {{ $errors->first('pre_job_title') }}
                    </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('pre_company')) has-error @endif">

    {!! Form::label('pre_company', 'Previous Company', ['class' => 'control-label']) !!}
    {!! Form::text('pre_company', old('pre_company'), ['class' => 'form-control', 'placeholder' => '']) !!}
        @if($errors->has('pre_company'))
        <span class="help-block">
                        {{ $errors->first('pre_company') }}
                    </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('pre_job_date_from')) has-error @endif">
    {!! Form::label('pre_job_date_from', 'From', ['class' => 'control-label']) !!}
    {!! Form::text('pre_job_date_from', old('pre_job_date_from'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('pre_job_date_from'))
        <span class="help-block">
                        {{ $errors->first('pre_job_date_from') }}
                    </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('pre_job_date_to')) has-error @endif">
    {!! Form::label('pre_job_date_to', 'To', ['class' => 'control-label']) !!}
    {!! Form::text('pre_job_date_to', old('contract_end_date'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('pre_job_date_to'))
        <span class="help-block">
                        {{ $errors->first('pre_job_date_to') }}
                    </span>
    @endif
</div>
<div class="form-group  col-md-3 @if($errors->has('skill_title')) has-error @endif">

    <?php
    $SkillTitle =\App\Models\HRM\Skills::pluck('name','id');
    ?>
    {!! Form::label('skill_title', 'Skill', ['class' => 'control-label']) !!}
    {!! Form::select('skill_title', $SkillTitle->prepend('Select Skill', ''),old('skill_title'), ['class' => 'form-control']) !!}
    @if($errors->has('skill_title'))
        <span class="help-block">
                        {{ $errors->first('skill_title') }}
                    </span>
    @endif
</div>

<div class="form-group  col-md-3 @if($errors->has('skills_experiance')) has-error @endif">

    {!! Form::label('skills_experiance', 'Skills Experiance', ['class' => 'control-label']) !!}
    {!! Form::text('skills_experiance', old('skills_experiance'), ['class' => 'form-control', 'placeholder' => '']) !!}
    @if($errors->has('skills_experiance'))
        <span class="help-block">
                        {{ $errors->first('skills_experiance') }}
                    </span>
    @endif
</div>