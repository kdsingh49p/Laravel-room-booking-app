@extends('layouts.app')
<?php
$this->title = 'Add Mode of Payment';
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
                <li class="breadcrumb-item"><a>Mode of Payments</a> </li>
                <li class="breadcrumb-item active"><?= $this->title ?></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Details</h4>
                    </div>
                    <div class="card-body">

                        <form id="form" action="#" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input value="{{ $mop->title ?? '' }}" id="title" name="title" type="text"
                                            class="form-control">
                                        <p class="has_error" style="display: none;"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">&nbsp;</label>
                                    <div class="form-group">
                                        <input type="submit" value="Create" class='btn btn-success save'>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div id="form-errors"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $(document).on('blur', '#title', function() {
                //validate form title
                if ($(this).val() != "" && $(this).val() != 0) {
                    $.ajax({
                        url: "{{ url('mode-of-payment/checkvalidation') }}",
                        type: 'GET',
                        data: {
                            title: $(this).val()
                        },
                        success: function(resp) {
                            if (resp.status == false) {
                                $('.save').attr('disabled', true);
                                $('#title').siblings('.has_error').text(
                                    'This entry already exists ').show();
                            } else {
                                $('#title').siblings('.has_error').hide()
                                $('.save').attr('disabled', false);
                            }

                        },

                    });

                }
            })

            $(document).on('click', '.save', function(e) {
                e.preventDefault();
                var title = $('input[name="title"]');
                if (title.val() == "") {
                    title.siblings('.has_error').text("This Field is required").show()
                    return false;
                } else {
                    title.siblings('.has_error').hide();
                }
                $.ajax({
                    url: "{{ url('mode-of-payment/store') }}",
                    type: 'POST',
                    data: $("#form").serialize(),
                    success: function(data) {
                        if (data.status == 'success') {

                            swal({
                                title: "Mode of Payment Saved Successfully!",
                                text: "",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Ok",
                                cancelButtonText: false,
                                closeOnConfirm: false,
                                closeOnCancel: false,
                            });
                            document.getElementById("form").reset();
                        } else if (data.status == 'validate') {

                            $.toast({
                                heading: 'Error',
                                text: data.message,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 3500

                            });
                        } else {
                            $('.results').html('<div class="alert alert-danger">' + data
                                .status + '</div>');
                        }

                    },
                    error: function(jqXhr) {
                        if (jqXhr.status === 422) {
                            //process validation errors here.
                            var errors = jqXhr
                            .responseJSON; //this will get the errors response data.
                            //show them somewhere in the markup
                            //e.g

                            errorsHtml = '<div class="alert alert-danger"><ul>';

                            $.each(errors.errors, function(key, value) {
                                errorsHtml += '<li>' + value[0] +
                                '</li>'; //showing only the first error.
                            });
                            errorsHtml += '</ul></di>';

                            $('#form-errors').html(
                            errorsHtml); //appending to a <div id="form-errors"></div> inside form
                        } else {
                            /// do some thing else
                        }
                    }
                });
            })



        });
    </script>
@endsection
