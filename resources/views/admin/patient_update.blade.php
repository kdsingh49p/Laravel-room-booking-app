@extends('layouts.app')
<?php
$this->title = 'Update Patient';
?>
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><?= $this->title ?></h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a>Masters</a> </li>
                <li class="breadcrumb-item"><a href="{{ url('patient/index') }}">Patients</a> </li>
                <li class="breadcrumb-item active"><?= $this->title ?></li>
            </ol>
        </div>
        <div class="">
            <button
                class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i
                    class="ti-settings text-white"></i></button>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Patient Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="form">
                            {{ csrf_field() }}

                            <div class="form-body">
                                <!-- <h3 class="card-title">Franchisee Details</h3> -->
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Patient Id <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ $patient->patient_id }}" type="text" readonly="true"
                                                name="patient_id" id="patient_id" class="form-control patient_id">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Disease <span
                                                    class="text-danger">*</span></label>
                                            <select class="select2_c patient_disease_id form-control"
                                                name="patient_disease_id" id="patient_disease_id">
                                                <option value="">Select Disease</option>
                                                <?php if (count($diseases) >0 ): ?>
                                                <?php foreach ($diseases as $key => $item): ?>
                                                <option
                                                    <?= $patient->patient_disease_id == $item->disease_id ? 'selected' : '' ?>
                                                    value="<?= $item->disease_id ?>"><?= $item->title ?></option>

                                                <?php endforeach ?>

                                                <?php endif ?>
                                            </select>
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Patient Name <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ $patient->patient_name }}" type="text" name="patient_name"
                                                id="patient_name" class="form-control patient_name">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Patient Age <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ $patient->patient_age }}" type="number" name="patient_age"
                                                id="patient_age" min="1" max="200" class="form-control patient_age">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Patient Mobile <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ $patient->patient_mobile }}"
                                                onkeypress="javascript:return validateNumber(event)" type="tel" max="10"
                                                name="patient_mobile" id="patient_mobile"
                                                class="form-control patient_mobile">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Patient Address <span
                                                    class="text-danger">*</span></label>
                                            <textarea type="text" rows="3" name="patient_address" id="patient_address" class="form-control patient_address">
                                                      {{ $patient->patient_address }}
                                                    </textarea>
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-actions">
                                            <label></label>
                                            <br><button type="submit" class="btn btn-success save"> <i
                                                    class="fa fa-check"></i> Update</button>
                                        </div>
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
            $('#form').submit(function(e) {
                e.preventDefault();
                var patient_disease_id = $('select[name="patient_disease_id"]');
                console.log(patient_disease_id.val())
                if (patient_disease_id.val() == '') {
                    patient_disease_id.css('border', '1px solid red')
                    patient_disease_id.siblings('.has_error').show()
                    return false;
                } else {
                    patient_disease_id.css('border', '1px solid #ced4da')
                    patient_disease_id.siblings('.has_error').hide()
                }
                var patient_name = $('input[name="patient_name"]');
                if (patient_name.val() == '') {
                    patient_name.css('border', '1px solid red')
                    patient_name.siblings('.has_error').show()
                    return false;
                } else {
                    patient_name.css('border', '1px solid #ced4da')
                    patient_name.siblings('.has_error').hide()
                }
                var patient_age = $('input[name="patient_age"]');
                if (patient_age.val() == '') {
                    patient_age.css('border', '1px solid red')
                    patient_age.siblings('.has_error').show()
                    return false;
                } else {
                    patient_age.css('border', '1px solid #ced4da')
                    patient_age.siblings('.has_error').hide()
                }
                var patient_mobile = $('input[name="patient_mobile"]');
                if (patient_mobile.val() == '') {
                    patient_mobile.css('border', '1px solid red')
                    patient_mobile.siblings('.has_error').show()
                    return false;
                } else {
                    patient_mobile.css('border', '1px solid #ced4da')
                    patient_mobile.siblings('.has_error').hide()
                }
                var patient_age = $('input[name="patient_age"]');
                if (patient_age.val() == '') {
                    patient_age.css('border', '1px solid red')
                    patient_age.siblings('.has_error').show()
                    return false;
                } else {
                    patient_age.css('border', '1px solid #ced4da')
                    patient_age.siblings('.has_error').hide()
                }
                var patient_address = $('textarea[name="patient_address"]');
                if (patient_address.val() == '') {
                    patient_address.css('border', '1px solid red')
                    patient_address.siblings('.has_error').show()
                    return false;
                } else {
                    patient_address.css('border', '1px solid #ced4da')
                    patient_address.siblings('.has_error').hide()
                }

                var formData = new FormData($('#form')[0]);
                var isValid = true;
                if (isValid) {
                    start_loader();
                    $.ajax({
                        url: "{{ url('patient/edit/') }}" + '/' + "<?= $patient->p_id ?>",
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            stop_loader();
                            if (data.status == 'success') {
                                swal({
                                    title: "Patient Updated Successfully",
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
                                        "{{ url('patient/index/') }}");
                                });
                            } else if (data.status == 'validate') {
                                $.toast({
                                    heading: 'Error',
                                    text: data.message,
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'error',
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
