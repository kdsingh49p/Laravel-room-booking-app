<label><br>
    <strong>Total: <?= $patient->total() ?></strong>
</label>
<div class="table-responsive  c-table-responsive">
    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
        width="100%" style="border: 1px solid #dee2e6;">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Reg no</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Gender</th>
                <th>IPD No</th>
                <th>Admission Date</th>
                <th>Checkin</th>
                <th>Checkout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sr.No.</th>
                <th>Reg no</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Gender</th>
                <th>IPD No</th>
                <th>Admission Date</th>
                <th>Checkin</th>
                <th>Checkout</th>
                <th>Actions</th>
            </tr>
        </tfoot>
        <tbody>

            @if (count($patient) > 0)
                <?php
                $sr = $patient->firstItem();
                ?>

                @foreach ($patient as $key => $item)
                    <tr>
                        <td class="table-text">
                            {{ $sr }}
                        </td>
                        <td class="table-text">
                            {{ $item->patient_reg_no }}
                        </td>
                        <td class="table-text">
                            {{ $item->patient_name }}
                        </td>
                        <td class="table-text">
                            {{ $item->patient_phone }}
                        </td>
                        <td class="table-text">
                            {{ $item->patient_age }}
                        </td>
                        <td class="table-text">
                            {{ $item->patient_gender }}
                        </td>
                        <td class="table-text">
                            {{ $item->ipd_no }}
                        </td>
                        <td class="table-text">
                            {{ $item->admission_date }}
                        </td>

                        <td class="table-text">
                            {{ $item->checkin }}
                        </td>
                        <td class="table-text">
                            {{ $item->checkout }}
                        </td>

                        <td width="150">
                            <a href="javascript:;" class="openDetailModal" eid="{{ $item->patient_id }}">
                                <i class="fa fa-eye"></i> View
                            </a>
                            <a target="_blank" href="<?= url('patient/update/') ?>/<?= $item->patient_id ?>">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            <a href="javascript:;" link="<?= url('patient/delete/') ?>/<?= $item->patient_id ?>"
                                class="delete">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                    $sr++;
                    ?>
                @endforeach
            @endif

        </tbody>
    </table>
</div>
<?php if (count($patient) > 0): ?>
{{ $patient->links() }}
<?php endif ?>
