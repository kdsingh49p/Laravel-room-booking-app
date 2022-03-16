<label><br>
    <strong>Total: <?= $users->total() ?></strong>
</label>
<div class="table-responsive  c-table-responsive">
    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
        width="100%" style="border: 1px solid #dee2e6;">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sr.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </tfoot>
        <tbody>

            <?php if (count($users) > 0): ?>

            <?php
            $sr = $users->firstItem();
            
            ?>

            @foreach ($users as $key => $item)
                <tr>
                    <td class="table-text">
                        {{ $sr }}
                    </td>
                    <td class="table-text">
                        {{ $item->name }}
                    </td>
                    <td class="table-text">
                        {{ $item->email }}
                    </td>
                    <td>
                        *******
                    </td>
                    <td width="150">

                        <a target="_blank" href="<?= url('user-register/update/') ?>/<?= $item->id ?>">
                            <i class="fa fa-pencil"></i> Edit
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
<?php if (count($users) > 0): ?>
{{ $users->links() }}
<?php endif ?>
