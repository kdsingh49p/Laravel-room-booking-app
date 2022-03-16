@extends('layouts.app')
<?php
$this->title = 'Create Merchant';
?>
@section('content')
    <!-- –––––––––––––––[ PAGE CONTENT ]––––––––––––––– -->
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <?php if ($deal && $dealOptions): ?>

            <div class="container">
                <div class="row row-rl-10 row-tb-20">
                    <div class="page-content col-xs-12 col-sm-7 col-md-8">
                        <div class="row row-tb-20">
                            <div class="col-xs-12">
                                <div class="deal-deatails panel">
                                    <div class="deal-slider">
                                        <div id="product_slider" class="flexslider">
                                            <ul class="slides">
                                                <?php if ($deal->img_1): ?>
                                                <li>
                                                    <img alt="" src="{{ asset('uploads/' . $deal->img_1) }}">
                                                </li>
                                                <?php endif ?>
                                                <?php if ($deal->img_2): ?>
                                                <li>
                                                    <img alt="" src="{{ asset('uploads/' . $deal->img_2) }}">
                                                </li>
                                                <?php endif ?>
                                                <?php if ($deal->img_3): ?>
                                                <li>
                                                    <img alt="" src="{{ asset('uploads/' . $deal->img_3) }}">
                                                </li>
                                                <?php endif ?>
                                                <?php if ($deal->img_4): ?>
                                                <li>
                                                    <img alt="" src="{{ asset('uploads/' . $deal->img_4) }}">
                                                </li>
                                                <?php endif ?>
                                            </ul>
                                        </div>
                                        <div id="product_slider_nav" class="flexslider flexslider-nav">
                                            <ul class="slides">
                                                <?php if ($deal->img_1): ?>
                                                <li>
                                                    <img alt="" src="{{ asset('uploads/' . $deal->img_1) }}">
                                                </li>
                                                <?php endif ?>
                                                <?php if ($deal->img_2): ?>
                                                <li>
                                                    <img alt="" src="{{ asset('uploads/' . $deal->img_2) }}">
                                                </li>
                                                <?php endif ?>
                                                <?php if ($deal->img_3): ?>
                                                <li>
                                                    <img alt="" src="{{ asset('uploads/' . $deal->img_3) }}">
                                                </li>
                                                <?php endif ?>
                                                <?php if ($deal->img_4): ?>
                                                <li>
                                                    <img alt="" src="{{ asset('uploads/' . $deal->img_4) }}">
                                                </li>
                                                <?php endif ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="deal-body p-20">
                                        <meta property="og:title" name="title" content="<?= $deal->title ?>" />
                                        <meta property="og:description" name="description"
                                            content="<?= html_entity_decode(strip_tags($deal->meta_description)) ?>" />
                                        <meta property="og:image" content="{{ asset('uploads/' . $deal->img_1) }}">
                                        <h3 class="mb-10"><?= $deal->title ?></h3>

                                        <!-- <h2 class="price mb-15">$60.00</h2> -->
                                        <?= nl2br($deal->description) ?>
                                        <div class="addthis_inline_share_toolbox"></div>
                                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5cf6302a43d2687f"></script>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 hidden-xs">
                                <div class="posted-review panel p-30">
                                    <h3 class="h-title">Reviews</h3>
                                    <div class="review-single pt-30">
                                        <div class="append_review"></div>
                                        <?php
                                                $reviews = App\DealReview::where('deal_id', $deal->deal_id)
                                                ->where('status', 10)
                                                ->orderBy('created_at', 'DESC')->get();
                                                if (count($reviews) > 0) {

                                                    foreach ($reviews as $key => $value_review) {
                                                        ?>
                                        <div class="media">

                                            <!-- <div class="media-left">
                                                        <img class="media-object mr-10 radius-4" src="{{ asset('public/assets/images/avatars/avatar_01.jpg') }}" width="90" alt="">
                                                    </div> -->

                                            <div class="media-body dealpost">
                                                <div class="review-wrapper clearfix">
                                                    <ul class="list-inline">
                                                        <li>
                                                            <span
                                                                class="review-holder-name h5"><?= $value_review->name ?></span>
                                                        </li>
                                                    </ul>
                                                    <p class="review-date mb-5">
                                                        <?= date('d M Y', strtotime($value_review->created_at)) ?></p>
                                                    <p class="copy"><?= $value_review->review ?></p>
                                                </div>
                                            </div>


                                        </div>
                                        <?php
                                                    }
                                                }
                                                ?>
                                    </div>


                                </div>
                            </div>
                            <div class="col-xs-12 hidden-xs">
                                <div class="post-review panel p-20">
                                    <h3 class="h-title">Post Review</h3>
                                    <form class="horizontal-form pt-30" id="postReview">
                                        @csrf
                                        @method('POST')
                                        <div class="row row-v-10">
                                            <div class="col-sm-6">
                                                <input type="text" name="name" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="email" class="form-control" placeholder="Email">

                                                <input type="hidden" name="deal_id" value="{{ $deal->deal_id }}">
                                            </div>
                                            <div class="col-xs-12">
                                                <ul class="select-rate list-inline ptb-20">
                                                    <li><span>Your Rating : </span>
                                                    </li>
                                                    <li>
                                                        <span class="rating" role="button">
                                                            <i class="fa fa-star"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rating" role="button">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rating" role="button">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rating" role="button">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rating" role="button">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-xs-12">
                                                <textarea class="form-control" name="review" placeholder="Your Review" rows="6"></textarea>
                                            </div>
                                            <div class="col-xs-12 text-right">
                                                <button type="submit" class="btn mt-20">Submit review</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $('#postReview').validate({ // initialize the plugin
                            rules: {

                                name: {
                                    required: true,
                                },
                                email: {
                                    required: true,
                                    email: true
                                },
                                review: {
                                    required: true,
                                },


                            },
                            submitHandler: function(form) {
                                var isValid = true;

                                if (isValid) {
                                    $.ajax({
                                        url: '{{ url('deal-review/create') }}',
                                        type: "POST",
                                        data: $("#postReview").serialize(),
                                        success: function(data) {
                                            if (data.status == 'success') {
                                                $("#loader_c").hide('slow');

                                                swal("Congrats", "Review Created Successfully", "success").then((
                                                    value) => {
                                                    // window.location = "{{ url('user/dashboard') }}";
                                                    $('.append_review').append('<div class="media">' +
                                                        '<div class="media-body dealpost">' +
                                                        '<div class="review-wrapper clearfix">' +
                                                        '  <ul class="list-inline">' +
                                                        '    <li>' +
                                                        '      <span class="review-holder-name h5">' +
                                                        data.data.name + '</span>' +
                                                        '</li>' +
                                                        '</ul>' +
                                                        '<p class="review-date mb-5">' + data.data
                                                        .created_at + '</p>' +
                                                        '<p class="copy">' + data.data.review + '</p>' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '</div>');
                                                    $('.append_review').focus();
                                                });
                                                jQuery('.alert-danger').hide();
                                            } else if (data.status == 'fail') {

                                            }


                                        },
                                        error: function(data) {
                                            console.log();
                                            if (data.status == 422) {
                                                var obj = data.responseJSON;
                                                // console.log(obj.errors);
                                                jQuery.each(obj.errors, function(key, value) {
                                                    jQuery('.alert-danger').show();
                                                    jQuery('.alert-danger').focus();
                                                    jQuery('.alert-danger').append('<p>' + value + '</p>');
                                                });
                                            }

                                        }
                                    });
                                    $("#loader_c").show();
                                    // $('.results').html("<h1>Merchant Added Successfully</h1>");
                                    return false;
                                }

                            }
                        });
                    </script>
                    <div class="page-sidebar col-md-4 col-sm-5 col-xs-12">
                        <!-- Blog Sidebar -->
                        <aside class="sidebar blog-sidebar">
                            <div class="row row-tb-10">
                                <div class="col-xs-12">
                                    <div class="widget single-deal-widget panel ptb-30 prl-20">
                                        <div class="widget-body text-center">
                                            <!-- <h2 class="mb-20 h3">
      Wyndham Garden at Palmas del Mar - Puerto Rico
      </h2> -->
                                            <ul class="deal-meta list-inline mb-10 color-mid">
                                                <!-- <li><i class="ico fa fa-globe mr-10"></i><a href="store_single_02.html" class="color-mid">{{ $deal->getMerchant->address }}</a>
                                                        </li> -->
                                                <!-- <li><i class="ico fa fa-map-marker mr-10"></i>{{ $deal->getMerchant->business_name }}</li> -->
                                                <li><i
                                                        class="ico fa fa-shopping-basket mr-10"></i>{{ $deal->pending_deals }}
                                                    Pending Deals</li>
                                            </ul>
                                            <!-- Best Rated Deals -->
                                            <h3 class="widget-title h-title">Deal Options</h3>
                                            <div class="widget-body ptb-30">
                                                <?php foreach ($dealOptions as $key => $dealOption_value): ?>


                                                <div class="media">
                                                    <!--   <div class="media-left">
                                                            <a href="#">
                                                                <im
    g class="media-object" src="{{ asset('public/assets/images/deals/thumb_01.jpg') }}" alt="Thumb" width="80">
                                                            </a>
                                                        </div> -->
                                                    <div class="media-body">
                                                        <div class="col-md-9">
                                                            <h6 class=" text-left">
                                                                <a href="#">{{ $dealOption_value->title }}</a>
                                                            </h6>

                                                            <h4 class="price font-16 text-left">
                                                                Rs.{{ $dealOption_value->price }} <span
                                                                    class="price-sale color-muted">Rs.
                                                                    {{ $dealOption_value->actual_price }}</span></h4>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <?php if ($stock=='out'): ?>
                                                            <a href="javascript:;" class="btn btn-sm">Out of Stock</a>
                                                            <?php else: ?>
                                                            <a href="javascript:;"
                                                                dealOptionId="{{ $dealOption_value->option_id }}"
                                                                class="btn buyDeal btn-sm">Buy</a>
                                                            <?php endif ?>

                                                        </div>


                                                    </div>
                                                </div>
                                                <?php endforeach ?>

                                            </div>
                                            <!--   <div class="price mb-20">
                                                        <h2 class="price"><span class="price-sale">$200.00</span> $60.00</h2>
                                                    </div> -->
                                            <!-- <div class="buy-now mb-40">
                                                        
                                                    </div> -->
                                            <div class="time-left mb-30">
                                                <p class="t-uppercase color-muted">
                                                    Hurry up Only a few deals left
                                                </p>
                                                <!--               <div class="color-mid font-14 font-lg-16">
            <i class="ico fa fa-clock-o mr-10"></i>
            <span data-countdown="2020/10/10 12:25:10"></span>
     </div> -->
                                            </div>


                                        </div>
                                    </div>
                                </div>




                            </div>
                        </aside>
                        <!-- End Blog Sidebar -->
                    </div>
                </div>
            </div>
            <?php endif ?>

        </div>
        <!-- End Page Container -->


    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.buyDeal').on('click', function() {
                var deal_option_id = $(this).attr('dealOptionId');
                console.log(deal_option_id);

                $.get("{{ url('/deals/addcart') }}", {
                    deal_option_id: deal_option_id
                }, function(data) {
                    if (data.status == 'success') {
                        $('.cart-number').text(Number($('.cart-number').text()) + Number(1));
                        // swal("Congrats", "New Deal added in cart","success");
                        swal("Deal added in your cart", {
                                buttons: {
                                    cancel: "Continue Shopping",
                                    catch: {
                                        text: "Go To Cart",
                                        value: "catch",
                                    },
                                    // defeat: true,
                                },
                            })
                            .then((value) => {
                                switch (value) {

                                    // case "defeat":
                                    //   swal("Pikachu fainted! You gained 500 XP!");
                                    //   break;

                                    case "catch":
                                        window.location = "{{ url('/cart') }}"
                                        break;

                                        // default:
                                        //   swal("Got away safely!");
                                }
                            });
                    }

                })
            });
        })
    </script>
@endsection
