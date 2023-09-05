
var FormControls = function () {
    var token = $("input[name=_token]").val();

    $('.select2').select2();
    var baseFunction = function () {

            $('#users-table').DataTable({
                order: [[ 1, "desc" ]],
                processing: true,
                serverSide: true,
                ajax: {
                    url :'daps/datatables',
                    method: 'POST',
                    data:  {
                        name : 'temp',
                        _token: token
                    }
                },
                columns: [
                { data: 'rownum', name: 'rownum',orderable: true },

                { data: 'daps_date', name: 'daps_date' },
                { data: 'emp_name', name: 'emp_name' },
                { data: 'start_time', name: 'start_time' },
                { data: 'end_time', name: 'end_time' },
                { data: 'description', name: 'description' },

                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' , orderable: false, searchable: false},

            ]
        });



        // for a ceo get sub regions
        if(job_title == 1 || job_title == 2 || job_title == 21){

            fetchsalesman(0,0,0);
            $('#branch').html('');
            var html = '';
            html += '<option value="">Select branch </option>';
            $('#branch').append(html);
        }
        // for region manager get sub branch
        else if(job_title == 22 || job_title==16){
            $('#region_div').hide();
            fetchsalesman(region_id,0,0);
            $('#branch').html('');
            var html = '';
            html += '<option value="">Select branch </option>';
            for(var i=0; i < allBranches.length; i++){
                var selected = '';
                html += '<option value='+ allBranches[i].id + ' '+ selected + '>'+    allBranches[i].name +'</option>';
            }
            $('#branch').append(html);
        }// for branch manager get sub territor
        else if(job_title == 23){
            $('#region_div').hide();
            $('#branch_div').hide();
            $('#territory').html('');
            var emp_branch = $('#emp_branch').val();
            //   console.log('emp_branch :',  emp_branch);
            fetchsalesman(0,emp_branch,0);
            var html = '';
            html += '<option value="">Select Territory </option>';
            for(var i=0; i < allTerritory.length; i++){
                var selected = '';
                if(allTerritory[i].branch_id == emp_branch){
                    html += '<option value='+ allTerritory[i].id + ' '+ selected + '>'+    allTerritory[i].name +'</option>';
                }
            }
            $('#territory').append(html);
        }
        else if(job_title == 24){
            $('#region_div').hide();
            $('#branch_div').hide();
            $('#terr_div').hide();
            var emp_terr = $('#emp_terr').val();

            fetchsalesman(0,0,emp_terr);
        }// marketing executive
        else{
            $('#region_div').hide();
            $('#branch_div').hide();
            $('#terr_div').hide();
            $('#user_div').hide();
            $('#search_button').hide();

        }

    }

    var fetchTerritory = function (val) {
        fetchsalesman(0,val,0);
        $('#territory').html('');
        var html = '';
        html += '<option value="">Select Territory </option>';
        if(val){
            for(var i=0; i < allTerritory.length; i++){

                if(allTerritory[i].branch_id == val){
                    html += '<option value='+ allTerritory[i].id + '>'+    allTerritory[i].name +'</option>';
                }

            }

        }
        else{
            if(region_id){
                fetchsalesman(region_id,0,0);
            }else{
                var region = $('#region').val();
                fetchsalesman(region,0,0);
            }

        }
        $('#territory').append(html);
    }

    var fetchsalesman = function (region_id , branch_id, territory_id ) {
        //console.log('fetchsalesman : ',region_id, branch_id, territory_id);
        $('#user_id').html('');

        if( region_id == 0 && branch_id != 0 &&  territory_id == 0){

            var html = '';
            html += '<option value="">Select Territory Manager </option>';
            for (var i=0; i < allSalesman.length ; i++){
                if( allSalesman[i].branch_id == branch_id &&  allSalesman[i].job_title == 24){
                    html += '<option value='+ allSalesman[i].user_id +'>'+ allSalesman[i].first_name +'</option>';
                }
            }

        }

        if( region_id == 0 && branch_id == 0 &&  territory_id != 0){

            var html = '';
            html += '<option value="">Select Marketing Executive </option>';
            for (var i=0; i < allSalesman.length ; i++ ){
                if( allSalesman[i].territory_id == territory_id && allSalesman[i].job_title == 25){
                    html += '<option value='+ allSalesman[i].user_id + '>'+ allSalesman[i].first_name +'</option>';
                }
            }

        }
        if( region_id != 0 && branch_id == 0 &&  territory_id == 0){
            var html = '';
            html += '<option value="">Select Branch Manager </option>';
            for (var i=0; i < allSalesman.length ; i++ ){
                if( allSalesman[i].region_id == region_id && allSalesman[i].job_title == 23){
                    html += '<option value='+ allSalesman[i].user_id + '>'+ allSalesman[i].first_name +'</option>';
                }
            }
        }

        if( region_id == 0 && branch_id == 0 &&  territory_id == 0){
            var html = '';
            html += '<option value="">Select Region Manager </option>';
            for (var i=0; i < allSalesman.length ; i++ ){
                if(  allSalesman[i].job_title == 22){
                    html += '<option value='+ allSalesman[i].user_id + '>'+ allSalesman[i].first_name +'</option>';
                }
                // if ceo or secretray ceo
                if(job_title == 1 || job_title == 2){
                    if(  allSalesman[i].job_title == 21){
                        html += '<option value='+ allSalesman[i].user_id + '>'+ allSalesman[i].first_name +'</option>';
                    }
                }

            }
        }

        $('#user_id').append(html);
    }

    var territoryChange = function (val) {
        if(val){
            fetchsalesman(0,0,val);
        }else {
            var branch = $('#branch').val();
            if(branch != 0 ){
                fetchsalesman(0,branch,0);

            }else{
                var emp_branch = $('#emp_branch').val();
                fetchsalesman(0,emp_branch,0);
            }
        }

    }
    var fetchBranches = function(val) {
        fetchsalesman(val, 0, 0);
        $('#territory').html('<option value="">Select Territory</option>');
        $('#branch').html('');
        var html = '';
        html += '<option value="">Select branch </option>';

        for (var i = 0; i < allBranches.length; i++) {
            var selected = '';
            if (allBranches[i].region_id == val) {
                html += '<option value=' + allBranches[i].id + ' ' + selected + '>' + allBranches[i].name + '</option>';
            }
        }

        $('#branch').append(html);

    }

    var fetchFilterRecord = function () {

        var user_id = $('#user_id').val();

        $('#users-table').DataTable().destroy();
        $('#users-table').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url :'daps/datatables',
                method: 'POST',
                data:  {
                    name : 'temp',
                    user_id : user_id,
                    _token: token
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'daps_date', name: 'daps_date', orderable: true },
                { data: 'emp_name', name: 'emp_name' },
                { data: 'start_time', name: 'start_time' },
                { data: 'end_time', name: 'end_time' },
                { data: 'description', name: 'description' },

                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' , orderable: false, searchable: false},

            ]
        });

    }

    return {
        // public functions
        init: function() {
            baseFunction();
        },

        fetchFilterRecord : fetchFilterRecord,
        fetchTerritory : fetchTerritory,
        territoryChange : territoryChange,
        fetchBranches: fetchBranches,
        fetchsalesman : fetchsalesman


    };
}();

jQuery(document).ready(function() {
    FormControls.init();
});