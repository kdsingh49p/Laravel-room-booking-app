<div class="table-responsive  c-table-responsive">
    <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
        width="100%" style="border: 1px solid #dee2e6;">

        <!-- Table Headings -->
        <thead>
            <!-- <th>Sr.</th> -->
            <th>Title</th>

            <th>&nbsp;</th>
        </thead>

        <!-- Table Body -->
        <tbody class="item_row_add">
            <?php if (count($mop) > 0): ?>


            @foreach ($mop as $key => $mop_value)
                <tr>
                    <td class="table-text">
                        <div>{{ $mop_value->title }}</div>
                    </td>
                    <td width="150">
                        <a href="javascript:;" id="{{ $mop_value->mode_of_payment_id }}"
                            class="custom_btn_edit action_delete">
                            <i class="fa   fa-trash"></i> Delete
                        </a>
                        <a id="{{ $mop_value->mode_of_payment_id }}" style="margin-left:10px;"
                            href="javascript:;" class=" custom_btn_edit action_edit">
                            <i class="fa   fa-edit"></i> Edit
                        </a>
                    </td>

                </tr>
            @endforeach
            <?php else: ?>
            <p>No Records Found</p>
            <?php endif ?>
        </tbody>
    </table>
</div>

<?php if (count($mop) > 0): ?>
{{ $mop->links() }}
<?php endif ?>
