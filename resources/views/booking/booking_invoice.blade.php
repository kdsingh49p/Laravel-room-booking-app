<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='UTF-8'>
    <title>Booking Invoice</title>
    <style>
        .text-center {
            text-align: center;
        }

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
            border: 0;
            padding: 5px
        }

        #header {
            height: 15px;
            width: 100%;
            margin: 20px 0;
            background: #055797;
            text-align: center;
            color: #fff;
            font: 700 13px Helvetica, Sans-Serif;
            text-decoration: uppercase !important;
            letter-spacing: 10px;
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
            font-size: 25px;
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


        table#meta tr td {
            padding: 0px;
        }

        #hiderow,
        .delete {
            display: none
        }

    </style>
</head>

<body style="width:100% !important;">
    <div id="page-wrap">
        <div style="align:middle;text-align:center">
            <h2>Dr Daljit Singh Eye Hospital</h2>
            <br>
            <p>1, Radha Soami Road, Amritsar - 143001 India</p>
        </div>



        <br>

        <div id="customer">

            <table id="meta" style="float:left !important;">
                <tr>
                    <td>Regd No:</td>
                    <td>
                        <p readonly="true"><?= strtoupper($booking->patient_reg_no) ?></p>
                    </td>
                </tr>
                <tr>
                    <td>Receipt No : </td>
                    <td>
                        <p readonly="true" id="date"><?= $booking->receipt_no ?></p>
                    </td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>
                        <p readonly="true" id="date"><?= date('d/m/Y', strtotime($booking->created_at)) ?></p>
                    </td>
                </tr>
                <tr>
                    <td>IPD No.</td>
                    <td>
                        <p readonly="true" id="date"><?= $booking->get_patient['ipd_no'] ?></p>
                    </td>
                </tr>
            </table>
            <div style="clear:both"></div>
        </div>
        <div style="margin: 20px;">
            <p>Received with thanks from @if ($booking->mode_of_payment_id == 17)
                    {{ $booking->get_company->title }}
                    @endif @if ($booking->mode_of_payment_id == 16)
                        {{ $booking->complimentory_reason }} concerning
                    @endif patient <?= $booking->get_patient['patient_name'] ?> a sum of Rs.
                    <?= $booking->advance_paid + $booking->final_payment - $booking->refund_amount ?> Only on account of
                    Room Rent for days ( <?= $booking->get_patient['checkin'] ?> to
                    <?= $booking->get_patient['checkout'] ?>)</p>
        </div>
        <br>
        @if ($booking->mode_of_payment_id == 17)
            <p style="margin: 20px;">CREDIT : <?= $booking->advance_paid + $booking->final_payment ?></p>
        @endif
        <h3 style="margin: 20px;">& O.E</h3>

        <div id="terms">
            <h5>Terms</h5>
            <p readonly="true">No Cancellation.</p>
        </div>
    </div>

</html>
