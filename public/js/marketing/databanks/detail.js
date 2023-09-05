/**
 * Created by mustafa.mughal on 30/01/2018.
 */

//== Class definition
var FormControls = function () {
    //== Private functions
    var token = $("input[name=_token]").val();

    var baseFunction = function () {
        $('.db-detail').hide();


     }

    var fetchContacts = function (val) {
        $('.db-basic-detail').hide();
        $('.db-detail').hide();
        $('#db-contacts').show();

        $('#dbContacts-table').DataTable().destroy();
        $('#dbContacts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url :'/marketing/contacts/datatables',
                method: 'POST',
                data:  {

                    databank_id : val,

                    _token: token
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'contact_name', name: 'contact_name' },
                { data: 'title', name: 'title' },

                { data: 'emp_name', name: 'emp_name' },

                { data: 'primary_email', name: 'primary_email' },
                { data: 'office_phone', name: 'office_phone' },
                { data: 'mobile_phone', name: 'mobile_phone' },


            ]
        });


    }


    var fetchPipelines = function (val) {
        $('.db-basic-detail').hide();
        $('.db-detail').hide();
        $('#db-pipeline').show();

        $('#db-pipeline-table').DataTable().destroy();
        $('#db-pipeline-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url :'/marketing/salepipelines/datatables',
                method: 'POST',
                data:  {
                    name:'temp',
                    databank_id : val,

                    _token: token
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'emp_name', name: 'emp_name' },
                { data: 'name', name: 'name' },
                { data: 'stage', name: 'stage' },
                { data: 'next_visit', name: 'next_visit' },
                { data: 'created_at', name: 'created_at' },



            ]
        });

    }

    var fetchHistoryPipelines = function (val) {
        $('.db-basic-detail').hide();
        $('.db-detail').hide();
        $('#db-pipeline-history').show();

        $('#db-pipeline-history-table').DataTable().destroy();
        $('#db-pipeline-history-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url :'/marketing/salepipelines/history_datatables',
                method: 'POST',
                data:  {
                    name:'temp',
                    databank_id : val,

                    _token: token
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'emp_name', name: 'emp_name' },
                { data: 'name', name: 'name' },
                { data: 'stage', name: 'stage' },
                { data: 'created_at', name: 'created_at' },

            ]
        });

    }


    var fetchHistoryComplaints = function (val) {
        $('.db-basic-detail').hide();
        $('.db-detail').hide();
        $('#db-complain-history').show();

        $('#db-complain-history-table').DataTable().destroy();
        $('#db-complain-history-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url :'/support/complaints/history_datatables',
                method: 'POST',
                data:  {
                    title:'temp',
                    databank_id : val,
                    _token: token
                }
            },
            columns: [
                { data: 'id', name: 'id' },

                { data: 'products_name', name: 'products_name' },
                { data: 'emp_name', name: 'emp_name' },
                { data: 'title', name: 'title' },
                { data: 'person_called', name: 'person_called' },
                { data: 'state', name: 'state' },
                { data: 'created_at', name: 'created_at' },


            ]
        });

    }


    var fetchComplaints = function (val) {
        $('.db-basic-detail').hide();
        $('.db-detail').hide();
        $('#db-complain').show();

        $('#db-complain-table').DataTable().destroy();
        $('#db-complain-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url :'/support/complaints/datatables',
                method: 'POST',
                data:  {
                    title:'temp',
                    databank_id : val,
                    _token: token
                }
            },
            columns: [
                { data: 'id', name: 'id' },

                { data: 'products_name', name: 'products_name' },
                { data: 'emp_name', name: 'emp_name' },
                { data: 'title', name: 'title' },
                { data: 'person_called', name: 'person_called' },
                { data: 'state', name: 'state' },
                { data: 'created_at', name: 'created_at' },


            ]
        });

    }

    return {
        // public functions
        init: function() {
            baseFunction();
        },
        fetchContacts :fetchContacts,
        fetchPipelines: fetchPipelines,
        fetchHistoryPipelines: fetchHistoryPipelines,
        fetchHistoryComplaints :fetchHistoryComplaints,
        fetchComplaints: fetchComplaints
    };
}();

jQuery(document).ready(function() {
    FormControls.init();
});