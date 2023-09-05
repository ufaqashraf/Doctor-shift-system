<button onclick="FormControls.createCastLineItem();" type="button" style="margin-bottom: 5px;" class="btn pull-right btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i>&nbsp;Add <u>R</u>ow</button>
<table class="table table-bordered table-striped " id="cast-calls-table">
    <thead>
        <tr>
                <!-- <th>Sr.</th> -->
                <th>Name</th>
                <th>Artist Name/Role</th>
                <th>Call Time</th>
                <th>Call To</th>
                <th>S/By</th>
                <th>Screen Notes</th>
                <th>Remove</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <?php  $cast_counter=0; ?>
            
            <input type="hidden" id="cast_line_item-global_counter" value="<?php  echo ++$cast_counter ?>"   />

</table>