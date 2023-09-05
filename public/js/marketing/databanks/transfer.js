
var FormControls = function () {
    var token = $("input[name=_token]").val();
    var checkedArray = [];

    var baseFunction = function () {

        $("#checkAll").click(function () {

            $('input:checkbox').not(this).prop('checked', this.checked);
            if(this.checked){

                $( ".databanks" ).each(function() {
                    var curr_databank = $( this ).val();
                    var index =  checkedArray.indexOf(curr_databank);
                    if(index == -1){
                        checkedArray.push(curr_databank);
                    }

                });

            }else{
                checkedArray = [];
            }
            $('#selectedDatabanks').val(checkedArray);
        });

    }

    var checkboxChange =  function (val)
    {

        var isChecked = val.checked;
        var index =  checkedArray.indexOf(val.value);
        if (isChecked) {

            if(index == -1){
                checkedArray.push(val.value);
            }

        } else {
            checkedArray.splice(index, 1);
            $('#checkAll').prop('checked', false);
        }
        $('#selectedDatabanks').val(checkedArray);
    }

    var fetchFilterRecord = function () {

        var user_id = $('#transfer_from').val();

        $('#users-table').DataTable().destroy();
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url :'transfer_datatables',
                method: 'POST',
                data:  {
                    name : 'temp',
                    user_id : user_id,
                    transfer : 'Y',
                    _token: token
                }
            },
            columns: [
                { data: 'action', name: 'action' , orderable: false, searchable: false},
                { data: 'id', name: 'id' },
                { data: 'emp_name', name: 'emp_name' },
                { data: 'name', name: 'name' },
                { data: 'office_phone', name: 'office_phone' },
                { data: 'industry', name: 'industry' },
                { data: 'ter_name', name: 'ter_name' },
                { data: 'sector', name: 'sector' },
                { data: 'branch', name: 'branch' },
                { data: 'grade', name: 'grade' },
                { data: 'primary_email', name: 'primary_email' },
                { data: 'created_at', name: 'created_at' },


            ]
        });

    }

    return {
        // public functions
        init: function() {
            baseFunction();
        },

        fetchFilterRecord : fetchFilterRecord,
        checkboxChange : checkboxChange

    };
}();

jQuery(document).ready(function() {
    FormControls.init();
});