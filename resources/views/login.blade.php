@extends('layouts.app')
<?php
$this->title = 'Create Merchant';
?>
@section('content')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">
                <section class="sign-area panel p-40">
                    <h3 class="sign-title">Sign In </h3>
                    <div class="row row-rl-0">
                        <div class="col-sm-6 col-md-7 col-md-offset-3 col-sm-offset-3">
                            <form class="p-40" id="loginForm" action="#" method="post">
                                <div class="form-group">
                                    @csrf
                                    @method('POST')
                                    <label class="sr-only">Mobile</label>
                                    <input type="text" name="mobile" class="form-control input-lg" placeholder="Mobile">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Password</label>
                                    <input type="password" name="password" class="form-control input-lg"
                                        placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-block btn-lg">Sign In</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>


    </main>
    <script type="text/javascript">

        $('#loginForm').validate({ // initialize the plugin
            rules: {

                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10
                },
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 20
                },


            },
            submitHandler: function(form) {
                var isValid = true;

                if (isValid) {
                    $.ajax({
                        url: '{{ url('user/checklogin') }}',
                        type: "POST",
                        data: $("#loginForm").serialize(),
                        success: function(data) {
                            if (data.status == 'success') {
                                $("#loader_c").hide('slow');
                                swal("Congrats", "User Login Successfully", "success").then((
                                    value) => {
                                    var goto =
                                        "<?= url(isset($_GET['returnTo']) ? ($_GET['returnTo'] == 'cart' ? '/cart' : $_GET['returnTo']) : 'dashboard/index') ?>";
                                    window.location = goto;
                                });
                                jQuery('.alert-danger').hide();
                            } else if (data.status == 'fail') {
                                $('input[name=mobile]').css('border', '2px solid red');
                                $('input[name=password]').css('border', '2px solid red');
                                swal({
                                    title: "Notice",
                                    text: "Mobile Password Incorrect",
                                    icon: "warning",
                                    dangerMode: true,
                                });
                            } else {
                                swal({
                                    title: "Notice",
                                    text: "Otp Not verified",
                                    icon: "warning",
                                    dangerMode: true,
                                });
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
@endsection
