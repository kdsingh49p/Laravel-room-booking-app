@extends('layouts.adminlogin')
<?php
$this->title = 'Login';
?>
@section('content')
    <section id="wrapper">
        <div class="login-register"
            style="background-image:url(<?= asset('public/assets/images/background/login-register.jpg') ?>);">
            <div class="login-box card" style="margin-top: 9%;">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="">
                        <h3 class="box-title m-b-20">Sign In</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" name="email" type="text" placeholder="email">
                                <small class="error has_error" style="display: none;">This Field is required</small>
                            </div>

                        </div>
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" type="password" placeholder="Password">
                                <small class="error has_error" style="display: none;">This Field is required</small>

                            </div>
                        </div>

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Log In</button>
                                <small class="has_error login_error" style="display: none;"></small>

                            </div>
                        </div>

                        <!--    <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    <div>Don't have an account? <a href="pages-register.html" class="text-info m-l-5"><b>Sign Up</b></a></div>
                                </div>
                            </div> -->
                    </form>

                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#loginform').submit(function(e) {
                e.preventDefault();
                var isValid = true;
                if ($('input[name="email"]').val().trim() == '') {
                    $('input[name="email"]').siblings('.has_error').show()
                    isValid = false;
                }
                if ($('input[name="password"]').val().trim() == '') {
                    isValid = false;
                    $('input[name="password"]').siblings('.has_error').show()
                }
                if (isValid) {
                    start_loader();

                    $.ajax({
                        url: "{{ url('user/login') }}",
                        type: "POST",
                        data: $("#loginform").serialize(),
                        success: function(data) {
                            stop_loader();

                            if (data.status == 'success') {
                                $('.login_error').hide();
                                window.location = "{{ url('/welcome') }}";
                            } else if (data.status == 'fail') {
                                $('input[name=email]').css('border', '2px solid red');
                                $('input[name=password]').css('border', '2px solid red');
                                $('.login_error').text('email Password wrong').show();

                            }


                        },

                    });
                }
                // your code here
            });

        })
    </script>
@endsection
