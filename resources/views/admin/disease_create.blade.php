@extends('layouts.app')
<?php
$this->title = 'Add Disease';
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
                <li class="breadcrumb-item"><a>Diseases</a> </li>
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
                        <h4 class="m-b-0 text-white">Disease Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="form">
                            {{ csrf_field() }}

                            <div class="form-body">
                                <!-- <h3 class="card-title">Franchisee Details</h3> -->
                                <div class="row p-t-20">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Disease Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="form-control title">
                                            <small class="has_error"> This Field is Required </small>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button style="    margin-top: 30px;" type="submit" class="btn btn-success save"> <i
                                                class="fa fa-check"></i> Save</button>

                                    </div>


                                    <!--/span-->

                                    <!--/span-->
                                </div>
                                <!--/row-->




                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('blur', '#title', function() {
                //validate form title
                if ($(this).val() != "" && $(this).val() != 0) {
                    $.ajax({
                        url: "{{ url('disease/checkvalidation') }}",
                        type: 'GET',
                        data: {
                            title: $(this).val()
                        },
                        success: function(resp) {
                            if (resp.status == false) {
                                $('.save').attr('disabled', true);
                                $('#title').siblings('.has_error').text(
                                    'This entry already exists').show();
                            } else {
                                $('#title').siblings('.has_error').hide()
                                $('.save').attr('disabled', false);
                            }

                        },

                    });

                }
            })

            $('#form').submit(function(e) {
                e.preventDefault();

                var title = $('input[name="title"]');
                if (title.val() == '') {
                    title.css('border', '1px solid red')
                    title.siblings('.has_error').show()
                    return false;
                } else {
                    title.css('border', '1px solid #ced4da')
                    title.siblings('.has_error').hide()
                }





                var formData = new FormData($('#form')[0]);
                var isValid = true;
                if (isValid) {
                    start_loader();
                    $.ajax({
                        url: "{{ url('disease/store') }}",
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            stop_loader();

                            if (data.status == 'success') {

                                swal({
                                    title: "Disease Added Successfully",
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
                                        "{{ url('disease/index/') }}");
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
