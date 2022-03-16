@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Session;

$this->title = 'Create Merchant';
?>
@section('content')
    <main id="mainContent" class="main-content">
        <div class="page-container">
            <div class="container">
                <div class="cart-area ptb-60">
                    <div class="container">
                        <div class="cart-wrapper  table-responsive">
                            <h3 class="h-title mb-30 t-uppercase">My Events</h3>
                            <?php
                            $cart = Session::get('cart');
                            ?>
                            @include('common')

                            <table id="cart_list" class="cart-list mb-30">
                                <thead class="panel t-uppercase">
                                    <tr>
                                        <th>Event Photo</th>
                                        <th>Event Title</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Download Ticket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($PurchaseArr as $key => $purchase_items): ?>
                                    <tr class="panel alert optionROW">
                                        <td>
                                            <div class="media-left is-hidden-sm-down">
                                                <figure class="product-thumb">
                                                    <img src="{{ asset('uploads/' . $purchase_items->getEvent['event_photo']) }}"
                                                        alt="product">
                                                </figure>
                                            </div>
                                        </td>
                                        <td>
                                            <?= $purchase_items->getEvent['event_title'] ?>
                                        </td>
                                        <td>
                                            <?= $purchase_items->event_qty ?>
                                        </td>

                                        <td><?= $purchase_items->price ?></td>
                                        <td>
                                            <a target="_blank"
                                                href="{{ url('event/invoice/' . $purchase_items->purchase_id) }}">Download
                                                Ticket</a>
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
