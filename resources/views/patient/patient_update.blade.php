@extends("layouts.app")
<?php
$this->title = 'Update patient';
?>
@section('content')
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
                        <h4 class="m-b-0 text-white">patient Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>patient reg no <span class="text-danger">*</span></label>
                                        <input type="text" value="<?= $patient->patient_reg_no ?>" name="patient_reg_no"
                                            id="patient_reg_no" class="form-control patient_reg_no">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>patient name <span class="text-danger">*</span></label>
                                        <input type="text" value="<?= $patient->patient_name ?>" name="patient_name"
                                            id="patient_name" class="form-control patient_name">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>patient phone <span class="text-danger">*</span></label>
                                        <input type="text" value="<?= $patient->patient_phone ?>" name="patient_phone"
                                            id="patient_phone" class="form-control patient_phone">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>patient age</label>
                                        <input type="text" value="<?= $patient->patient_age ?>" name="patient_age"
                                            id="patient_age" class="form-control patient_age">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>patient gender <span class="text-danger">*</span></label>
                                        <input value="<?= $patient->patient_gender ?>" name="patient_gender"
                                            id="patient_gender" class="form-control patient_gender">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>patient ipd_no <span class="text-danger">*</span></label>
                                        <input type="text" value="<?= $patient->ipd_no ?>" name="ipd_no" id="ipd_no"
                                            class="form-control ipd_no">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>


                            </div>





                            <div class="col-md-2">
                                <div class="form-group">
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
        $(document).ready(function() {






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
                // var patient_email = $(".patient_email");
                // if(patient_email.val()==""){
                // 	patient_email.css("border", "1px solid red")
                // 	patient_email.siblings(".has_error").show()
                // 	return false;
                // }else{
                // 	patient_email.css("border", "1px solid #ced4da")
                // 	patient_email.siblings(".has_error").hide()
                // }
                var patient_address = $(".patient_address");
                if (patient_address.val() == "") {
                    patient_address.css("border", "1px solid red")
                    patient_address.siblings(".has_error").show()
                    return false;
                } else {
                    patient_address.css("border", "1px solid #ced4da")
                    patient_address.siblings(".has_error").hide()
                }
                var patient_nationality = $(".patient_nationality");
                if (patient_nationality.val() == "") {
                    patient_nationality.css("border", "1px solid red")
                    patient_nationality.siblings(".has_error").show()
                    return false;
                } else {
                    patient_nationality.css("border", "1px solid #ced4da")
                    patient_nationality.siblings(".has_error").hide()
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
                var child = $(".child");
                if (child.val() == "") {
                    child.css("border", "1px solid red")
                    child.siblings(".has_error").show()
                    return false;
                } else {
                    child.css("border", "1px solid #ced4da")
                    child.siblings(".has_error").hide()
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

                var formData = new FormData($("#form")[0]);
                var isValid = true;
                if (isValid) {
                    start_loader();
                    $.ajax({
                        url: "<?= url('patient') ?>/edit" + "/" + "<?= $patient->patient_id ?>",
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            stop_loader();

                            if (data.status == "success") {

                                swal({
                                    title: "patient Updated Successfully",
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
                                        "<?= url('patient') ?>/index");
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
