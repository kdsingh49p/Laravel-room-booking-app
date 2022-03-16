<label><br>
    <strong>Total: <?= $addon->total() ?></strong>
</label>
<div class="table-responsive  c-table-responsive">
    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
        width="100%" style="border: 1px solid #dee2e6;">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sr.No.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Actions</th>

            </tr>
        </tfoot>
        <tbody>

            <?php if (count($addon) > 0): ?>

            <?php
            $sr = $addon->firstItem();
            
            ?>

            @foreach ($addon as $key => $item)
                <tr>
                    <td class="table-text">
                        {{ $sr }}
                    </td>
                    <td class="table-text">
                        {{ $item->title }}
                    </td>
                    <td class="table-text">
                        {{ $item->price }}
                    </td>
                    <td width="150">

                        <a target="_blank" href="<?= url('addon/update/') ?>/<?= $item->addon_id ?>">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        <!--     <a href="javascript:;" link="<?= url('addon/delete/') ?>/<?= $item->addon_id ?>" class="delete" >
                <i class="fa fa-trash"></i> Delete
            </a> -->
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
<?php if (count($addon) > 0): ?>
{{ $addon->links() }}
<?php endif ?>
