@extends("layouts.app")
<?php
$this->title = 'Add User';
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
                <li class="breadcrumb-item"><a>Users</a> </li>
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
                        <h4 class="m-b-0 text-white">User Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control name">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" id="email" class="form-control email">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="text" name="password_hint" id="password_hint"
                                            class="form-control password_hint">
                                        <small class="has_error"> This Field is Required </small>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button style="    margin-top: 30px;" type="submit" class="btn btn-success save"> <i
                                                class="fa fa-check"></i> Save</button>

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

            $(document).on("blur", "#email", function() {

                //validate form email
                if ($(this).val() != "" && $(this).val() != 0) {
                    $.ajax({
                        url: "{{ url('user-register/checkvalidation') }}",
                        type: "GET",
                        data: {
                            email: $(this).val()
                        },
                        success: function(resp) {
                            if (resp.status == false) {
                                $(".save").attr("disabled", true);
                                $("#email").siblings(".has_error").text(
                                    "This entry already exists").show();
                            } else {
                                $("#email").siblings(".has_error").hide()
                                $(".save").attr("disabled", false);
                            }

                        },

                    });

                }
            })

            $("#form").submit(function(e) {
                e.preventDefault();

                var name = $(".name");
                if (name.val() == "") {
                    name.css("border", "1px solid red")
                    name.siblings(".has_error").show()
                    return false;
                } else {
                    name.css("border", "1px solid #ced4da")
                    name.siblings(".has_error").hide()
                }
                var email = $(".email");
                if (email.val() == "") {
                    email.css("border", "1px solid red")
                    email.siblings(".has_error").show()
                    return false;
                } else {
                    email.css("border", "1px solid #ced4da")
                    email.siblings(".has_error").hide()
                }
                var password_hint = $(".password_hint");
                if (password_hint.val() == "") {
                    password_hint.css("border", "1px solid red")
                    password_hint.siblings(".has_error").show()
                    return false;
                } else {
                    password_hint.css("border", "1px solid #ced4da")
                    password_hint.siblings(".has_error").hide()
                }
                var formData = new FormData($("#form")[0]);
                var isValid = true;
                if (isValid) {
                    start_loader();
                    $.ajax({
                        url: "<?= url('user-register') ?>/store",
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            stop_loader();

                            if (data.status == "success") {

                                swal({
                                    title: "User Added Successfully",
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
                                        "<?= url('user-register') ?>/index");
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
