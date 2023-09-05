@inject('request', 'Illuminate\Http\Request')
@extends('layouts.admin')

@section('content')
@if($message = Session::get('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
@endif
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Timesheet Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Timesheet</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
   <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Timesheet Details</h3>
                <div class="card-tools">
        
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="card col-md-7">
                        <img class="card-img-center img-circle" style='margin-left: 250px' src="/public/uploads/doctors/{{$Timesheets->user_name->image}}" width="100" height="100" alt="Card image cap">
                        <table class="table table-nobordered">
                            <tbody>
                            <tr>
                                <th>Name:</th>
                                <td>{{ $Timesheets->user_name->name }}</td>
                                <th>Grade:</th>
                                <td>{{ $Timesheets->grade_name->name }}</td>
                            </tr> 
                                <th>Start time:</th>
                                <td>{{ date("H:i", strtotime($Timesheets->time_from))}}</td>
                                <th>End time:</th>
                                <td>{{ date("H:i", strtotime($Timesheets->time_to))}}</td>
                            </tr>
                            <tr>
                                <th >Break time:</th>
                                <td>{{ $Timesheets->break_time }} mins</td>
                                <th>Rate per hour:</th>
                                <td>£ {{ $Timesheets->rate }}</td>                               
                            </tr>
                            <tr>
                                <th>Calculated Hours:</th>
                                <td>{{ $Timesheets->job_hours }} hours</td>
                                <th>Calculated Amount:</th>
                                <td>£ {{ $Timesheets->calculated_amount }}</td>
                            </tr>    
                            <tr>
                                <th>Comments:</th>
                                <td>{{ $Timesheets->comments }}</td>
                            </tr>    
                            <tr>
                                <th>Signature</th>
                                <td><img class="profile img-circle" src="/public/uploads/sig/{{$Timesheets->signature}}" width="100" height="100"></td>
                            </tr>    
                            </tbody>                
                        </table>
                    </div>
                    <div class="card card-primary col-md-4" style="margin-left: 50px;">
                        <div class="card-header">
                            <h3 class="card-title">Shift Details</h3>
                        </div>
                        <table class="table table-nobordered">
                            <tbody>
                            <tr>
                                <th>Job title:</th>
                                <td>{{ $Timesheets->job_name->title }}</td>
                            </tr> 
                            <tr>
                                <th>Date</th>
                                <td>{{ date("d/m/Y", strtotime($Timesheets->date_from))}}</td>
                            </tr>    
                                <th>Job time:</th>
                                <td>{{ date("H:i", strtotime($Timesheets->job_name->time_from))}} -  {{ date("H:i", strtotime($Timesheets->job_name->time_to))}}</td>

                            </tr>
                            <tr>
                                <th>Rate per hour:</th>
                                <td>£ {{ $Timesheets->rate }}</td>    
                                                           
                            </tr>
                            <tr>
                                <th>Job total amount:</th>
                                <td>£ {{ $Timesheets->job_amount }}</td>
                            </tr>    
                            <!-- <tr>
                                <th>Comments:</th>
                                <td><img style='margin-left: 150px'class="profile img-circle" src="/public/uploads/signature/{{$Timesheets->signature}}" width="100" height="100"></td>
                            </tr>     -->
                            <!-- <tr>
                                <th><button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModalCenter">Signature</button></th>
                            </tr>     -->
                            
                            </tbody>                
                        </table>
                    </div>    
                </div>              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
</section>
    <!-- /.content -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <section class="content-header">
        <!-- /.container-fluid -->
        </section>
                    <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">Signature of {{ $Timesheets->user_name->name }}</h3>
        </div>
            <!-- /.card-header -->
            <!-- form start -->
        
        <div class="card-body">
        @if($Timesheets->signature)
            <img style='margin-left: 150px'class="profile img-circle" src="/public/uploads/signature/{{$Timesheets->signature}}" width="100" height="100">
        @endif
        </div>
                <!-- /.card -->
    </div>
  </div>
</div>
@endsection



