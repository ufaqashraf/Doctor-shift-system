
var FormControls = function () {
    //== Private functions

    var baseFunction = function () {
       
        $(".datepicker").datepicker({ format: 'dd/mm/yyyy' });
        $( "#validation-form" ).validate({
            // define validation rules
            errorElement: 'span',
            errorClass: 'help-block',
            orientation: "bottom",
            rules: {
                employee_id: {
                    required: true
                },
                year: {
                    required: true
                },
                name: {
                    required: true
                },
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

    var applicants = function( job_id){

        console.log('Job Id : ', job_id);
        $('#grade_details tbody').html('');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'home/applicants/'+job_id,
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
            html += '<td> <a target="_blank" class= "btn btn-sm btn-success" href=/admin/doc_profile/'+data[i].user_id+'>'+ data[i].name +'</td>';
            html += '<td>'+ data[i].gmc  +'</td>';
            html += '<td>'+ data[i].email +'</td>';
            html += '<td>'+ data[i].mobile +'</td>';
            html += '<td>'+ data[i].grade +'</td>';
            html += '<td> <a class= "btn btn-sm btn-primary" href="/admin/application/change_status/'+data[i].app_id+'/2">'+'Hire'+'</td>';
        
        }
        $('#grade_details tbody').html(html);

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
        var shift_start_time = $('#time_from').val();
        var shift_end_time = $('#time_to').val();

        // console.log('shift_start_time : ',shift_start_time  )
        $('#edu-history-table tbody').html('');
       var  global_counter = 1;
        // var global_counter = parseInt($('#line_item-global_counter').val());
        if( global_counter <= parseInt (vac)  ){
            while ( global_counter <= parseInt(vac)  ){

                var line_item = $('#line_item-container').html().replace(/########/g, '').replace(/######/g, global_counter);

                $('#edu-history-table tbody').append(line_item);
                // $('#line_item-passing_date-'+global_counter).datepicker({ format: 'yyyy-mm-dd' });
                $('#line_item-time_from-'+global_counter).val(shift_start_time);
                $('#line_item-time_to-'+global_counter).val(shift_end_time);
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


    return {
        // public functions
        init: function() {
            baseFunction();
        },
        createLineItem : createLineItem,
        destroyLineItem : destroyLineItem,
        vacancyfields : vacancyfields,
        applicants : applicants
        
    };
}();

jQuery(document).ready(function() {
    FormControls.init();

});