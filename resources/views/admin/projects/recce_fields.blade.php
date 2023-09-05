<button onclick="createRecceLineItem();" type="button" style="margin-bottom: 5px;" class="btn pull-right btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i>&nbsp;Add <u>R</u>ow</button>
<table class="table table-bordered table-striped " id="recce-table">
    <thead>
    <tr>
        <!-- <th>Sr.</th> -->
        <th style="width: 10%">Day</th>
        <th>Duration</th>
        <th>Scene</th>
        <th>Location</th>
        <th>Camera</th>
        <th>Cast</th>
        <th>Art</th>
        <th>Short Desc</th>
        <th>Notes</th>
        <th>Image</th>
        <th>Remove</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
    <?php  $recce_counter=0; ?>

    <input type="hidden" id="recce_line_item-global_counter" value="<?php  echo ++$recce_counter ?>"   />

</table>