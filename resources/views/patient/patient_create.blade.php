@extends("layouts.app")
<?php
$this->title = 'Add patient';
?>
@section('content')
    <style type="text/css">
        .booking_date_s {
            color: blue;
            text-decoration: underline;
        }

        .available_status {
            color: green;
        }

        .booked_status {
            color: red;
        }

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
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><?= $this->title ?></h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a>Masters</a> </li>
                <li class="breadcrumb-item"><a>patient</a> </li>
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
                        <h4 class="m-b-0 text-white">Patient Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="form">
                            {{ csrf_field() }}
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Reg no <span class="text-danger">*</span></label>
                                        <input type="text" name="patient_reg_no" id="patient_reg_no"
                                            class="form-control patient_reg_no">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Patient Phone <span class="text-danger">*</span> <img
                                                src="{{ asset('public/loader.gif') }}" class="small_loader"
                                                style="display: none;width: 25px;"> </label>
                                        <input type="text" onkeypress="javascript:return validateNumber(event)"
                                            name="patient_phone" id="patient_phone" class="form-control patient_phone">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Patient Name <span class="text-danger">*</span></label>
                                        <input type="text" name="patient_name" id="patient_name"
                                            class="form-control patient_name">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Age <span class="text-danger">*</span></label>
                                        <input type="text" name="patient_age" id="patient_age"
                                            class="form-control patient_age">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select type="text" name="patient_gender" id="patient_gender"
                                            class="form-control patient_gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>IPD No.</label>
                                        <input type="text" name="ipd_no" id="ipd_no" class="form-control ipd_no">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Adhar card</label>
                                        <input type="text" name="adhar_no" id="adhar_no" class="form-control adhar_no">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Admission Date <span class="text-danger">*</span></label>
                                        <input type="text" name="admission_date" id="admission_date"
                                            class="form-control admission_date">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>CheckIn <span class="text-danger">*</span></label>
                                        <input type="text" name="checkin" id="checkin" class="form-control checkin">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>CheckOut <span class="text-danger">*</span></label>
                                        <input type="text" readonly="true" name="checkout" id="checkout"
                                            class="form-control checkout">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>





                            </div>
                            <!-- <div class="row ">
            <div class="col-md-2">
          <div class="form-group">
          <label>Room Number <span class="text-danger">*</span></label>
          <select name="room_id" id="room_id" class="room_id append_available_room form-control">
          
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
                            <div class="append_available_availability"></div>
                            <h3>Room Details</h3>
                            <hr>
                            <div class="append_room_estimate">

                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Receipt No. <span class="text-danger">*</span></label>
                                        <input type="text" readonly="true" value="{{ $new_receipt_id }}" name="receipt_no"
                                            id="receipt_no" class="form-control receipt_no">
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
                                                <option value="{{ $mode->mode_of_payment_id }}">{{ $mode->title }}
                                                </option>
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
                                <div class="col-md-2 credit_companies">
                                    <div class="form-group">
                                        <label>Companies</label>
                                        <select type="text" name="company_id" class="company_id form-control">
                                            <option value="">select</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->company_id }}">{{ $company->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>

                                <div class="col-md-4 complimentory_reason_div">
                                    <div class="form-group">
                                        <label>Complimantory Reason</label>
                                        <textarea type="text" name="complimentory_reason" class="complimentory_reason form-control"></textarea>
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
                                        <input type="text" name="total_amt" class="total_amt form-control" readonly="true">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="text" onkeypress="javascript:return validateNumber(event)"
                                            name="discount" class="discount form-control">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Payable Amount</label>
                                        <input type="text" name="payable_amt" class="payable_amt form-control"
                                            readonly="true">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Advance Payment</label>
                                        <input type="text" value="0" onkeypress="javascript:return validateNumber(event)"
                                            name="advance_paid" class="advance_paid form-control">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Balance Amount</label>
                                        <input type="text" onkeypress="javascript:return validateNumber(event)"
                                            name="balance_amount" class="balance_amount form-control" readonly="true">
                                        <small class="has_error"> This Field is Required </small>

                                    </div>
                                </div>

                            </div>

                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="hidden" id="differ_days" name="">

                            <button style="    margin-top: 30px;" type="submit" class="btn btn-success save"> <i
                                    class="fa fa-check"></i> Save patient</button>

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
            var payable_amt = $('.payable_amt').val();
            var balance_amount = Number(payable_amt) - Number(advance_paid);
            $('.balance_amount').val(balance_amount)
        }
        $(document).ready(function() {
            $(document).on('keyup', '.discount', function() {
                update_discount();
                update_balance_amount();
            })

            $(document).on('keyup', '.advance_paid', function() {
                update_balance_amount();
            })
            $(document).on('blur, input', '.patient_phone', function() {
                var patient_phone = $(this).val();
                $('.small_loader').show()
                if (patient_phone != "" && patient_phone.length >= 10) {
                    $.get('{{ url('booking/getDetails') }}', {
                        'phone': $(this).val()
                    }, function(resp) {
                        $('.small_loader').hide()

                        if (resp.status == 'success') {
                            var patient_data = resp.data;
                            $('.patient_name').val(patient_data.patient_name)
                            $('.patient_age').val(patient_data.patient_age)
                            $('.ipd_no').val(patient_data.ipd_no)
                            $('.admission_date').val(patient_data.admission_date)


                        } else {
                            $('.patient_name').val('')
                            $('.patient_age').val('')
                            $('.ipd_no').val('')
                            $('.admission_date').val('')


                        }
                    })
                }

            })

            function reset_booking() {

                $('.payable_amt').val(0);
                $('.total_amt').val(0);
                $('.append_room_estimate').empty()
            }

            function calc_amt() {
                var extra_bed_price = 0;
                $('.extra_bed').each(function() {
                    if ($(this).is(':checked') == true) {
                        var extra_bed_price_find = $(this).parents('.room_row').find('.extra_bed_price')
                            .val();

                        var extra_bed_qty = $(this).parents('.room_row').find('.extra_bed_qty').val();
                        var total_extra_bed_price = Number(extra_bed_price_find) * Number(extra_bed_qty);
                        console.log(total_extra_bed_price, 'total_extra_bed_price')
                        if (total_extra_bed_price != "") {
                            extra_bed_price += total_extra_bed_price;
                        }

                    }
                })
                setTimeout(function() {
                    console.log(extra_bed_price, 'extra_bed_price')

                }, 2000);

                //   			var lunch_amt = 0;
                //  			$('.lunch').each(function(){
                //  				if($(this).val()!=""){
                // lunch_amt +=  Number($(this).val());
                // 		}
                //   			})

                //   			var dinner_amt = 0;
                //  			$('.dinner').each(function(){
                //  				if($(this).val()!=""){
                //   					dinner_amt +=  Number($(this).val());
                //   				}
                //   			})

                var room_price_amt = 0;
                $('.room_price').each(function() {
                    if ($(this).val() != "") {
                        room_price_amt += Number($(this).val());
                    }
                })


                var total_amt = Number(extra_bed_price) + Number(room_price_amt);
                $('.total_amt').val(total_amt);
                $('.payable_amt').val(total_amt);
                if (total_amt > 999) {
                    var gst = Number(total_amt * 12 / 100);

                    $('.gst').val(gst);
                    // $('.payable_amt').val(Number(gst+total_amt));
                } else {
                    // $('.payable_amt').val(total_amt);
                    $('.gst').val(gst);
                }

                update_discount();
                update_balance_amount();

            }



            $(document).on('click', '.extra_bed', function() {
                var extra_bed = $('.extra_bed');
                if (extra_bed.is(':checked') == true) {
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
            $(document).on('keyup', '.room_price', function() {
                var amt = $(this).val();
                if (amt != "") {
                    calc_amt()
                }
            })
            $(document).on('click', '.add_room', function() {



                $('.payable_amt').val(0);
                $('.total_amt').val(0);

                var selected_room_id = $(this).attr('room_id');
                var selected_room_number_ = $(this).attr('room_number');
                var book_date = $(this).attr('book_date');
                var book_date2 = $(this).attr('book_date2');
                var validate_room = true;



                var selected_room_price = $(this).attr('room_price');
                var selected_room_number = $(this).attr('room_number');
                if ($(this).is(':checked')) {
                    var room_index = $('.room_row').length;

                    var rows = '<div room_index="' + room_index + '" class="row room_row room_' +
                        selected_room_number + '_' + book_date + '">' +
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
                        '<input type="text" readonly="true"  name="book_date2[]" id="book_date2" class="form-control book_date2" value="' +
                        book_date2 + '">' +
                        '<input type="hidden" readonly="true"  name="book_date[]" id="book_date" class="form-control book_date" value="' +
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
                        '<input type="checkbox" name="extra_bed[]" id="extra_bed_' + selected_room_number +
                        '_' + book_date + '" class="extra_bed">' +
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

            jQuery('#admission_date').datepicker({
                toggleActive: true,
                // startDate:'today',
                autoclose: true,
                todayHighlight: true,
                format: "dd/mm/yyyy"
            })
            jQuery('#checkin').datepicker({
                toggleActive: true,
                // startDate:'today',
                autoclose: true,
                todayHighlight: true,
                format: "dd/mm/yyyy"
            }).on('changeDate', function(selected) {
                var minDate = new Date(selected.date.valueOf());
                minDate.setDate(minDate.getDate() + 1)
                $('.checkout').datepicker({
                    format: "dd/mm/yyyy",
                })
                // $('.checkout').datepicker('setStartDate', minDate);
                $('.checkout').datepicker("setDate", minDate);
                reset_booking()
                // $('.checkout').datepicker("dateFormat","dd/mm/yyyy");

            });
            $('.checkout').on('change', function() {
                var checkin_date = $('.checkin').val()
                var checkout_date = $('.checkout').val()
                var checkin_split = checkin_date.split('/');
                var checkout_split = checkout_date.split('/');


                var date1 = new Date(checkin_split[1] + '/' + checkin_split[0] + '/' + checkin_split[2]);
                var date2 = new Date(checkout_split[1] + '/' + checkout_split[0] + '/' + checkout_split[2]);
                var Difference_In_Time = date2.getTime() - date1.getTime();
                var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

                $('#differ_days').val(Difference_In_Days)

                var date3 = checkin_split[2] + '-' + checkin_split[1] + '-' + checkin_split[0];
                var date4 = checkout_split[2] + '-' + checkout_split[1] + '-' + checkout_split[0];
                $.get("<?= url('room/getavailabelrooms') ?>", {
                    'checkin': date3,
                    'checkout': date4
                }, function(resp) {
                    $('.append_available_availability').html(resp);
                })

                reset_booking()

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

            // if(prefill_hotel_checkin!=""){
            //    $('.hotel_checkin_'+hotel_row_index).datepicker("setDate",prefill_hotel_checkin);
            //   $('.checkout'+hotel_row_index).datepicker("setDate",prefill_hotel_checkout);
            // }

            // jQuery('#checkout').datepicker({
            //     toggleActive: true
            // });
            $(document).on("blur", "#patient_reg_no", function() {

                //validate form patient_reg_no
                if ($(this).val() != "" && $(this).val() != 0) {
                    $.ajax({
                        url: "{{ url('patient/checkvalidation') }}",
                        type: "GET",
                        data: {
                            patient_reg_no: $(this).val()
                        },
                        success: function(resp) {
                            if (resp.status == false) {
                                $(".save").attr("disabled", true);
                                $("#patient_reg_no").siblings(".has_error").text(
                                    "This entry already exists").show();
                            } else {
                                $("#patient_reg_no").siblings(".has_error").hide()
                                $(".save").attr("disabled", false);
                            }

                        },

                    });

                }
            })

            $("#form").submit(function(e) {
                e.preventDefault();

                var patient_reg_no = $(".patient_reg_no");
                if (patient_reg_no.val() == "") {
                    patient_reg_no.css("border", "1px solid red")
                    patient_reg_no.siblings(".has_error").show()
                    return false;
                } else {
                    patient_reg_no.css("border", "1px solid #ced4da")
                    patient_reg_no.siblings(".has_error").hide()
                }
                var patient_name = $(".patient_name");
                if (patient_name.val() == "") {
                    patient_name.css("border", "1px solid red")
                    patient_name.siblings(".has_error").show()
                    return false;
                } else {
                    patient_name.css("border", "1px solid #ced4da")
                    patient_name.siblings(".has_error").hide()
                }
                var patient_phone = $(".patient_phone");
                if (patient_phone.val() == "") {
                    patient_phone.css("border", "1px solid red")
                    patient_phone.siblings(".has_error").show()
                    return false;
                } else {
                    patient_phone.css("border", "1px solid #ced4da")
                    patient_phone.siblings(".has_error").hide()
                }
                // var patient_age = $(".patient_age");
                // if(patient_age.val()==""){
                // 	patient_age.css("border", "1px solid red")
                // 	patient_age.siblings(".has_error").show()
                // 	return false;
                // }else{
                // 	patient_age.css("border", "1px solid #ced4da")
                // 	patient_age.siblings(".has_error").hide()
                // }
                // var ipd_no = $(".ipd_no");
                // if(ipd_no.val()==""){
                // 	ipd_no.css("border", "1px solid red")
                // 	ipd_no.siblings(".has_error").show()
                // 	return false;
                // }else{
                // 	ipd_no.css("border", "1px solid #ced4da")
                // 	ipd_no.siblings(".has_error").hide()
                // }
                var admission_date = $(".admission_date");
                if (admission_date.val() == "") {
                    admission_date.css("border", "1px solid red")
                    admission_date.siblings(".has_error").show()
                    return false;
                } else {
                    admission_date.css("border", "1px solid #ced4da")
                    admission_date.siblings(".has_error").hide()
                }
                var adults = $(".adults");
                if (adults.val() == "") {
                    adults.css("border", "1px solid red")
                    adults.siblings(".has_error").show()
                    return false;
                } else {
                    adults.css("border", "1px solid #ced4da")
                    adults.siblings(".has_error").hide()
                }

                var checkin = $(".checkin");
                if (checkin.val() == "") {
                    checkin.css("border", "1px solid red")
                    checkin.siblings(".has_error").show()
                    return false;
                } else {
                    checkin.css("border", "1px solid #ced4da")
                    checkin.siblings(".has_error").hide()
                }
                var checkout = $(".checkout");
                if (checkout.val() == "") {
                    checkout.css("border", "1px solid red")
                    checkout.siblings(".has_error").show()
                    return false;
                } else {
                    checkout.css("border", "1px solid #ced4da")
                    checkout.siblings(".has_error").hide()
                }
                var room_id = $(".room_id");
                if (room_id.val() == "") {
                    room_id.css("border", "1px solid red")
                    room_id.siblings(".has_error").show()
                    return false;
                } else {
                    room_id.css("border", "1px solid #ced4da")
                    room_id.siblings(".has_error").hide()
                }
                // var gst_number = $(".gst_number");
                // if(gst_number.val()==""){
                // 	gst_number.css("border", "1px solid red")
                // 	gst_number.siblings(".has_error").show()
                // 	return false;
                // }else{
                // 	gst_number.css("border", "1px solid #ced4da")
                // 	gst_number.siblings(".has_error").hide()
                // }

                var receipt_no = $(".receipt_no");
                if (receipt_no.val() == "" || receipt_no.val() == "0") {
                    receipt_no.css("border", "1px solid red")
                    receipt_no.siblings(".has_error").show()
                    return false;
                } else {
                    receipt_no.css("border", "1px solid #ced4da")
                    receipt_no.siblings(".has_error").hide()
                }

                var mode_of_payment_id = $(".mode_of_payment_id");
                if (mode_of_payment_id.val() == "" || mode_of_payment_id.val() == "0") {
                    mode_of_payment_id.css("border", "1px solid red")
                    mode_of_payment_id.siblings(".has_error").show()
                    return false;
                } else {
                    mode_of_payment_id.css("border", "1px solid #ced4da")
                    mode_of_payment_id.siblings(".has_error").hide()
                }

                var advance_paid = $(".advance_paid");
                if (advance_paid.val() == "") {
                    advance_paid.css("border", "1px solid red")
                    advance_paid.siblings(".has_error").show()
                    return false;
                } else {
                    advance_paid.css("border", "1px solid #ced4da")
                    advance_paid.siblings(".has_error").hide()
                }

                // var payable_amt = $(".payable_amt");
                // if(payable_amt.val()=="" || payable_amt.val()=="0"){
                // 	payable_amt.css("border", "1px solid red")
                // 	payable_amt.siblings(".has_error").show()
                // 	return false;
                // }else{
                // 	payable_amt.css("border", "1px solid #ced4da")
                // 	payable_amt.siblings(".has_error").hide()
                // }

                var formData = new FormData($("#form")[0]);
                var isValid = true;
                if (isValid) {
                    start_loader();
                    $.ajax({
                        url: "<?= url('patient') ?>/store",
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            stop_loader();

                            if (data.status == "success") {

                                swal({
                                    title: "patient Added Successfully",
                                    text: "",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    cancelButtonText: false,
                                    closeOnConfirm: false,
                                    closeOnCancel: false,
                                }, function(isok) {
                                    // document.getElementById("form").reset();
                                    // To set two dates to two variables 
                                    window.location.reload()
                                    // window.location.assign("<?= url('patient') ?>/index");
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

        })
    </script>
@endsection
