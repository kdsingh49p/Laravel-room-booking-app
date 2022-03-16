@extends("layouts.app")
<?php
$this->title = 'Create Discharge Form';
?>
<style type="text/css">
    .if_extra_bed {
        display: none;
    }

    .extra_bed_checkbox {
        margin-top: 17%;
    }

    .complimentory_reason_div {
        display: none;
    }

    .credit_companies {
        display: none;
    }

</style>
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><?= $this->title ?></h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a>Masters</a> </li>
                <li class="breadcrumb-item"><a>Booking</a> </li>
                <li class="breadcrumb-item active"><?= $this->title ?></li>
            </ol>
        </div>
        <div class="">
            <button
                class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i
                    class="ti-settings text-white"></i></button>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Booking Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>patient reg no <span class="text-danger">*</span></label>
                                        <input readonly="true" type="text" value="<?= $booking->patient_reg_no ?>"
                                            name="patient_reg_no" id="patient_reg_no" class="form-control patient_reg_no">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>patient name <span class="text-danger">*</span></label>
                                        <input readonly="true" type="text"
                                            value="<?= $booking->get_patient['patient_name'] ?>" name="patient_name"
                                            id="patient_name" class="form-control patient_name">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>patient phone <span class="text-danger">*</span></label>
                                        <input readonly="true" type="text"
                                            value="<?= $booking->get_patient['patient_phone'] ?>" name="patient_phone"
                                            id="patient_phone" class="form-control patient_phone">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input readonly="true" type="text"
                                            value="<?= $booking->get_patient['patient_gender'] ?>" name="patient_gender"
                                            id="patient_gender" class="form-control patient_gender">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>IPD No.<span class="text-danger">*</span></label>
                                        <input readonly="true" type="text" value="<?= $booking->get_patient['ipd_no'] ?>"
                                            name="ipd_no" id="ipd_no" class="form-control ipd_no">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Admission Date <span class="text-danger">*</span></label>
                                        <input readonly="true" type="text"
                                            value="<?= $booking->get_patient['admission_date'] ?>" name="admission_date"
                                            id="admission_date" class="form-control admission_date">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Checkin <span class="text-danger">*</span></label>
                                        <input type="text" readonly="true" value="<?= $booking->get_patient['checkin'] ?>"
                                            name="checkin" id="checkin" class="form-control checkin">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Checkout <span class="text-danger">*</span></label>
                                        <input type="text" readonly="true" value="<?= $booking->get_patient['checkout'] ?>"
                                            name="checkout" id="checkout" class="form-control checkout">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="demo-checkbox">

                                        <input type="checkbox" id="basic_checkbox_2" class="extent_checkout_check">
                                        <label class="extent_checkout_check" for="basic_checkbox_2">Extend Checkout</label>

                                    </div>

                                </div>

                                <div class="col-md-2 exten_ceckout_div" style="display: none">
                                    <div class="form-group">
                                        <label>Extend Checkout Date <span class="text-danger">*</span></label>
                                        <input type="text" readonly="true" value="" name="extent_checkout"
                                            id="extent_checkout" class="form-control extent_checkout">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>

                            </div>
                            <!-- <div class="row ">
            <div class="col-md-2">
          <div class="form-group">
          <label>Room Number <span class="text-danger">*</span></label>
          <select name="room_id" id="room_id" class="room_id append_available_room form-control">
          <?php 
						 						if ($booking->get_rooms ) {
						 								foreach ($booking->get_rooms as $key => $room) {
						 									?>
                   <option room_number="<?= $room->room_number ?>" room_price="<?= $room->room_price ?>" value="<?= $room->room_id ?>" selected><?= $room->room_number ?></option>
                   <?php
															 
														}
						  						}


											?>
          </select>
          <small class="has_error"> This Field is Required </small>

          </div>
          
            
           </div>
           <div class="col-md-2">
          <div class="form-group" style="    margin-top: 31px;">
          <input type="button" value="+Add Room" name="add_room" class="add_room btn btn-primary btn-sm">

          </div>
          </div>
          <div class="col-md-4">
          <div class="alert alert-warning room_error" style="display: none;"></div>
          </div>
          </div> -->
                            <h3>Room Details</h3>
                            <hr>
                            <div class="append_room_estimate">
                                <?php 
			 						if ($booking->get_rooms ) {
			 								foreach ($booking->get_rooms as $key => $room) {
			 									?>
                                <div class="row room_row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>R. No. <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $room->room_number ?>" readonly="true"
                                                name="room_number[]" id="room_number" class="form-control room_number">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Date <span class="text-danger">*</span></label>
                                            <input type="text" readonly="true" name="book_date[]" id="book_date"
                                                class="form-control book_date" value="<?= $room->book_date ?>">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>R. Price <span class="text-danger">*</span></label>
                                            <input type="text" onkeypress="javascript:return validateNumber(event)"
                                                name="room_price[]" id="room_price" class="form-control room_price"
                                                value="<?= $room->room_price ?>">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="demo-checkbox extra_bed_checkbox">
                                            <input type="checkbox" name="extra_bed[]"
                                                id="extra_bed_<?= $room->room_number ?>_<?= $room->book_date ?>"
                                                <?= $room->extra_bed == 'on' ? 'checked' : '' ?> class="extra_bed">
                                            <label for="extra_bed_<?= $room->room_number ?>_<?= $room->book_date ?>"
                                                class="available_status">Extra Bed</label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 if_extra_bed"
                                        style="display: <?= $room->extra_bed == 'on' ? 'block' : 'none' ?> !important;">
                                        <div class="form-group">
                                            <label>Bed Qty </label>
                                            <input type="text" onkeypress="javascript:return validateNumber(event)"
                                                value="<?= $room->extra_bed_qty ?>" name="extra_bed_qty[]"
                                                id="extra_bed_qty" class="form-control extra_bed_qty">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>
                                    <div class="col-md-2 if_extra_bed"
                                        style="display: <?= $room->extra_bed == 'on' ? 'block' : 'none' ?> !important;">
                                        <div class="form-group">
                                            <label>Extra Bed Price </label>
                                            <input type="text" onkeypress="javascript:return validateNumber(event)"
                                                value="<?= $room->extra_bed_price ?>" name="extra_bed_price[]"
                                                id="extra_bed_price" class="form-control extra_bed_price">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            @if ($key == count($booking->get_rooms) - 1)
                                                <input type="button" room_booking_id="<?= $room->room_booking_id ?>"
                                                    value="X" class="btn btn-primary btn-xs remove_hotel">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <?php
												 
											}
			  						}


								?>
                            </div>
                            <div class="extend_available_room">
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Receipt No. <span class="text-danger">*</span></label>
                                        <input readonly="true" value="<?= $booking->receipt_no ?>" type="text"
                                            name="receipt_no" id="receipt_no" class="form-control receipt_no">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Mode of payment</label>
                                        <select type="text" name="mode_of_payment_id"
                                            class="mode_of_payment_id form-control">
                                            <option value="">select</option>
                                            @foreach ($mode_of_payment as $mode)
                                                <option
                                                    <?= $booking->mode_of_payment_id == $mode->mode_of_payment_id ? 'selected' : '' ?>
                                                    value="{{ $mode->mode_of_payment_id }}">{{ $mode->title }}</option>
                                            @endforeach
                                        </select>
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $(document).on('change', '.mode_of_payment_id', function() {
                                            var mode_of_payment_id = $(this).val()
                                            if (mode_of_payment_id == 17) {
                                                $('.credit_companies').show()
                                            } else {
                                                $('.credit_companies').hide()
                                            }
                                        })
                                    })
                                </script>
                                <div class="col-md-2 credit_companies"
                                    style="display: <?= $booking->mode_of_payment_id == 17 ? 'block' : 'none' ?>">
                                    <div class="form-group">
                                        <label>Companies</label>
                                        <select type="text" name="company_id" class="company_id form-control">
                                            <option value="">select</option>
                                            @foreach ($companies as $company)
                                                <option
                                                    <?= $booking->company_id == $company->company_id ? 'selected' : '' ?>
                                                    value="{{ $company->company_id }}">{{ $company->title }}</option>
                                            @endforeach
                                        </select>
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>
                                <div class="col-md-4 complimentory_reason_div"
                                    style="display: <?= $booking->mode_of_payment_id == 16 ? 'block' : 'none' ?>">
                                    <div class="form-group">
                                        <label>Complimantory Reason</label>
                                        <textarea type="text" name="complimentory_reason"
                                            class="complimentory_reason form-control">{{ $booking->complimentory_reason }}</textarea>
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>

                                <script type="text/javascript">
                                    $(document).on('change', '.mode_of_payment_id', function() {
                                        var mode = $('.mode_of_payment_id').val();
                                        if (mode == 16) {
                                            $('.complimentory_reason_div').show()
                                        } else {
                                            $('.complimentory_reason_div').hide()
                                        }
                                    })
                                </script>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Total Amount</label>
                                        <input value="<?= $booking->total_amt ?>" type="text" name="total_amt"
                                            class="total_amt form-control" readonly="true">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input value="<?= $booking->discount ?>" type="text"
                                            onkeypress="javascript:return validateNumber(event)" name="discount"
                                            class="discount form-control">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Payable Amount</label>
                                        <input value="<?= $booking->payable_amt ?>" type="text" name="payable_amt"
                                            class="payable_amt form-control" readonly="true">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Advance Payment</label>
                                        <input readonly="true" value="<?= $booking->advance_paid ?>" type="text"
                                            onkeypress="javascript:return validateNumber(event)" name="advance_paid"
                                            class="advance_paid form-control">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Final Amount</label>
                                        <input type="text" onkeypress="javascript:return validateNumber(event)"
                                            name="final_payment" class="final_payment form-control">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Refund</label>
                                        <input type="text" onkeypress="javascript:return validateNumber(event)"
                                            name="refund_amount" class="refund_amount form-control">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Balance Amount</label>
                                        <input value="<?= $booking->balance_amount ?>" type="text"
                                            onkeypress="javascript:return validateNumber(event)" name="balance_amount"
                                            class="balance_amount form-control" readonly="true">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>


                            </div>
                            <!-- <div class="col-md-2">
          <div class="form-group">
           <label>patient email</label>
            <input type="text" value="<?= $booking->get_patient['patient_email'] ?>" name="patient_email" id="patient_email" class="form-control patient_email">
            <small class="has_error"> This Field is Required </small>
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group">
           <label>patient address <span class="text-danger">*</span></label>
            <input value="<?= $booking->get_patient['patient_address'] ?>" name="patient_address" id="patient_address"  class="form-control patient_address">
            <small class="has_error"> This Field is Required </small>
          </div>
          </div> -->
                            <!-- <div class="col-md-2">
          <div class="form-group">
           <label>patient nationality <span class="text-danger">*</span></label>
            <input type="text" value="<?= $booking->get_patient['patient_nationality'] ?>" name="patient_nationality" id="patient_nationality" class="form-control patient_nationality">
            <small class="has_error"> This Field is Required </small>
          </div>
          </div>
          <div class="col-md-2">
          <div class="form-group">
           <label>Adults <span class="text-danger">*</span></label>
            <input type="text" value="<?= $booking->get_patient['adults'] ?>" name="adults" id="adults" onkeypress="javascript:return validateNumber(event)" class="form-control adults">
            <small class="has_error"> This Field is Required </small>
          </div>
          </div>
          <div class="col-md-2">
          <div class="form-group">
           <label>Child <span class="text-danger">*</span></label>
            <input type="text" value="<?= $booking->get_patient['child'] ?>" name="child" id="child" onkeypress="javascript:return validateNumber(event)" class="form-control child">
            <small class="has_error"> This Field is Required </small>
          </div>
          </div>
          
          <div class="col-md-2">
          <div class="form-group">
           <label>Gst number</label>
            <input type="text" value="<?= $booking->get_patient['gst_number'] ?>" name="gst_number" id="gst_number" class="form-control gst_number">
            <small class="has_error"> This Field is Required </small>
          </div>
          </div>
          
            
           </div> -->





                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="hidden" id="differ_days" name="">

                                    <button style="    margin-top: 30px;" type="submit" class="btn btn-success save"> <i
                                            class="fa fa-check"></i> Save</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        function update_discount() {
            var discount = $('.discount').val();
            var total_amt = $('.total_amt').val();
            var new_payable_amt = Number(total_amt) - Number(discount);
            $('.payable_amt').val(new_payable_amt)
        }

        function update_balance_amount() {
            var advance_paid = $('.advance_paid').val();
            var final_payment = $('.final_payment').val();
            var payable_amt = $('.payable_amt').val();

            var balance_amount = Number(payable_amt) - Number(advance_paid);
            balance_amount = balance_amount - Number(final_payment);
            $('.balance_amount').val(balance_amount)
        }

        function reset_booking() {
            $('.gst').val(0);
            $('.payable_amt').val(0);
            $('.total_amt').val(0);
            $('.append_room_estimate').empty()
        }

        function calc_amt() {

            var extra_bed_price = 0;
            $('.extra_bed').each(function() {
                if ($(this).is(':checked') == true) {

                    var extra_bed_price_find = $(this).parents('.room_row').find('.extra_bed_price').val();

                    var extra_bed_qty = $(this).parents('.room_row').find('.extra_bed_qty').val();

                    var total_extra_bed_price = Number(extra_bed_price_find) * Number(extra_bed_qty);

                    if (total_extra_bed_price != "") {
                        extra_bed_price += total_extra_bed_price;
                    }

                }
            })

            var room_price_amt = 0;
            $('.room_price').each(function() {
                if ($(this).val() != "") {
                    room_price_amt += parseInt($(this).val());
                }
            })


            var total_amt = parseInt(extra_bed_price) + parseInt(room_price_amt);
            $('.total_amt').val(total_amt);

            if (total_amt > 999) {
                var gst = parseInt(total_amt * 12 / 100);

                $('.gst').val(gst);
                $('.payable_amt').val(parseInt(gst + total_amt));
            } else {
                $('.payable_amt').val(total_amt);
                $('.gst').val(gst);
            }

            update_discount();
            update_balance_amount();

        }

        $(document).ready(function() {
            $(document).on('click', '.extra_bed', function() {
                var extra_bed = $('.extra_bed');
                if (extra_bed.is(':checked') == true) {
                    console.log(extra_bed.parents('.room_row'), 'kkkk')
                    extra_bed.parents('.room_row').find('.if_extra_bed').show()
                    calc_amt();
                } else {
                    extra_bed.parents('.room_row').find('.if_extra_bed').hide()
                    calc_amt();
                }
            })

            $(document).on('keyup', '.extra_bed_qty, .extra_bed_price', function() {
                calc_amt()
            })
            $('.extent_checkout_check').on('click', function() {
                if ($(this).is(':checked')) {
                    $('.exten_ceckout_div').show();
                } else {
                    $('.exten_ceckout_div').hide();

                }
            })

            $(document).on('keyup', '.discount', function() {
                update_discount();
                update_balance_amount();
            })

            $(document).on('keyup', '.advance_paid', function() {
                update_balance_amount();
            })

            $(document).on('keyup', '.final_payment', function() {
                var final_payment = $(this).val();
                var balance_amount_old = Number($('.payable_amt').val()) - Number($('.advance_paid').val());
                if (Number(final_payment) > Number(balance_amount_old)) {
                    $('.final_payment').val(0)
                    alert('Final Payment should less than Balance Amount')
                } else {

                }
                update_balance_amount();
            })

            $('.extent_checkout').on('change', function() {
                var checkin_date = $('.checkout').val()
                var checkout_date = $('.extent_checkout').val()
                var checkin_split = checkin_date.split('/');
                var checkout_split = checkout_date.split('/');


                var date1 = new Date(checkin_split[1] + '/' + checkin_split[0] + '/' + checkin_split[2]);
                var date2 = new Date(checkout_split[1] + '/' + checkout_split[0] + '/' + checkout_split[2]);



                var date3 = checkin_split[2] + '-' + checkin_split[1] + '-' + checkin_split[0];
                var date4 = checkout_split[2] + '-' + checkout_split[1] + '-' + checkout_split[0];
                $.get("<?= url('room/getavailabelrooms') ?>", {
                    'checkin': date3,
                    'checkout': date4
                }, function(resp) {
                    $('.extend_available_room').html(resp);
                })
            })
            //        		$('.extent_checkout').datepicker({
            //       	format: "dd/mm/yyyy",
            //       	minDate: new Date(2020, 3, 14),
            // })
            var checkout_date = $('.checkout').val();
            var split_checkout = checkout_date.split('/');
            var new_checkout_date = split_checkout[1] + '/' + split_checkout[0] + '/' + split_checkout[2];
            var minDate = new Date(new_checkout_date);
            minDate.setDate(minDate.getDate() + 1)
            // minDate.setDate(minDate.getDate())
            $('.extent_checkout').datepicker({
                format: "dd/mm/yyyy",
            })
            console.log(minDate);
            $('.extent_checkout').datepicker('setStartDate', minDate);
            // $('.extent_checkout').datepicker("setDate",minDate); 
            // 



            $(document).on('keyup', '.room_price,.break_fast,.lunch,.dinner', function() {
                var amt = $(this).val();
                if (amt != "") {
                    calc_amt()
                }
            })

            $(document).on('click', '.remove_hotel', function() {

                var room_booking_id = $(this).attr('room_booking_id');
                var booking_id = "<?= $booking->booking_id ?>";
                $(this).closest('.row').remove()
                $.get("{{ url('/booking/delete_room/') }}", {
                    'room_booking_id': room_booking_id,
                    'booking_id': booking_id
                }, function(resp) {
                    calc_amt();
                    console.log(resp.checkout)
                    $('.checkout').val(resp.checkout)
                })


            })

            var minDate = '';
            // jQuery('#checkin').datepicker({
            //                 toggleActive: true,
            //                  startDate:'today',
            //                 autoclose: true,
            //     			todayHighlight: true,
            //     			 format: "dd/mm/yyyy"
            //             }).on('changeDate', function (selected) {
            //               var minDate = new Date(selected.date.valueOf());
            //               minDate.setDate(minDate.getDate() )
            //               minDate.setDate(minDate.getDate())
            //               $('.checkout').datepicker({
            //              	format: "dd/mm/yyyy",
            //              })
            //               console.log(minDate);
            //                $('.checkout').datepicker('setStartDate', minDate);
            //               $('.checkout').datepicker("setDate",minDate);  
            //               reset_booking()
            //               // $('.checkout').datepicker("dateFormat","dd/mm/yyyy");

            //           });


            var checkout_ = $('.checkout');
            var minDate_ = new Date(checkout_.val());
            // console.log(minDate_.getDate())
            //          minDate_.setDate(minDate_.getDate() )
            //         minDate_.setDate(minDate_.getDate())
            //        $('.extent_checkout').datepicker('setStartDate', minDate_);
            // $('.extent_checkout').datepicker("setDate",minDate_);  



            //           $('.checkout').on('change', function(){
            //           		var checkin_date = $('.checkin').val()
            //           		var checkout_date = $('.checkout').val()
            //           		var checkin_split = checkin_date.split('/');
            //           		var checkout_split = checkout_date.split('/');


            //           	   var date1 = new Date(checkin_split[1]+'/'+checkin_split[0]+'/'+checkin_split[2]); 
            //   var date2 = new Date(checkout_split[1]+'/'+checkout_split[0]+'/'+checkout_split[2]); 
            //   var Difference_In_Time = date2.getTime() - date1.getTime(); 
            //   var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24); 


            //    $('#differ_days').val(Difference_In_Days)

            // var date3 = checkin_split[2]+'-'+checkin_split[1]+'-'+checkin_split[0]; 
            //   var date4 = checkout_split[2]+'-'+checkout_split[1]+'-'+checkout_split[0];   
            //   $.get("<?= url('room/getavailabelrooms') ?>", {'checkin':date3, 'checkout': date4}, function(resp){
            //   	$('.append_available_room').html(resp);
            //   })

            // reset_booking()

            // var checkin = $('.checkin').datepicker("getDate");
            // var checkout = $('.checkout').datepicker("getDate");

            // if(!checkout)
            // {

            //     $('.checkout').attr("disabled",false);

            // }
            // else{
            //     $('.checkout').attr("disabled",false);
            // }
        });

        $(document).on('click', '.add_room', function() {


            $('.gst').val(0);
            $('.payable_amt').val(0);
            $('.total_amt').val(0);

            var selected_room_id = $(this).attr('room_id');
            var selected_room_number_ = $(this).attr('room_number');
            var book_date = $(this).attr('book_date');
            var validate_room = true;



            var selected_room_price = $(this).attr('room_price');
            var selected_room_number = $(this).attr('room_number');
            if ($(this).is(':checked')) {
                var room_index = $('.room_row').length;
                var rows = '<div room_index="' + room_index + '" class="row room_row room_' + selected_room_number +
                    '_' + book_date + '">' +
                    '<div class="col-md-1">' +
                    '<div class="form-group">' +
                    '<label>R. No. <span class="text-danger">*</span></label>' +
                    '<input type="text" value="' + selected_room_number +
                    '" readonly="true" name="room_number[]" id="room_number" class="form-control room_number">' +
                    '<small class="has_error"> This Field is Required </small>' +
                    '</div>' +
                    '</div>'

                    +
                    '<div class="col-md-2">' +
                    '<div class="form-group">' +
                    '<label>Date <span class="text-danger">*</span></label>' +
                    '<input type="text" readonly="true"  name="book_date[]" id="book_date" class="form-control book_date" value="' +
                    book_date + '">' +
                    '<small class="has_error"> This Field is Required </small>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1">' +
                    '<div class="form-group">' +
                    '<label>R. Price <span class="text-danger">*</span></label>' +
                    '<input type="text" onkeypress="javascript:return validateNumber(event)"  name="room_price[]" id="room_price" class="form-control room_price" value="' +
                    selected_room_price + '">' +
                    '<small class="has_error"> This Field is Required </small>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '<div class="demo-checkbox extra_bed_checkbox">' +
                    '<input type="checkbox" name="extra_bed[]" id="extra_bed_' + selected_room_number + '_' +
                    book_date + '" class="extra_bed">' +
                    '<label for="extra_bed_' + selected_room_number + '_' + book_date +
                    '" class="available_status">Extra Bed</label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1 if_extra_bed">' +
                    '<div class="form-group">' +
                    '<label>Bed Qty </label>' +
                    '<input type="text" onkeypress="javascript:return validateNumber(event)"  value="1"  name="extra_bed_qty[]" id="extra_bed_qty" class="form-control extra_bed_qty">' +
                    '<small class="has_error"> This Field is Required </small>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-2 if_extra_bed">' +
                    '<div class="form-group">' +
                    '<label>Extra Bed Price </label>' +
                    '<input type="text" onkeypress="javascript:return validateNumber(event)"  value="100"  name="extra_bed_price[]" id="extra_bed_price" class="form-control extra_bed_price">' +
                    '<small class="has_error"> This Field is Required </small>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('.append_room_estimate').append(rows);


            } else {
                console.log('.room_' + selected_room_number + '_' + book_date);
                $('.room_' + selected_room_number + '_' + book_date).empty();

            }
            calc_amt();


        });

        $(document).on('keyup', '.refund_amount', function() {
            var refund_amount = Number($(this).val())
            if (refund_amount > 0) {
                $('.final_payment').val(0)

                $('.final_payment').attr('readonly', true)

            } else {
                $('.final_payment').attr('readonly', false)
            }
        })
        $("#form").submit(function(e) {
            e.preventDefault();
            var isValid = true;

            // var patient_reg_no = $(".patient_reg_no");
            // if(patient_reg_no.val()==""){
            // 	patient_reg_no.css("border", "1px solid red")
            // 	patient_reg_no.siblings(".has_error").show()
            // 	return false;
            // }else{
            // 	patient_reg_no.css("border", "1px solid #ced4da")
            // 	patient_reg_no.siblings(".has_error").hide()
            // }
            // var patient_name = $(".patient_name");
            // if(patient_name.val()==""){
            // 	patient_name.css("border", "1px solid red")
            // 	patient_name.siblings(".has_error").show()
            // 	return false;
            // }else{
            // 	patient_name.css("border", "1px solid #ced4da")
            // 	patient_name.siblings(".has_error").hide()
            // }
            // var patient_phone = $(".patient_phone");
            // if(patient_phone.val()==""){
            // 	patient_phone.css("border", "1px solid red")
            // 	patient_phone.siblings(".has_error").show()
            // 	return false;
            // }else{
            // 	patient_phone.css("border", "1px solid #ced4da")
            // 	patient_phone.siblings(".has_error").hide()
            // }
            // var patient_email = $(".patient_email");
            // if(patient_email.val()==""){
            // 	patient_email.css("border", "1px solid red")
            // 	patient_email.siblings(".has_error").show()
            // 	return false;
            // }else{
            // 	patient_email.css("border", "1px solid #ced4da")
            // 	patient_email.siblings(".has_error").hide()
            // }
            // var patient_address = $(".patient_address");
            // if(patient_address.val()==""){
            // 	patient_address.css("border", "1px solid red")
            // 	patient_address.siblings(".has_error").show()
            // 	return false;
            // }else{
            // 	patient_address.css("border", "1px solid #ced4da")
            // 	patient_address.siblings(".has_error").hide()
            // }
            // var patient_nationality = $(".patient_nationality");
            // if(patient_nationality.val()==""){
            // 	patient_nationality.css("border", "1px solid red")
            // 	patient_nationality.siblings(".has_error").show()
            // 	return false;
            // }else{
            // 	patient_nationality.css("border", "1px solid #ced4da")
            // 	patient_nationality.siblings(".has_error").hide()
            // }
            // var adults = $(".adults");
            // if(adults.val()==""){
            // 	adults.css("border", "1px solid red")
            // 	adults.siblings(".has_error").show()
            // 	return false;
            // }else{
            // 	adults.css("border", "1px solid #ced4da")
            // 	adults.siblings(".has_error").hide()
            // }
            // var child = $(".child");
            // if(child.val()==""){
            // 	child.css("border", "1px solid red")
            // 	child.siblings(".has_error").show()
            // 	return false;
            // }else{
            // 	child.css("border", "1px solid #ced4da")
            // 	child.siblings(".has_error").hide()
            // }

            // var gst_number = $(".gst_number");
            // if(gst_number.val()==""){
            // 	gst_number.css("border", "1px solid red")
            // 	gst_number.siblings(".has_error").show()
            // 	return false;
            // }else{
            // 	gst_number.css("border", "1px solid #ced4da")
            // 	gst_number.siblings(".has_error").hide()
            // }
            var mode_of_payment_id = $(".mode_of_payment_id");
            if (mode_of_payment_id.val() == "" || mode_of_payment_id.val() == "0") {
                mode_of_payment_id.css("border", "1px solid red")
                mode_of_payment_id.siblings(".has_error").show()
                isValid = false;
                return false;
            } else {
                mode_of_payment_id.css("border", "1px solid #ced4da")
                mode_of_payment_id.siblings(".has_error").hide()
            }

            // var final_payment = $(".final_payment");
            // if(final_payment.val()==""){
            // 	final_payment.css("border", "1px solid red")
            // 	final_payment.siblings(".has_error").show()
            // 	isValid = false;
            // 	return false;

            // }else{
            // 	final_payment.css("border", "1px solid #ced4da")
            // 	final_payment.siblings(".has_error").hide()
            // }
            var formData = new FormData($("#form")[0]);
            if (isValid) {
                start_loader();
                $.ajax({
                    url: "<?= url('booking') ?>/edit" + "/" + "<?= $booking->booking_id ?>",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        stop_loader();

                        if (data.status == "success") {

                            swal({
                                title: "Booking Updated Successfully",
                                text: "",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Ok",
                                cancelButtonText: false,
                                closeOnConfirm: false,
                                closeOnCancel: false,
                            }, function(isok) {
                                document.getElementById("form").reset();

                                window.location.assign(
                                    "<?= url('booking/print/' . $booking->booking_id) ?>");
                            });
                        } else if (data.status == "validate") {

                            $.toast({
                                heading: "Error",
                                text: data.message,
                                position: "top-right",
                                loaderBg: "#ff6849",
                                icon: "error",
                                hideAfter: 3500

                            });
                        }
                    }
                })
            }
        })

        // })
    </script>
@endsection
