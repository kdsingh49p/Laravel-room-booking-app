@extends('layouts.app')
<?php
$options = App\components\CheckOptions::getAlloptions();

$this->title = 'Create Merchant';
?>
@section('content')
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <div class="container">

                <!-- Contact Us Area -->
                <div class="contact-area contact-area-v1 panel">
                    <div class="row row-tb-20">
                        <div class="col-xs-12">
                            <div class="embed-responsive embed-responsive-16by9">

                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108704.20942066649!2d74.80007957760498!3d31.63367119450077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391964aa569e7355%3A0xeea2605bee84ef7d!2sAmritsar%2C%20Punjab!5e0!3m2!1sen!2sin!4v1578755523623!5m2!1sen!2sin"
                                    width="100%" height="auto" frameborder="0" style="border:0;"
                                    allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="ptb-30 prl-30">
                        <div class="row row-tb-20">
                            <div class="col-xs-12 col-md-6">
                                <div class="contact-area-col contact-info">
                                    <div class="contact-info">
                                        <h3 class="t-uppercase h-title mb-20">Contact informations</h3>
                                        <ul class="contact-list mb-40">
                                            <li>
                                                <span class="icon lnr lnr-map-marker"></span>
                                                <h5>Address</h5>
                                                <p class="color-mid"><?= $options['section-contact-info-address1'] ?>
                                                </p>
                                            </li>
                                            <li>
                                                <span class="icon lnr lnr-envelope"></span>
                                                <h5>Email</h5>
                                                <p class="color-mid"><?= $options['section-contact-info-email'] ?></p>
                                            </li>
                                            <li>
                                                <span class="icon lnr lnr-phone-handset"></span>
                                                <h5>Our phone</h5>
                                                <p class="color-mid"><?= $options['section-contact-info-phone1'] ?></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="contact-area-col contact-form">
                                    <h3 class="t-uppercase h-title mb-20">Get in touch</h3>
                                    <form action="{{ url('site/contactpost') }}" method="get">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea rows="5" name="message" class="form-control" required="required"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Contact Us Area -->

            </div>
        </div>
        <!-- End Page Container -->


    </main>
@endsection
