<label><br>
    <strong>Total: <?= $daily_collection->total() ?></strong>
</label>
<div class="table-responsive  c-table-responsive">
    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
        width="100%" style="border: 1px solid #dee2e6;">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Receipt No.</th>
                <th>Received Date</th>
                <th>Patient Name</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sr.No.</th>
                <th>Receipt No.</th>
                <th>Received Date</th>
                <th>Patient Name</th>
                <th>Amount</th>

            </tr>
        </tfoot>
        <tbody>

            <?php if (count($daily_collection) > 0): ?>
            <?php
            $sr = $daily_collection->firstItem();
            $total_amount = 0;
            ?>

            @foreach ($daily_collection as $key => $item)
                @if ($item->get_booking->mode_of_payment_id != 16 && $item->get_booking->mode_of_payment_id != 17)
                    <tr>
                        <td class="table-text">
                            {{ $sr }}
                        </td>
                        <td class="table-text">
                            {{ $item->get_booking->receipt_no }}
                        </td>

                        <td class="table-text">
                            {{ date('d/m/Y', strtotime($item->collection_date)) }}
                        </td>



                        <td class="table-text">
                            {{ $item->get_booking->get_patient['patient_name'] }}
                        </td>
                        <td class="table-text">
                            {{ $item->amount }} @if ($item->remark)
                                -
                                {{ $item->remark }}
                            @endif

                        </td>





                        <?php
                        $total_price = $item->amount;
                        ?>
                        <?php $total_amount += $total_price; ?>





                    </tr>
                @endif
                <?php
                $sr++;
                ?>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="color:green;">Rs. <?= $total_amount ?></td>
            </tr>
            <?php endif ?>

        </tbody>
    </table>
</div>
<?php if (count($daily_collection) > 0): ?>
{{ $daily_collection->links() }}
<?php endif ?>
