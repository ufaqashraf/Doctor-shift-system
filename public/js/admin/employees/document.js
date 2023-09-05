/**
 * Created by abubakar.siddiq on 10/19/2018.
 */

//== Class definition
var FormControls = function () {
    //== Private functions

    var baseFunction = function () {
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

    var createLineItem = function () {
        var global_counter = parseInt($('#line_item-global_counter').val()) + 1;

        var line_item = $('#line_item-container').html().replace(/########/g, '').replace(/######/g, global_counter);

        $('#document-table tbody').prepend(line_item);
        $('#line_item-edu_year-'+global_counter).datepicker({ format: 'yyyy-mm-dd' });
        // Apply Select2 on newly created item
       // $('#line_items-databank_id-'+global_counter).select2(Select2AjaxObj());
        $('#line_item-global_counter').val(global_counter)
        $('#line_item-sr_no-'+global_counter).val(global_counter-1)
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
    };
}();

jQuery(document).ready(function() {
    FormControls.init();
});