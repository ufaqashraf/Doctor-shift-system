
var FormControls = function () {
    //== Private functions

    var baseFunction = function () {
       
        $(".datepicker").datepicker({ format: 'dd/mm/yyyy' });
    }
    var vacancyfields = function(){
        var hry = $('#appendFields').val();
        
        var html='';
        for(i=0; i<hry; i++){
           html += '<table><thead><tr><th>Title</th><th>Date</th><th>Time</th></tr></thead><tbody><tr><td><input name="grade_id" type="text" placeholder="Select Grade"></td><td><input name="rate" type="number" placeholder="Enter rate"></td><td><input name="time_to" type="time" placeholder="Enter Start time "></td><td><input name="time_to" type="time" placeholder="Enter End time "></td></tr></tbody></table>';
        }
    $('#user_tbl').append(html);
    }

    var createLineItem = function () {
        var vac = $('#appendFields').val();
        $('#edu-history-table tbody').html('');
       var  global_counter = 1;
        // var global_counter = parseInt($('#line_item-global_counter').val());
        if( global_counter <= parseInt (vac)  ){
            while ( global_counter <= parseInt(vac)  ){

                var line_item = $('#line_item-container').html().replace(/########/g, '').replace(/######/g, global_counter);

                $('#edu-history-table tbody').append(line_item);
                $('#line_item-passing_date-'+global_counter).datepicker({ format: 'yyyy-mm-dd' });
                global_counter++
                $('#line_item-global_counter').val(global_counter)
            }
        }
    }

    var destroyLineItem = function (itemId) {
        var r = confirm("Are you sure to delete Line Item?");
        if (r == true) {
            // $('#entry_item-ledger_id-'+itemId).select2(Select2AjaxObj());
            $('#line_item-'+itemId).remove();
            //CalculateTotal();
        }
    }

    var loadJobData= function( job_id){
        // $('.bd-example-modal-lg').display = 'block';
        // $('.modal').modal();
        console.log('Job Id : ', job_id);
        $('#grade_details tbody').html('');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'job/get_job_grades/'+job_id,
            type: 'GET',

            success: function( data){
                console.log('data 1 : ', data);

                if(data){
                    appendData( data);
                }

            }

        });

    }

    var appendData = function (data) {
        var html = '';
        for (var i=0; i < data.length; i++){
            html += '<tr>';
            html += '<td>'+  data[i].grade +'</td>';
            html += '<td>'+ data[i].rate  +'</td>';
            html += '<td>'+ data[i].from +'</td>';
            html += '<td>'+ data[i].to +'</td>';

            html += '</tr>';
        }





        $('#grade_details tbody').html(html);

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


    return {
        // public functions
        init: function() {
            baseFunction();
        },
        createLineItem : createLineItem,
        destroyLineItem : destroyLineItem,
        vacancyfields : vacancyfields,
        loadJobData : loadJobData,
        
    };
}();

jQuery(document).ready(function() {
    FormControls.init();

});