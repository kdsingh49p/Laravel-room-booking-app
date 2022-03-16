@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Session;

$this->title = 'Create Merchant';
?>
@section('content')
    <main id="mainContent" class="main-content">
        <div class="page-container">
            <div class="container">
                @include('common')
                <div class="cart-area ptb-60">
                    <div class="container">
                        <div class="cart-wrapper">
                            <h3 class="h-title mb-30 t-uppercase">My Deals</h3>
                            <table id="cart_list" class="cart-list mb-30">
                                <thead class="panel t-uppercase">
                                    <tr>
                                        <th>Product name</th>
                                        <th>Deal Name</th>
                                        <th>Unit price</th>
                                        <!-- <th>Quantity</th> -->
                                        <th>Redeem Status</th>
                                        <th>Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($PurchaseArr as $key => $purchase_items): ?>
                                    <tr class="panel alert optionROW">
                                        <td>
                                            <div class="media-left is-hidden-sm-down">
                                                <figure class="product-thumb">
                                                    <img src="{{ asset('uploads/' . $purchase_items->getDeal['img_1']) }}"
                                                        alt="product">
                                                </figure>
                                            </div>
                                        </td>
                                        <td>
                                            <?= $purchase_items->getDeal['title'] ?>
                                            Deal Option <span><?= $purchase_items->getDealOption ?></span>
                                        </td>
                                        <td><?= $purchase_items->price ?></td>

                                        <td>
                                            <div class="sub-total">
                                                <?= $purchase_items->is_redeem == 0 ? 'Not Redeem' : 'Redeemed' ?>%</div>
                                        </td>
                                        <td>
                                            <a target="_blank"
                                                href="{{ url('deal/invoice/' . $purchase_items->purchase_id) }}">Invoice</a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
