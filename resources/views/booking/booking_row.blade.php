<label><br>
    <strong>Total: <?= $booking->total() ?></strong>
</label>
<div class="table-responsive  c-table-responsive">
    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
        width="100%" style="border: 1px solid #dee2e6;">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Receipt No.</th>
                <th>Pat. Reg no</th>
                <th>Admission Date</th>
                <th>Patient name</th>
                <th>Patient phone</th>
                <th>Payable Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sr.No.</th>
                <th>Receipt No.</th>
                <th>Pat. Reg no</th>
                <th>Admission Date</th>
                <th>Patient name</th>
                <th>Patient phone</th>
                <th>Payable Amount</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>
        </tfoot>
        <tbody>

            <?php if (count($booking) > 0): ?>

            <?php
            $sr = $booking->firstItem();
            
            ?>

            @foreach ($booking as $key => $item)
                <tr>
                    <td class="table-text">
                        {{ $sr }}
                    </td>
                    <td class="table-text">
                        {{ $item->receipt_no }}
                    </td>
                    <td class="table-text">
                        {{ $item->patient_reg_no }}
                    </td>
                    <td class="table-text">
                        {{ date_format($item->created_at, 'd/m/Y') }}
                    </td>

                    <td class="table-text">
                        {{ $item->get_patient['patient_name'] }}
                    </td>
                    <td class="table-text">
                        {{ $item->get_patient['patient_phone'] }}
                    </td>
                    <td class="table-text">
                        Rs. {{ $item->payable_amt }}
                    </td>
                    <td class="table-text {{ $item->status == 1 ? 'COLOR_GREEN' : 'COLOR_RED' }}">
                        {{ $item->status == 1 ? 'ACTIVE' : 'CANCEL' }}
                    </td>

                    <!--  <td class="table-text">
        {{ $item->checkin }}
    </td>
 <td class="table-text">
        {{ $item->checkout }}
    </td> -->
                    <td width="150">
                        <!--   <a href="javascript:;" class="openDetailModal" eid="{{ $item->patient_id }}">
                <i class="fa fa-eye"></i> View
            </a> -->
                        @if ($item->is_discharged != 1)
                            <a target="_blank" href="<?= url('booking/update/') ?>/<?= $item->booking_id ?>">
                                <i class="fa fa-pencil"></i> Create Discharge Form
                            </a>
                        @endif
                        @if ($item->is_discharged == 1)
                            <a target="_blank" href="<?= url('booking/print/') ?>/<?= $item->booking_id ?>">
                                <i class="fa fa-print"></i> Print
                            </a>
                        @endif
                        <a href="javascript:;" style="color:red;"
                            link="<?= url('booking/delete/') ?>/<?= $item->booking_id ?>" class="delete">
                            <i class="fa fa-trash"></i> Cancel
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
<?php if (count($booking) > 0): ?>
{{ $booking->links() }}
<?php endif ?>
