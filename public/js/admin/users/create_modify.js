
//== Class definition
var FormControls = function () {
    //== Private functions

    var baseFunction = function () {
console.log('Hello users');

        $( "#validation-form" ).validate({
            // define validation rules
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                name: {
                    required: true
                },
                // 'permission[]': {
                //     required: true
                // },
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "parent_id") {
                    error.insertAfter($('#parent_id_handler'));
                } else {
                    error.insertAfter(element);
                }
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
        });
    }

    var unsetElementColor = function(selector){

        $(selector).removeClass('active');
        $(selector).removeClass('btn-info');
        $(selector).addClass('btn-default');
    }

    var getHospitalDepartments = function(h_id){
        console.log('Hello : ', h_id.value);
        var hospital_id = h_id.value;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get_dept_data',
            type: 'POST',
            data: {
                hospital_id : hospital_id,
            },
            // success: function( data, textStatus, jQxhr ){
            success: function( data){
            var options='<option value=""> Select a Department</option>';

                $.each(data, function( index, value ) {
                    options += '<option value="'+index+'">'+ value +'</option>'
                });

                $('#dept_id').html(options);
                console.log('data : ', data);
                if(data.length>0){
                    // appendScheduleData( data);
                }

                // if(data.status){
                //     alert('Data saved');
                // }else{
                //     alert('Something  went wrong!');
                // }
            }

        });

    }

    return {
        // public functions
        init: function() {
            baseFunction();
        },
        getHospitalDepartments :getHospitalDepartments,
        unsetElementColor : unsetElementColor,
    };
}();

jQuery(document).ready(function() {
    FormControls.init();
});

// jQuery(function () {
//
//     FormControls.init();
// });