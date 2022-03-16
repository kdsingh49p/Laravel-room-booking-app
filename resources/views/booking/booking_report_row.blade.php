<label><br>
    <strong>Total: <?= $booking->total() ?></strong>
</label>
<div class="table-responsive  c-table-responsive">
    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
        width="100%" style="border: 1px solid #dee2e6;">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Date</th>
                <th>Receipt No</th>
                <th>Patient Name</th>
                <th>Cash</th>
                <th>Complimentary</th>
                <th>Credit</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sr.No.</th>
                <th>Date</th>
                <th>Receipt No</th>
                <th>Patient Name</th>
                <th>Cash</th>
                <th>Complimentary</th>
                <th>Credit</th>

            </tr>
        </tfoot>
        <tbody>
            <?php if (count($booking) > 0): ?>
            <?php
            $sr = $booking->firstItem();
            $total_payable_amt = 0;
            ?>

            @foreach ($booking as $key => $item)
                <tr>
                    <td class="table-text">
                        {{ $sr }}
                    </td>


                    <td class="table-text">
                        {{ date_format($item->created_at, 'd/m/Y') }}
                    </td>
                    <td class="table-text">
                        {{ $item->receipt_no }}
                    </td>
                    <td class="table-text">
                        {{ $item->get_patient['patient_name'] }}
                    </td>
                    <td class="table-text">
                        @if ($item->mode_of_payment_id != 16 && $item->mode_of_payment_id != 17)
                            Rs. {{ $item->payable_amt }}
                            <?php $total_payable_amt += $item->payable_amt; ?>
                        @endif
                    </td>
                    <td class="table-text">
                        @if ($item->mode_of_payment_id == 16)
                            {{ $item->complimentory_reason }}
                        @endif
                    </td>
                    <td class="table-text">
                        @if ($item->mode_of_payment_id == 17)
                            @if ($item->get_company)
                                Rs. {{ $item->payable_amt }} ( {{ $item->get_company->title }} )
                                <?php $total_payable_amt += $item->payable_amt; ?>
                            @endif
                        @endif
                    </td>

                </tr>
                <?php
                $sr++;
                ?>
            @endforeach

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="color:green;">Rs. <?= $total_payable_amt ?></td>
            </tr>
            <?php endif ?>

        </tbody>
    </table>
</div>
<?php if (count($booking) > 0): ?>
{{ $booking->links() }}
<?php endif ?>
