<label><br>
    <strong>Total: <?= $company->total() ?></strong>
</label>
<div class="table-responsive  c-table-responsive">
    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
        width="100%" style="border: 1px solid #dee2e6;">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sr.No.</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </tfoot>
        <tbody>

            <?php if (count($company) > 0): ?>

            <?php
            $sr = $company->firstItem();
            
            ?>

            @foreach ($company as $key => $item)
                <tr>
                    <td class="table-text">
                        {{ $sr }}
                    </td>
                    <td class="table-text">
                        {{ $item->title }}
                    </td>
                    <td width="150">

                        <a target="_blank" href="<?= url('company/update/') ?>/<?= $item->company_id ?>">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        <a href="javascript:;" link="<?= url('company/delete/') ?>/<?= $item->company_id ?>"
                            class="delete">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php
                $sr++;
                ?>
            @endforeach
            <?php endif ?>

        </tbody>
    </table>
</div>
<?php if (count($company) > 0): ?>
{{ $company->links() }}
<?php endif ?>
