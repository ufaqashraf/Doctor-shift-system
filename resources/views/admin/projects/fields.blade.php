

<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="about_featured">
        <div class="panel-group" id="accordionBasicInfo">

            <div class="panel panel-default wow fadInLeft">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordionBasicInfo" href="#BasicInfo1">
                            <span class="fa fa-check-square-o"></span><b> Project Info </b>
                        </a>
                    </h4>
                </div>

                <div class="panel-body" >

                    <div id="BasicInfo1" class="panel-collapse collapse in">

                      <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="form-group  col-md-4 @if($errors->has('name')) has-error @endif">
                            {!! Form::label('name', 'Project name', ['class' => 'control-label']) !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'project name']) !!}
                            @if($errors->has('name'))
                                <span class="help-block">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                    
                        <div class="form-group  col-md-4 @if($errors->has('days_of_shooting')) has-error @endif">
                            {!! Form::label('days_of_shooting', 'Days of shooting', ['class' => 'control-label']) !!}
                            {!! Form::text('days_of_shooting', old('days_of_shooting'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'100','required'=>true]) !!}
                            @if($errors->has('days_of_shooting'))
                                <span class="help-block">
                                    {{ $errors->first('days_of_shooting') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group  col-md-4 @if($errors->has('director')) has-error @endif">
                            {!! Form::label('director', 'Director', ['class' => 'control-label']) !!}
                            {!! Form::text('director', old('director'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            @if($errors->has('director'))
                                <span class="help-block">
                                    {{ $errors->first('director') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group  col-md-4 @if($errors->has('producer')) has-error @endif">
                            {!! Form::label('producer', 'Producer', ['class' => 'control-label']) !!}
                            {!! Form::text('producer', old('producer'), ['class' => 'form-control', 'placeholder' => '','required'=>true]) !!}
                            @if($errors->has('producer'))
                                <span class="help-block">
                                    {{ $errors->first('producer') }}
                                </span>
                            @endif
                        </div>


                        <div class="form-group  col-md-8 @if($errors->has('map_link')) has-error @endif" >
                            {!! Form::label('map_link', 'Map link', ['class' => 'control-label']) !!}
                            {!! Form::text('map_link', old('map_link'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'50']) !!}
                            @if($errors->has('map_link'))
                                <span class="help-block">
                                    {{ $errors->first('map_link') }}
                                </span>
                            @endif
                        </div>
                       
                        <div class="form-group  col-md-12 @if($errors->has('location_info')) has-error @endif">
                            {!! Form::label('location_info', 'Location info', ['class' => 'control-label']) !!}
                            {!! Form::textarea('location_info', old('location_info'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'100','id' => 'location_info', 'rows' => 4, 'cols' => 54]) !!}
                            @if($errors->has('location_info'))
                                <span class="help-block">
                                    {{ $errors->first('location_info') }}
                                </span>
                            @endif
                        </div>

                         <div class="form-group  col-md-12 @if($errors->has('city')) has-error @endif">
                            {!! Form::label('weather_info', 'Weather info', ['class' => 'control-label']) !!}
                             {!! Form::textarea('weather_info', old('weather_info'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'100','id' => 'weather_info', 'rows' => 4, 'cols' => 54]) !!}
                            @if($errors->has('weather_info'))
                                <span class="help-block">
                                    {{ $errors->first('weather_info') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group  col-md-12 @if($errors->has('crew_info')) has-error @endif" >
                            {!! Form::label('crew_info', 'Crew info', ['class' => 'control-label']) !!}
                           {!! Form::textarea('crew_info', old('crew_info'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'100','id' => 'crew_info', 'rows' => 4, 'cols' => 54]) !!}
                            @if($errors->has('crew_info'))
                                <span class="help-block">
                                    {{ $errors->first('crew_info') }}
                                </span>
                            @endif
                        </div>


                        <div class="form-group  col-md-12 
                        @if($errors->has('unit_notes')) has-error @endif" >
                            {!! Form::label('unit_notes', 'unit notes', ['class' => 'control-label']) !!}
                            {!! Form::textarea('unit_notes', old('unit_notes'), ['class' => 'form-control', 'placeholder' => '' ,'maxlength'=>'100','id' => 'unit_notes', 'rows' => 4, 'cols' => 54]) !!}
                            @if($errors->has('unit_notes'))
                                <span class="help-block">
                                    {{ $errors->first('unit_notes') }}
                                </span>
                            @endif
                        </div>
                    </div>


                    </div>
                </div>

                
            </div>
        </div>

    </div>
</div>





