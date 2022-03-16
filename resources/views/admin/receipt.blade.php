<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='UTF-8'>
    <title>Patient Receipt</title>
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
        <div style="align:middle;
    text-align:center">
            <img id="image" align="middle" alt="logo"
                src="http://daljiteye.com/uploads/daljithosptal-amritsar9034TU3UV1.jpg" width="232">
        </div>

        <p id="header">DR DALJIT SINGH EYE HOSPITAL</p>

        <div id="identity">
            <div style="width:100%;text-align: center;">
                <p><b> Mall Road , Near Ram Ashram School , Amritsar , India</b></p>

                <p><b> 9152833977</b></p>
            </div>

            <div id="logo" style="width:100%;text-align: center">


            </div>
            <div style="clear:both"></div>

        </div>
        <br>

        <br>

        <div style="clear:both"></div>
        <div id="customer">
            <div id="customer-title">
                <p>Patient Name: <?= $patient->patient_name ?></p>
                <p>Patient Mobile: <?= $patient->patient_mobile ?> </p>
                <p>Booking Address: <?= $patient->patient_address ?> </p>
                <p>Booking Disease: <?= $patient->get_disease['title'] ?> </p>

            </div>
            <table id="meta" style="float:right !important;">
                <tr>
                    <td class="meta-head">Patient ID #</td>
                    <td>
                        <p readonly="true"><?= strtoupper($patient->patient_id) ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td>
                        <p readonly="true" id="date"><?= date('M d, Y', strtotime($patient->created_at)) ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Paid</td>
                    <td>
                        <div class="due">Rs. 200</div>
                    </td>
                </tr>
            </table>
            <div style="clear:both"></div>

        </div>

        <table id="items">
            <tr>
                <th>Patient ID</th>
                <th>Patient Age</th>
                <th>Patient Mobile</th>
                <th>Patient Address</th>
                <th>Patient Address</th>

            </tr>
            <tr class="item-row">



                <td>
                    <p class="cost"><?= $patient->patient_id ?></p>
                </td>
                <td>
                    <p class="cost"><?= $patient->patient_name ?></p>
                </td>
                <td>
                    <p class="qty"><?= $patient->patient_age ?></p>
                </td>
                <td>
                    <p class="qty"><?= $patient->patient_mobile ?></p>
                </td>
                <td>
                    <p class="qty"><?= $patient->patient_address ?></p>
                </td>
            </tr>


            <tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="2" class="total-line">Subtotal</td>
                <td class="total-value">
                    <div id="subtotal">Rs 200</div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="2" class="total-line">Total</td>
                <td class="total-value">
                    <div id="total">Rs 200</div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="blank"> </td>
                <td colspan="2" class="total-line">Amount Paid</td>
                <td class="total-value">
                    <p readonly="true" id="paid">Rs 200</p>
                </td>
            </tr>

        </table>
        <div id="terms">
            <h5>Terms</h5>
            <p readonly="true">No Cancellation.</p>
        </div>
    </div>

</html>
