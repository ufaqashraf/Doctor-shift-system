@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="/admin/job">
                    <div class="small-box" style="background-color:#734bbb">
                        <div class="inner">
                            <h3 style="padding-left: 12px; color:white">@if(isset($Counts['job'])){{$Counts['job']}} @else N/A @endif</h3>
                                <p style="padding-left: 12px;color:white">Posted Shifts</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                   
                    </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="/admin/hired">
                    <div class="small-box bg-success">
                        <div class="inner">
                        <h3 style="padding-left: 12px; color:white">@if(isset($Counts['approved_shifts'])){{$Counts['approved_shifts']}} @else N/A @endif</h3>
                            <p>Hired Shifts</p>
                         </div>
                        <div class="icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        
                    </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <a href="/admin/cancelled">
                <div class="small-box bg-red">
                  <div class="inner">
                  <h3 style="padding-left: 12px; color:white">@if(isset($Counts['cancel_shifts'])){{$Counts['cancel_shifts']}} @else N/A @endif</h3>

                    <p style="color:white">Cancelled Shifts</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-lock"></i>
                  </div>
                 
                </div>
                </a>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
            <a href="/admin/completed">
            <div class="small-box"style="background-color:#20c997">
              <div class="inner">
              <h3 style="padding-left: 12px; color:white">@if(isset($Counts['completed_shifts'])){{$Counts['completed_shifts']}} @else N/A @endif</h3>

                <p style="color:white">Completed Shifts</p>
              </div>
              <div class="icon">
                <i class="fas fa-hospital"></i>
              </div>
             
            </div>
            </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->


        <!-- calender -->
      
       
       
        <section class="content">
            <div class="card card-primary" >
                <div class="card-header">
                <h3 class="card-title">Calendar</h3>
                    <div class="card-tools">
                        @if(Auth::user()->role_id == 2)
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">Add a new job</button>
                            @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style='padding:0px'> 
                    <div class='row col-md-12'> 
                        <div class=" card col-md-8" style='margin-top:20px'>
                            {!! $calendar_details->calendar() !!} 
                            {!! $calendar_details->script() !!}
                        </div>
                        
                            <div class="col-md-4">
                                    <div>
                                        <section class="content" style='padding-left:0px'>
                                    `       <div class="card" style="border-radius: 15px">
                                                <div style='background-image: linear-gradient(to right, #208bc973, #19b385); color:white;height:65px;border-radius: 15px'>
                                                <h4 class="text-center" style="padding-top:20px">Applications on Shifts</h3>
                                                   
                                                </div>
                                                <div id="accordion">
                                                    <div class="card" style="padding-top:15px">
                                                        <div class="card-header" style='background-image: linear-gradient(to right, #4ccab3, #ffffff73);border-radius: 25px' id="headingOne">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="color:white;padding-left:65px">
                                                                Doctors Applied on Shifts 
                                                                <i style='margin-left:5px'class="fa fa-angle-down" aria-hidden="true"></i> 
                                                                </button>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                            
                                                            <div class='card-body' style='overflow: auto; max-height: 400px; padding: 0' >
                                                            <table class="table table-bordered table-striped {{ count($Jobs) > 0 ? 'datatable' : '' }}">
                                                                    <thead>
                                                                    <th>Job Title</th>                                                  
                                                                    <th>Doctors</th>
                                                                    </thead>
                                                                    <tbody class="table table-nobordered">
                                                                        @if (count($Jobs_application) > 0)
                                                                            @foreach ($Jobs_application as $Job)
                                                                                <tr data-entry-id="{{ $Job->id }}">
                                                                                    <td>{{  $Job->title }}<br>
                                                                                    <span style='color:#009b80'class='fa fa-calendar'></span>  &nbsp{{ date("d/m/Y", strtotime($Job->job_date))}}  &nbsp &nbsp &nbsp &nbsp
                                                                                    <span style='color:#009b80'class='fa fa-clock'></span>  &nbsp{{ date("H:i", strtotime($Job->time_from))}}-
                                                                                    {{ date("H:i", strtotime($Job->time_to))}}
                                                                                </td>
                                                                                    <td onclick="FormControls.applicants({{ $Job->job_id }})">
                                                                                    <button style="margin-left:13px"type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-applicant-modal-lg"> {{ $Job->apps }} </button>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @else
                                                                            <tr>
                                                                                <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                                                                            </tr>
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                    <div class="card" style="border-radius: 25px;">
                                                        <div class="card-header" style='background-image: linear-gradient(to right, #4ccab3, #ffffff73);border-radius: 25px;' id="headingTwo">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="color:white;padding-left:65px; ">
                                                                Doctors Hired for Shifts 
                                                                <i style='margin-left:5px'class="fa fa-angle-down" aria-hidden="true"></i>
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                                            <div class='card-body' style='overflow: auto; height: 400px; padding: 0' >
                                                                <table class="table table-bordered table-striped {{ count($Jobs) > 0 ? 'datatable' : '' }}">
                                                                        <thead>
                                                                            <th width=68%>Job Details</th>                       
                                                                            <th>Doctors</th>
                                                                        </thead>   
                                                                        <tbody class="table table-nobordered">
                                                                        
                                                                            @if (count($details_array) > 0)
                                                                                @foreach ($details_array as $details)
                                                                                    <tr>
                                                                                        <td>
                                                                                            {{$details['job_id']}}<br>
                                                                                            
                                                                                            {{$details['job_grade']}}
                                                                                            <br><span style='color:#009b80'class='fa fa-calendar'></span> {{ date("d/m/Y", strtotime($details['job_date']))}} &nbsp
                                                                                            <span style='color:#009b80'class='fa fa-clock'></span> {{ date("H:i", strtotime($details['job_timeFrom']))}}-
                                                                                            {{ date("H:i", strtotime($details['job_timeTo']))}}
                                                                                           
                                                                                        </td>
                                                                                        <td>
                                                                                        <a style='margin-top:15px' href="{{ route('admin.users.profile',[$details['user_id']]) }}" target='_blank' class="btn btn-sm btn-info">{{ $details['name'] }}</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @else
                                                                                <tr>
                                                                                    <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                                                                                </tr>
                                                                            @endif
                                                                      
                                                                        </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                            
                                                    </div>
                                                <!-- /.card-header -->
                                              
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </section>`
                                    </div>    
                           
                        <!-- /.progress-group -->
                    </div>
                        </div>    
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            
          <!-- /.card -->
        </section>
             

<!-- calender -->



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <section class="content-header">
        <!-- /.container-fluid -->
        </section>
                    <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">Jobs Registration</h3>
        </div>
            <!-- /.card-header -->
            <!-- form start -->
        {!! Form::open(['method' => 'POST', 'route' => ['admin.job.store'], 'data-parsley-validate']) !!}
        <div class="card-body">
                <div class="row">
                        @include('admin.job.field')
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-outline-danger']) !!}
                    
                </div>

                <!-- /.card-footer -->

            {!! Form::close() !!}
            @include('admin.job.job-info-templates')
        </div>
                <!-- /.card -->
    </div>
  </div>
</div>

<div class="modal fade bd-applicant-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
       
            <section class="content-header card-info">
                <div class="container-fluid ">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 style='text-align:center'>Doctors Details</h3>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="card card-primary">

                    <!-- /.card-header -->
                    <div class="col-md-12" >
                        <!-- Horizontal Form -->
                        <table class="table table-bordered  datatable" id="grade_details">
                            <thead>
                            <tr>
                                <th width='15%'>Name</th>
                                <th >GMC</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Applied On Grade</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                            <!-- /.card -->
                        </div>
                </div>

            </section>
        </div>
    </div>
</div>
    <!-- /.content -->
@endsection
@section('jsscript')
    <script src="{{ url('public/js/admin/job/create.js') }}" type="text/javascript"></script>
@endsection
