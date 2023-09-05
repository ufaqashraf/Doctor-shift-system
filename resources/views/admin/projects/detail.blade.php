@extends('layouts.app')



@section('breadcrumbs')
    <section class="content-header" style="padding: 10px 15px !important;">
        <h1>Project Detail</h1>
    </section>
@stop



@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
<style>

    #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 50px; }
    #sortable li span { position: absolute; margin-left: -1.3em; }

.w3-example {
    background-color: #f1f1f1;
    padding: 0.3em 5px;
    margin: 20px 0;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
}

.w3-code {
    width: auto;
    background-color: #fff;
    padding: 8px 12px;
    /* border-left: 4px solid #4CAF50; */
    word-wrap: break-word;
}
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}

.accordion:after {
  content: '\02795'; /* Unicode character for "plus" sign (+) */
  font-size: 13px;
  color: #777;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2796"; /* Unicode character for "minus" sign (-) */
}




</style>

<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Project Detail</h3>
            
                <a href="{{ route('admin.projects.index') }}" class="btn btn-success pull-right">Back</a>
            
        </div>
        <div class="text-center">
            <h3 style="font-weight: bold; text-decoration: underline;">{{$Project->name}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="panel-body pad table-responsive">
                <table class="table  table-bordered">
                    <tbody>
                    <tr>
                        <th class="text-center" colspan="4">Basic Information</th>
                    </tr>
                    <tr>
                        <th>Project Name:</th>
                        <td>{{ $Project->name }}</td>
                        <th>Days of Shooting:</th>
                        <td>{{ $Project->days_of_shooting }}</td>
                    </tr>
                    <tr>
                        <th>Director:</th>
                        <td>{{ $Project->director }}</td>
                        <th>Producer:</th>
                        <td>{{ $Project->producer }}</td>
                    </tr>
                    <tr>
                        <th>Map Link:</th>
                        <td colspan="3">{{ $Project->map_link }}</td>
                        
                    </tr>
                    <tr>
                        <th>Location Info : </th>
                        <td colspan="3" style="white-space: pre-line;">{{ ($Project->location_info)  }}</td>
                    </tr>
                    <tr>
                        <th>Weather Info : </th>
                        <td colspan="3" style="white-space: pre-line;">{{ $Project->weather_info }}</td>
                    </tr>
                    <tr>
                        <th>Crew Info : </th>
                        <td colspan="3" style="white-space: pre-line;">{{ $Project->crew_info }}</td>
                    </tr>
                    <tr>
                        <th>Unit Notes : </th>
                        <td colspan="3" style="white-space: pre-line;">{{ $Project->unit_notes }}</td>
                    </tr>

                    </tbody>
                </table>



<h2 class="text-center">Shooting Schedule Info</h2>

@foreach($ProjectDays as $val)
<button class="accordion">Day {{$val->day_no}}</button>
<div class="panel">
  <table class="table  table-bordered">
      <thead>
          <tr>
              <th>Date</th>
              <th>Main Unit</th>
              <th>Breakfast</th>
              <th>Lunch</th>
              <th>Dinner</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>{{$val->day_date}}</td>
              <td>{{$val->main_unit}}</td>
              <td>{{$val->break_fast}}</td>
              <td>{{$val->lunch}}</td>
              <td>{{$val->dinner}}</td>
          </tr>
      </tbody>
  </table>

<div class="w3-example">
    <h3>Unit Calls</h3>
    <div class="w3-code">
        <table class="table  table-bordered">
          <thead>
              <tr>
                  <th>Unit Type</th>
                  <th>Time</th>
                  
              </tr>
          </thead>
          <tbody>

            @foreach($UnitCalls as $unit)
            @if($unit['day_no'] == $val->day_no)
              <tr>
                  <td>{{ $unit['unit_type'] }}</td>
                  <td>{{ $unit['time'] }}</td>
                  
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>
        
    </div>
    
</div>


<div class="w3-example">
    <h3>Cast Calls</h3>
    <div class="w3-code">
        <table class="table  table-bordered">
          <thead>
              <tr>

                <th>Name</th>
                <th>Artist Name/Role</th>
                <th>Call Time</th>
                <th>Call To</th>
                <th>S/By</th>
                <th>Screen Notes</th>
                  
              </tr>
          </thead>
          <tbody>

            @foreach($CastCalls as $cast)

            @if($cast->day_no == $val->day_no)
              <tr>
                  <td>{{ $cast->name }}</td>
                  <td>{{ $cast->artist_name }}</td>
                  <td>{{ $cast->call_time }}</td>
                  <td>{{ $cast->call_to }}</td>
                  <td>{{ $cast->s_by }}</td>
                  <td>{{ $cast->screen_notes }}</td>
                  
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>
    </div>
    
</div>

<div class="w3-example">
    <h3>Shooting Schedule</h3>
    <div class="w3-code">
        <table class="table  table-bordered">
          <thead>
              <tr>

                <th>Duration</th>
                <th>Scene</th>
                <th>Camera</th>
                <th>Cast</th>
                <th>Art</th>
                <th>Short Desc</th>
                <th>Notes</th>
                <th>Image</th>
                  
              </tr>
          </thead>
          <tbody>

            @foreach($Schedule as $sch)

            @if($sch->day_no == $val->day_no)
              <tr>
                  <td>{{ $sch->duration }}</td>
                  <td>{{ $sch->scene }}</td>
                  <td>{{ $sch->camera }}</td>
                  <td>{{ $sch->cast }}</td>
                  <td>{{ $sch->art }}</td>
                  <td>{{ $sch->short_desc }}</td>
                  <td>{{ $sch->screen_notes }}</td>
                  <td> <img src="{{$sch->image}}" height="42" width="42"> </td>
                  
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>
    </div>
    
</div>

</div>
@endforeach

            <ul id="sortable" style="display: none;">
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
                <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
            </ul>


        </div>
</div>
@stop

@section('javascript')

<script>


    $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    } );

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}


</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection