/**
 * Created by abubakar.siddiq on 10/19/2018.
 */

//== Class definition
var FormControls = function () {
    //== Private functions

    var baseFunction = function () {
        var days_of_shooting = parseInt($('#days_of_shooting').val());
        for(var i=1;i<=days_of_shooting;i++){
            
            var date_value = $('#day_item-day_date-'+i).val();
            var main_unit = $('#day_item-main_unit-'+i).val();
            if(!date_value || !main_unit){
                console.log('i is null:', i, date_value, main_unit);
                $('#actionButtons-'+i).hide();
            }
        }
        // console.log('days_of_shooting : ',days_of_shooting);
        $(".datepicker").datepicker({ format: 'yyyy-mm-dd' });
        $( "#validation-form" ).validate({
            // define validation rules
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {

            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
        });
    }

    var openScheduleModal =  function(day, project_id){

        $('#schedule_line_item-global_counter').val(0);
        $('#schedule-table tbody').html('');
        $('#scheduleModal').modal('show');

        loadScheduleData(day, project_id);
        $('#schedule_day_no').val(day);
        $("#scheduleModalHeader").text("Shooting Schedule of Day "+day);

    }


    var loadScheduleData= function(day_no, project_id){
        
                $.ajax({
             headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url: route('admin.projects.get_schedule_data'),
                type: 'POST',
                data: {
                    project_id: project_id,
                    day_no: day_no,
                                        
                },
                // success: function( data, textStatus, jQxhr ){
                    success: function( data){
                    console.log('data : ', data);
                    if(data.length>0){
                        appendScheduleData( data);    
                    }
                    
                    // if(data.status){
                    //     alert('Data saved');
                    // }else{
                    //     alert('Something  went wrong!');
                    // }
                }
                
            });

    }

    var appendScheduleData =  function(scheduleData){
       var htmlData = '';
       var base =window.location.origin;
        for(var i=1; i<= scheduleData.length; i++){


           htmlData += '<tr id="schedule_line_item-'+i+'"><td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="schedule_line_item-duration-'+i+'" value="'+scheduleData[i-1].duration+'" class="form-control" placeholder="" maxlength="50" required="" name="schedule_line_items[duration]['+i+']" type="text">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="schedule_line_item-scene-'+i+'" value="'+scheduleData[i-1].scene+'" class="form-control" placeholder="" maxlength="50" required="" name="schedule_line_items[scene]['+i+']" type="text">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="schedule_line_item-camera-'+i+'" value="'+scheduleData[i-1].camera+'" class="form-control" placeholder="" maxlength="50" required="" name="schedule_line_items[camera]['+i+']" type="text">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="schedule_line_item-cast-'+i+'" value="'+scheduleData[i-1].cast+'" class="form-control" placeholder="" maxlength="50" required="" name="schedule_line_items[cast]['+i+']" type="text">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="schedule_line_item-art-'+i+'" value="'+scheduleData[i-1].art+'" class="form-control" placeholder="" maxlength="50" required="" name="schedule_line_items[art]['+i+']" type="text">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="schedule_line_item-short_desc-'+i+'"  value="'+scheduleData[i-1].short_desc+'" class="form-control" placeholder="" maxlength="50" required="" name="schedule_line_items[short_desc]['+i+']" type="text">';
            htmlData +='</div></div></td>';


            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="schedule_line_item-screen_notes-'+i+'"  value="'+scheduleData[i-1].screen_notes+'" class="form-control" placeholder="" maxlength="50" required="" name="schedule_line_items[screen_notes]['+i+']" type="text">';
            htmlData +='</div></div></td>';


            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<a href="'+base+'/'+scheduleData[i-1].image+'" target="_blank"> <img src="'+base+'/'+scheduleData[i-1].image+'" height="42" width="43"> </a>';
            htmlData +='<input id="schedule_line_item-file_location-'+i+'"   name="schedule_line_items[file_location]['+i+']" type="hidden" value="'+scheduleData[i-1].image+'">';

            htmlData +='</div></div></td>';

            htmlData +='<td><button id="schedule_line_item-del_btn-'+i+'" onclick="FormControls.destroyCastLineItem('+i+');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>';
            htmlData +='</tr>';
        }

        $('#schedule-table tbody').html(htmlData);
        $('#schedule_line_item-global_counter').val(i)

    }


    var createScheduleLineItem =  function(){
        var global_counter = parseInt($('#schedule_line_item-global_counter').val()) + 1;
        var schedule_line_item = $('#schedule_line_item-container').html().replace(/########/g, '').replace(/######/g, global_counter);

        $('#schedule-table tbody').append(schedule_line_item);
        $('#schedule_line_item-global_counter').val(global_counter)
    } 

 var destroyScheduleLineItem = function (itemId) {
        var r = confirm("Are you sure to delete Line Item?");
        if (r == true) {
            
            $('#schedule_line_item-'+itemId).remove();
        }
    }

 var openCastModal= function(day, project_id){
        $('#cast_line_item-global_counter').val(0);
        $('#cast-calls-table tbody').html('');
        $('#castModal').modal('show');

         loadCastData(day, project_id);
        $('#cast_day_no').val(day);
        $("#castModalHeader").text("Cast Calls of Day "+day);
    }

    var loadCastData= function(day_no, project_id){
        
                $.ajax({
             headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url: route('admin.projects.get_cast_data'),
                type: 'POST',
                data: {
                    project_id: project_id,
                    day_no: day_no,
                                        
                },
                // success: function( data, textStatus, jQxhr ){
                    success: function( data){
                    console.log('data : ', data);
                    if(data.length>0){
                        appendCastData( data);    
                    }
                    
                    // if(data.status){
                    //     alert('Data saved');
                    // }else{
                    //     alert('Something  went wrong!');
                    // }
                }
                
            });

    }


     var appendCastData = function(castData){
        var htmlData = '';
        for(var i=1; i<= castData.length; i++){


           htmlData += '<tr id="cast_line_item-'+i+'"><td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="cast_line_item-name-'+i+'" value="'+castData[i-1].name+'" class="form-control" placeholder="" maxlength="50" required="" name="cast_line_items[name]['+i+']" type="text">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="cast_line_item-artist_name-'+i+'" value="'+castData[i-1].artist_name+'" class="form-control" placeholder="" maxlength="50" required="" name="cast_line_items[artist_name]['+i+']" type="text">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="cast_line_item-call_time-'+i+'" value="'+castData[i-1].call_time+'" class="form-control" required="" name="cast_line_items[call_time]['+i+']" type="time">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="cast_line_item-call_to-'+i+'" value="'+castData[i-1].call_to+'" class="form-control"  required="" name="cast_line_items[call_to]['+i+']" type="time">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="cast_line_item-s_by-'+i+'" value="'+castData[i-1].s_by+'" class="form-control" placeholder="" maxlength="50" required="" name="cast_line_items[s_by]['+i+']" type="text">';
            htmlData +='</div></div></td>';

             htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="cast_line_item-screen_notes-'+i+'" value="'+castData[i-1].screen_notes+'" class="form-control" placeholder="" maxlength="50" required="" name="cast_line_items[screen_notes]['+i+']" type="text">';
            htmlData +='</div></div></td>';

            htmlData +='<td><button id="cast_line_item-del_btn-'+i+'" onclick="FormControls.destroyCastLineItem('+i+');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>';
            htmlData +='</tr>';
        }
        $('#cast-calls-table tbody').html(htmlData);
        $('#cast_line_item-global_counter').val(i)

    }


   var createCastLineItem = function () {
        var global_counter = parseInt($('#cast_line_item-global_counter').val()) + 1;
        var cast_line_item = $('#cast_line_item-container').html().replace(/########/g, '').replace(/######/g, global_counter);

        $('#cast-calls-table tbody').append(cast_line_item);
        $('#cast_line_item-global_counter').val(global_counter)
    }
   var destroyCastLineItem = function (itemId) {
        var r = confirm("Are you sure to delete Line Item?");
        if (r == true) {
            
            $('#cast_line_item-'+itemId).remove();
        }
    }


    var createLineItem = function () {
        var global_counter = parseInt($('#unit_line_item-global_counter').val()) + 1;
        var unit_line_item = $('#unit_line_item-container').html().replace(/########/g, '').replace(/######/g, global_counter);

        $('#unit-calls-table tbody').append(unit_line_item);
        $('#unit_line_item-global_counter').val(global_counter);
    }

    var destroyLineItem = function (itemId) {
        var r = confirm("Are you sure to delete Line Item?");
        if (r == true) {
            
            $('#unit_line_item-'+itemId).remove();
        }
    }

   
    var openUnitModal= function(day, project_id){
        $('#unit_line_item-global_counter').val(0);
        $('#unit-calls-table tbody').html('');
        $('#unitModal').modal('show');

        loadUnitData(day, project_id);
        $('#unit_day_no').val(day);
        $("#unitModalHeader").text("Unit Calls of Day "+day);
    }

    var loadUnitData= function(day_no, project_id){
        
                $.ajax({
             headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url: route('admin.projects.get_unit_data'),
                type: 'POST',
                data: {
                    project_id: project_id,
                    day_no: day_no,
                                        
                },
                // success: function( data, textStatus, jQxhr ){
                    success: function( data){
                    console.log('data : ', data.UnitCalls);
                    if(data.UnitCalls.length>0){
                        appendUnitData( data.UnitCalls, data.Unittype);
                    }
                    
                    // if(data.status){
                    //     alert('Data saved');
                    // }else{
                    //     alert('Something  went wrong!');
                    // }
                }
                
            });

    }

    var appendUnitData = function(unitData, unittype){

        var htmlData = '';
        console.log('Did you call me?',unittype);
        for(var i=1; i<= unitData.length; i++){

           htmlData += '<tr id="unit_line_item-'+i+'"><td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            //htmlData +='<input id="unit_line_item-unit_type-'+i+'" value="'+unitData[i-1].unit_type+'" class="form-control" placeholder="" maxlength="50" required="" name="unit_line_items[unit_type]['+i+']" type="text">';
             htmlData += '<select id="unit_line_item-unit_type-'+ i + '" class="form-control" name="unit_line_items[unit_type]['+i+']">';
            // htmlData += '';

                var selected = '';
                $.each(unittype, function ( index, value ) {
                    selected = '';
                    if(unitData[i-1].unit_type == index){
                        console.log('You got me', unitData[i-1].unit_type, value);
                        selected = 'selected';
                    }
                    htmlData += '<option value="'+ index +'" '+ selected +'>'+ value +'</option>';
                });
            htmlData += '</select>';
            // htmlData +='<input id="unit_line_item-unit_type-'+i+'" value="'+unitData[i-1].unit_type+'" class="form-control" placeholder="" maxlength="50" required="" name="unit_line_items[unit_type]['+i+']" type="text">';
            htmlData +='</div></div></td>';

            htmlData += '<td><div class="form-group" style="margin-bottom: 0px !important;"><div class="form-group" style="margin-bottom: 0px !important;">';
            htmlData +='<input id="unit_line_item-time-'+i+'" value="'+unitData[i-1].time+'" class="form-control"  required="" name="unit_line_items[time]['+i+']" type="time">';
            htmlData +='</div></div></td>';

            htmlData +='<td><button id="unit_line_item-del_btn-'+i+'" onclick="FormControls.destroyLineItem('+i+');" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>';
            htmlData +='</tr>';
        }
        $('#unit-calls-table tbody').html(htmlData);
        $('#unit_line_item-global_counter').val(i)

    }

    var saveDayInfo =  function(day, project_id){
        console.log('Day : ',day, project_id);
        var project_id = project_id;
        var day_no = $('#day_item-day_no-'+day).val();
        var day_date = $('#day_item-day_date-'+day).val();
        var main_unit = $('#day_item-main_unit-'+day).val();
        var break_fast = $('#day_item-break_fast-'+day).val();
        var lunch = $('#day_item-lunch-'+day).val();
        var dinner = $('#day_item-dinner-'+day).val();
        
        $.ajax({
             headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                url: route('admin.projects.save_day'),
                type: 'POST',
                data: {
                    project_id: project_id,
                    day_no: day_no,
                    day_date: day_date,
                    main_unit: main_unit,
                    break_fast: break_fast,
                    lunch: lunch,
                    dinner: dinner,
                    
                },
                // success: function( data, textStatus, jQxhr ){
                    success: function( data){
                    console.log('data : ', data);
                    if(data.status){
                        if(day_date && main_unit){
                            $('#actionButtons-'+day).show();    
                        }
                            
                        $('#successAlert').modal('show');                        
                    }else{
                        alert('Something  went wrong!');
                    }
                }
                
            });

        // alert('Day :', day);

    }
    return {
        // public functions
        init: function() {
            baseFunction();
        },
        createLineItem : createLineItem,
        destroyLineItem : destroyLineItem,
        saveDayInfo : saveDayInfo,
        openUnitModal : openUnitModal,
        openCastModal: openCastModal,
        createCastLineItem : createCastLineItem,
        destroyCastLineItem: destroyCastLineItem,
        openScheduleModal : openScheduleModal,
        createScheduleLineItem: createScheduleLineItem,
        destroyScheduleLineItem: destroyScheduleLineItem,
        loadScheduleData : loadScheduleData,
        appendScheduleData : appendScheduleData,

    };
}();

jQuery(document).ready(function() {
    FormControls.init();
});