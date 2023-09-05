<button onclick="FormControls.createLineItem();" type="button" style="margin-bottom: 5px;" class="btn pull-right btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i>&nbsp;Add <u>R</u>ow</button>
<table class="table table-bordered table-striped " id="unit-calls-table">
    <thead>
        <tr>
                <th>Unit Type</th>
                <th>Time</th>
                 
                <th>Remove</th>


        </tr>
    </thead>
    <tbody>
        
    </tbody>
    <?php  $counter=0 ?>
     <input type="hidden" id="unit_line_item-global_counter" value="<?php  echo ++$counter ?>"   />

</table>