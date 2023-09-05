/**
 * Created by mustafa.mughal on 30/01/2018.
 */

//== Class definition
var FormControls = function () {
    //== Private functions

    var baseFunction = function () {

        if( branch != 0 ){
            fetchTerritory(branch);
           // console.log('branch exist');
        }
        $( "#validation-form" ).validate({
            // define validation rules
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                name: {
                    required: true,
                    maxlength : 50
                },
                grade: {
                    required: true
                },
                sector: {
                    required: true
                },
                industry: {
                    required: true
                },
                branch: {
                    required: true
                },

                territory: {
                    required: true
                },
                office_phone: {
                    maxlength : 15
                },

                
                website: {
                    maxlength : 100
                },
                fax: {
                    maxlength : 15
                },
                primary_email: {
                    maxlength : 50
                },
                secondary_email: {
                    maxlength : 50
                },
                ntn_no: {
                    maxlength : 20
                },
                gst_no: {
                    maxlength : 20
                },
                contact_first_name: {
                    maxlength : 20
                },
                contact_last_name: {
                    maxlength : 20
                },
                contact_office_phone: {
                    maxlength : 15
                },
                contact_mobile_phone: {
                    maxlength : 15
                },
                contact_title: {
                    maxlength :50
                },
                contact_department: {
                    maxlength : 50
                },
                street: {
                    maxlength : 200
                },
                city: {
                    maxlength : 90
                },
                state: {
                    maxlength : 90
                },
                postal_code: {
                    maxlength : 90
                },
                country: {
                    maxlength : 90
                }

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


    var fetchTerritory = function (val) { 
        var prev_ter = $('#prev_ter').val();
        // console.log('prev_branch : ',allRegionBranches )

        for(var j=0; j < allRegionBranches.length; j++){
            if( allRegionBranches[j].id == val){
            //    console.log('region :',allRegionBranches[j].region_id);
                $('#region').val(allRegionBranches[j].region_id);
            }
        }

        var html = '';
        html += '<option value="">Select Territory </option>';

        if(val){

            for(var i=0; i < allTerritory.length; i++){

                if(allTerritory[i].branch_id == val){
                    var selected = '';
                    if(prev_ter == allTerritory[i].id){
                        selected = 'selected';
                    }
                    html += '<option value='+ allTerritory[i].id + ' '+ selected + '>'+    allTerritory[i].name +'</option>';
                }

            }

        }

        $('#territory').html('');

        $('#territory').append(html);
    }

    return {
        // public functions
        init: function() {
            baseFunction();
        },
        fetchTerritory: fetchTerritory
    };
}();

jQuery(document).ready(function() {
    FormControls.init();
});