@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Session;

$this->title = 'Invoice';
?>
@section('content')
    <main id="mainContent" class="main-content">
        <div class="page-container">
            <div class="container">
                <div class="cart-area ptb-60">
                    <div class="container">
                        <div class="cart-wrapper  table-responsive">
                            <h2>Invoice</h2>
                            <table id="cart_list" class="table table-bordered">
                                <tbody>
                                    <tr class="panel alert optionROW">
                                    <tr>
                                        <th>Product</th>
                                        <td>
                                            <div class="media-left is-hidden-sm-down">
                                                <figure class="product-thumb">
                                                    <img src="{{ asset('uploads/' . $DealPurchase->getDeal['img_1']) }}"
                                                        alt="product" style="width:200px;">
                                                </figure>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Product name</th>
                                        <td>
                                            <?= $DealPurchase->getDeal['title'] ?>
                                            Deal Option <span><?= $DealPurchase->getDealOption ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Unit price</th>
                                        <td><?= $DealPurchase->price ?></td>
                                    </tr>
                                    <tr>
                                        <th>Billing Person</th>
                                        <td><?= $DealPurchase->bill_person_name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Billing Address</th>
                                        <td><?= $DealPurchase->bill_address ?></td>
                                    </tr>
                                    <tr>
                                        <th>Billing Mobile</th>
                                        <td><?= $DealPurchase->bill_mobile ?></td>
                                    </tr>
                                    <tr>
                                        <th>Transaction Detail</th>
                                        <td><?= $DealPurchase->getTransactionDetail['amount'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Transaction Status</th>
                                        <td><?= strtoupper($DealPurchase->getTransactionDetail['status']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Redeem Code</th>
                                        <td><?= $DealPurchase->redeem_code ?></td>
                                    </tr>
                                    <tr>
                                        <th>Is Redeem</th>
                                        <td><?= $DealPurchase->is_redeem == 0 ? 'Not Redeem' : 'Redeemed' ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
