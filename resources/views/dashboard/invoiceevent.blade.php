<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='UTF-8'>
    <title>Ticket Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font: 14px/1.4 Georgia, serif margin: 5px;
            padding: 5px;
        }

        #page-wrap {
            width: 100%;
            margin: 0 auto
        }

        p {
            border: 0;
            font: 14px Georgia, Serif;
            overflow: hidden;
            resize: none
        }

        table {
            /*border-collapse: collapse;*/
        }

        table td,
        table th {
            border: 0.1px solid #000;
            padding: 5px
        }

        #header {
            height: 15px;
            width: 100%;
            margin: 20px 0;
            background: #222;
            text-align: center;
            color: #fff;
            font: 700 15px Helvetica, Sans-Serif;
            text-decoration: uppercase;
            letter-spacing: 20px;
            padding: 8px 0
        }

        #address {
            width: 250px;
            height: 150px;
            float: left
        }

        #customer {
            overflow: display
        }

        #logo {
            text-align: right;
            float: right;
            position: relative;
            margin-top: 25px;
            border: 1px solid #fff;
            max-width: 540px;
            max-height: 100px;
            overflow: hidden
        }



        #logoctr {
            display: none
        }


        #logohelp {
            text-align: left;
            display: none;
            font-style: italic;
            padding: 10px 5px
        }

        #logohelp input {
            margin-bottom: 5px
        }

        .edit #logohelp {
            display: block
        }

        .edit #save-logo,
        .edit #cancel-logo {
            display: inline
        }

        .edit #image,
        #save-logo,
        #cancel-logo,
        .edit #change-logo,
        .edit #delete-logo {
            display: none
        }

        #customer-title {
            font-size: 20px;
            font-weight: 700;
            float: left
        }

        #meta {
            margin-top: 1px;
            width: 300px;
            float: right;
        }

        #meta td {
            text-align: right
        }

        #meta td.meta-head {
            text-align: left;
            background: #eee
        }

        #meta td p {
            width: 100%;
            height: 20px;
            text-align: right
        }

        #items {
            clear: both;
            width: 100%;
            margin: 30px 0 0;
            border: 1px solid #000
        }

        #items th {
            background: #eee
        }

        #items p {
            width: 80px;
            height: 50px
        }

        #items tr.item-row td {
            border: 0;
            vertical-align: top
        }

        #items td.description {
            width: 300px
        }

        #items td.item-name {
            width: 175px
        }

        #items td.description p,
        #items td.item-name p {
            width: 100%
        }

        #items td.total-line {
            border-right: 0;
            text-align: right
        }

        #items td.total-value {
            border-left: 0;
            padding: 10px
        }

        #items td.total-value p {
            height: 20px;
            background: 0 0
        }

        #items td.balance {
            background: #eee
        }

        #items td.blank {
            border: 0
        }

        #terms {
            text-align: center;
            margin: 20px 0 0
        }

        #terms h5 {
            text-transform: uppercase;
            font: 13px Helvetica, Sans-Serif;
            letter-spacing: 10px;
            border-bottom: 1px solid #000;
            padding: 0 0 8px;
            margin: 0 0 8px
        }

        #terms p {
            width: 100%;
            text-align: center
        }



        #hiderow,
        .delete {
            display: none
        }

    </style>
</head>

<body style="width:100% !important;">
    <div id="page-wrap">
        <p id="header">TICKET</p>

        <div id="identity">
            <div style="width:50%;float:left;">
                <h3>Event Details</h3>
                <p><b>Event Name</b>: <?= $eventPurchase->getEvent['event_title'] ?></p>
                <p><b>Event Place Address</b>
                    <?= $eventPurchase->getEvent['place_name'] . ',' . $eventPurchase->getEvent['place_address'] ?></p>

                <p><b>Phone</b>: <?= $eventPurchase->getEvent['phone'] ?></p>
            </div>

            <div id="logo" style="width:50%;float:right;">

                <img id="image" alt="logo" src="{{ asset('public/assets/images/logo.png') }}" width="232">
            </div>
            <div style="clear:both"></div>

        </div>
        <br>

        <br>

        <div style="clear:both"></div>
        <div id="customer">
            <div id="customer-title">
                <p>Booking Person Name: <?= $eventPurchase->bill_person_name ?></p>
                <p>Booking Person Email: <?= $eventPurchase->bill_email ?> </p>
                <p>Booking Person Address: <?= $eventPurchase->bill_address ?> </p>
                <p>Booking Person Phone: <?= $eventPurchase->bill_mobile ?> </p>

            </div>
            <table id="meta" style="float:right !important;">
                <tr>
                    <td class="meta-head">OrderId #</td>
                    <td>
                        <p readonly="true">NBD<?=
        strtoupper($eventPurchase->product_type)
        $eventPurchase->purchase_id
        ?>-<?= date('d-m-Y', strtotime($eventPurchase->created_at)) ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td>
                        <p readonly="true" id="date"><?= date('M d, Y', strtotime($eventPurchase->created_at)) ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Paid</td>
                    <td>
                        <div class="due">Rs. <?= $eventPurchase->price ?></div>
                    </td>
                </tr>
            </table>
            <div style="clear:both"></div>

        </div>

        <table id="items">
            <tr>
                <th>Event Photo</th>
                <th>Event Name</th>
                <th>Ticket Price</th>
                <th>Person Qty</th>
                <th>Total Price</th>
            </tr>
            <tr class="item-row">
                <td class="item-name">
                    <img src="{{ asset('uploads/' . $eventPurchase->getEvent['event_photo']) }}" style="width:100px">

                </td>
                <td class="item-name">
                    <div class="delete-wpr">
                        <p readonly="true"><?= $eventPurchase->getEvent['event_title'] ?></p>
                    </div>
                </td>

                <td>
                    <p class="cost"><?= $eventPurchase->event_price ?></p>
                </td>
                <td>
                    <p class="qty"><?= $eventPurchase->event_qty ?></p>
                </td>
                <td>
                    <p class="qty"><?= $eventPurchase->price ?></p>
                </td>
            </tr>

            <tr id="hiderow">
                <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
            </tr>
            <tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="2" class="total-line">Subtotal</td>
                <td class="total-value">
                    <div id="subtotal">Rs <?= $eventPurchase->price ?></div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="2" class="total-line">Total</td>
                <td class="total-value">
                    <div id="total">Rs <?= $eventPurchase->price ?></div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="2" class="total-line">Amount Paid</td>
                <td class="total-value">
                    <p readonly="true" id="paid">Rs <?= $eventPurchase->price ?></p>
                </td>
            </tr>

        </table>
        <div id="terms">
            <h5>Terms</h5>
            <p readonly="true">No Cancellation after final booking of tickets.</p>
        </div>
    </div>

</html>
