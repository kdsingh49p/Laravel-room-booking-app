<?php
$item = $disease;
?>
<div class="table-responsive">
</div>
<table class="table table_show" cellspacing="0" width="100%" style="border: 1px solid #dee2e6;">
    <tbody>
        <tr>
            <th style="    width: 50% !important;">Disease Name</th>
            <td style="    width: 50% !important;" class="table-text">
                <?= $item->title ?? '' ?>
            </td>
        </tr>
    </tbody>
</table>
