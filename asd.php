<?php
include 'head.php';
?>

<table id="table-pagination" data-url="data2.json" data-height="400" data-pagination="true" data-search="true">
    <thead>
        <tr>
            <th data-field="state" data-checkbox="true"></th>
            <th data-field="id" data-align="right" data-sortable="true">Item ID</th>
            <th data-field="name" data-align="center" data-sortable="true">Item Name</th>
            <th data-field="price" data-sortable="true" data-sorter="priceSorter">Item Price</th>
        </tr>
    </thead>
</table>
