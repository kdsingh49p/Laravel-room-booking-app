@extends('layouts.app')
<?php
$this->title = 'Create Merchant';
?>
@section('content')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">
                <div class="row row-rl-10 row-tb-20">
                    <div class="page-content col-xs-12 col-md-8">


                        <section class="section deals-area">

                            <!-- Page Control -->
                            <header class="page-control panel ptb-15 prl-20 pos-r mb-30">

                                <!-- List Control View -->
                                <ul class="list-control-view list-inline">
                                    <li><a href=""><i class="fa fa-bars"></i></a>
                                    </li>
                                    <li><a href=""><i class="fa fa-th"></i></a>
                                    </li>
                                </ul>
                                <!-- End List Control View -->
                                <?php if (isset($slug)): ?>
                                <div class="right-10 pos-tb-center">
                                    <select class="form-control input-sm filter_deals">
                                        <option value="">SORT BY</option>
                                        <option value="created_at=desc">Newest items</option>
                                        <!-- <option>Best sellers</option> -->
                                        <!-- <option>Best rated</option> -->
                                        <option value="min_price=asc">Price: low to high</option>
                                        <option value="min_price=desc">Price: high to low</option>
                                    </select>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('.filter_deals').on('change', function() {
                                            var filter_val = $(this).val();
                                            window.location = "<?= url('category/' . $slug) ?>?" + filter_val;
                                        });
                                    });
                                </script>
                                <?php endif ?>

                            </header>

                            <!-- End Page Control -->
                            <div class="row row-masnory row-tb-20">


                                <!-- <div class="col-sm-6">
                                            <div class="deal-single panel">
                                                <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="{{ asset('public/assets/images/deals/deal_12.jpg') }}">
                                                    <div class="label-discount left-20 top-15">-60%</div>
                                                    <ul class="deal-actions top-15 right-20">
                                                        <li class="like-deal">
                                                            <span>
        <i class="fa fa-heart"></i>
        </span>
                                                        </li>
                                                        <li class="share-btn">
                                                            <div class="share-tooltip fade">
                                                                <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                                <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                                <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                                <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                            </div>
                                                            <span><i class="fa fa-share-alt"></i></span>
                                                        </li>
                                                        <li>
                                                            <span>
        <i class="fa fa-camera"></i>
        </span>
                                                        </li>
                                                    </ul>
                                                    <div class="time-left bottom-15 right-20 font-md-14">
                                                        <span>
        <i class="ico fa fa-clock-o mr-10"></i>
        <span class="t-uppercase" data-countdown="2019/10/10 12:00:00"></span>
        </span>
                                                    </div>
                                                    <div class="deal-store-logo">
                                                        <img src="{{ asset('public/assets/images/brands/brand_06.jpg') }}" alt="">
                                                    </div>
                                                </figure>
                                                <div class="bg-white pt-20 pl-20 pr-15">
                                                    <div class="pr-md-10">
                                                        <div class="rating mb-10">
                                                            <span class="rating-stars rate-allow" data-rating="5">
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
        </span>
                                                            <span class="rating-reviews">
        ( <span class="rating-count">29</span> rates )
                                                            </span>
                                                        </div>
                                                        <h3 class="deal-title mb-10">
        <a href="deal_single.html">Buying a TV Is Easy When You Know These Terms</a>
        </h3>
                                                        <ul class="deal-meta list-inline mb-10 color-mid">
                                                            <li><i class="ico fa fa-map-marker mr-10"></i>United Kingdom</li>
                                                            <li><i class="ico fa fa-shopping-basket mr-10"></i>134 Bought</li>
                                                        </ul>
                                                        <p class="text-muted mb-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam numquam nostrum.</p>
                                                    </div>
                                                    <div class="deal-price pos-r mb-15">
                                                        <h3 class="price ptb-5 text-right"><span class="price-sale">$300.00</span>$250.00</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                                <?php 
                                
                                if(count($DealsModel) > 0){
                                    foreach ($DealsModel as $key => $featured_deal) {
                                        ?>
                                <div class="col-sm-6">
                                    <a href="{{ url('/deal/' . $featured_deal->slug) }}">
                                        <div class="deal-single panel">
                                            <figure class="deal-thumbnail embed-responsive embed-responsive-16by9"
                                                data-bg-img="{{ asset('uploads/' . $featured_deal->img_1) }}">
                                                <div class="label-discount left-20 top-15"><?= $featured_deal->discount ?>%
                                                </div>
                                                <ul class="deal-actions top-15 right-20">

                                                </ul>
                                                <div class="time-left bottom-15 right-20 font-md-14">
                                                    <!--    <span>
                                            <i class="ico fa fa-clock-o mr-10"></i>
                                            <span class="t-uppercase" data-countdown="2019/12/30 01:30:00"></span>
                                        </span> -->
                                                </div>
                                                <!-- <div class="deal-store-logo">
                                                            <img src="{{ asset('public/assets/images/brands/brand_01.jpg') }}" alt="">
                                                        </div> -->
                                            </figure>
                                            <div class="bg-white pt-20 pl-20 pr-15">
                                                <div class="pr-md-10">
                                                    <!-- <div class="rating mb-10">
                                                                <span class="rating-stars rate-allow" data-rating="5">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </span>
                                                                <span class="rating-reviews">
                                                ( <span class="rating-count">241</span> rates )
                                                                </span>
                                                            </div> -->
                                                    <h3 class="deal-title mb-10">
                                                        <a
                                                            href="{{ url('/deal/' . $featured_deal->slug) }}"><?= substr($featured_deal->title, 0, 30) ?></a>
                                                    </h3>
                                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                                        <li><i
                                                                class="ico fa fa-map-marker mr-10"></i><?= $featured_deal->getCity->title ?>
                                                        </li>
                                                        <li><i
                                                                class="ico fa fa-shopping-basket mr-10"></i><?= $featured_deal->pending_deals ?>
                                                            Left</li>
                                                    </ul>
                                                    <p class="text-muted mb-20">
                                                        <?= substr($featured_deal->meta_description, 0, 70) ?>..</p>
                                                </div>
                                                <div class="deal-price pos-r mb-15">
                                                    <h3 class="price ptb-5 text-right"><span class="price-sale">Rs.
                                                            <?= $featured_deal->min_actual_price ?></span>Rs.
                                                        <?= $featured_deal->min_price ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php

                                    }
                                }
                             ?>

                            </div>

                            <!-- Page Pagination -->
                            <div class="page-pagination text-center mt-30 p-10 panel">
                                <nav>
                                    <!-- Page Pagination -->
                                    <?php if (count($DealsModel) > 0): ?>
                                    <?php if (!isset($_GET['city'])): ?>

                                    {{ $DealsModel->links() }}
                                    <?php endif ?>

                                    <?php endif ?>
                                    <script type="text/javascript">
                                        $('document').ready(function() {
                                            $("ul.pagination").addClass("page-pagination");

                                        })
                                    </script>
                                    <!--                                         <ul class="page-pagination">
                                                <li><a class="page-numbers previous" href="#">Previous</a>
                                                </li>
                                                <li><a href="#" class="page-numbers">1</a>
                                                </li>
                                                <li><span class="page-numbers current">2</span>
                                                </li>
                                                <li><a href="#" class="page-numbers">3</a>
                                                </li>
                                                <li><a href="#" class="page-numbers">4</a>
                                                </li>
                                                <li><span class="page-numbers dots">...</span>
                                                </li>
                                                <li><a href="#" class="page-numbers">20</a>
                                                </li>
                                                <li><a href="#" class="page-numbers next">Next</a>
                                                </li>
                                            </ul> -->
                                    <!-- End Page Pagination -->
                                </nav>
                            </div>
                            <!-- End Page Pagination -->

                        </section>

                    </div>
                    <div class="page-sidebar col-md-4 col-xs-12">

                        <!-- Blog Sidebar -->
                        <aside class="sidebar blog-sidebar">
                            <div class="row row-tb-10">


                                <div class="col-xs-12">
                                    <!-- Subscribe Widget -->
                                    <div class="widget subscribe-widget panel pt-20 prl-20">
                                        <h3 class="widget-title h-title">Subscribe to mail</h3>
                                        <div class="widget-content ptb-30">

                                            <p class="color-mid mb-20">Get our Daily email newsletter with Special Services,
                                                Updates, Offers and more!</p>
                                            <form method="post" action="#">
                                                <div class="input-group">
                                                    <input type="email" class="form-control"
                                                        placeholder="Your Email Address" required="required">
                                                    <span class="input-group-btn">
                                                        <button class="btn" type="submit">Sign Up</button>
                                                    </span>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <!-- End Subscribe Widget -->
                                </div>


                                <div class="col-xs-12">
                                    <!-- Contact Us Widget -->
                                    <div class="widget contact-us-widget panel pt-20 prl-20">
                                        <h3 class="widget-title h-title">Got any questions?</h3>
                                        <div class="widget-body ptb-30">
                                            <p class="mb-20 color-mid">If you are having any questions, please feel free to
                                                ask.</p>
                                            <a href="{{ url('/contact') }}" class="btn btn-block"><i
                                                    class="mr-10 font-15 fa fa-envelope-o"></i>Drop Us a Line</a>
                                        </div>
                                    </div>
                                    <!-- End Contact Us Widget -->
                                </div>
                            </div>
                        </aside>
                        <!-- End Blog Sidebar -->
                    </div>
                </div>
            </div>
        </div>


    </main>
@endsection
