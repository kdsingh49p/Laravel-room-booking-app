@extends('layouts.app')
<?php $this->title = 'Mode of Payments'; ?>
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><?= $this->title ?></h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('franchisee_panel/welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a>Masters</a> </li>

                <li class="breadcrumb-item active"><?= $this->title ?></li>
            </ol>
        </div>
    </div>

    <!-- Main content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- /.form-group -->
                        <div id="table_data">
                            @include('mode-of-payment.list', ['mop' => $mop])
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Mode of Payment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form id="edit_form">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                    <p class="title_error error"></p>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="results"></div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="mode_of_payment_id" id="mode_of_payment_id">
                    <button type="button" class="btn btn-primary data_update">Update</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.action_delete', function() {
                var delete_id = $(this).attr('id');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this entry!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }, function(willDelete) {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('mode-of-payment/delete/') }}/" + delete_id,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(msg) {
                                if (msg.status == 'success') {
                                    swal({
                                        title: "Mode of Payment Deleted Successfully!",
                                        text: "",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Ok",
                                        cancelButtonText: false,
                                        closeOnConfirm: false,
                                        closeOnCancel: false,
                                    }, function(modeOfPayment) {
                                        if (modeOfPayment) {
                                            window.location.reload();
                                        }
                                    });
                                } else {
                                    $.toast({
                                        heading: 'Message',
                                        text: 'Mode of payment not deleted',
                                        position: 'top-right',
                                        loaderBg: '#ff6849',
                                        icon: 'warning',
                                        hideAfter: 3500,
                                        stack: 6
                                    });


                                }


                            }
                        });

                    }
                });

            })
            $(document).on('click', '.action_edit', function() {
                var edit_id = $(this).attr('id');
                $.get("{{ url('/mode-of-payment/update/') }}/" + edit_id, {}, function(edit_data) {
                    if (edit_data.status == "found") {
                        $('#mode_of_payment_id').val(edit_data.data.mode_of_payment_id);
                        $('#title').val(edit_data.data.title);
                        $('#editModal').modal('show');
                    }
                })

                $(document).on('click', '.data_update', function() {
                    var title = $('#title');

                    if (title.val() == "") {
                        $('.title_error').text('This Field is Required');
                        $('.title_error').show();

                    } else {
                        $('.error').hide();
                        var mode_of_payment_id = $('#mode_of_payment_id').val();

                        $.ajax({
                            url: "{{ url('mode-of-payment/edit/') }}/" +
                                mode_of_payment_id,
                            type: 'PUT',
                            data: $("#edit_form").serialize(),
                            success: function(msg) {
                                if (msg.status == 'update') {
                                    swal({
                                        title: "Mode of Payment Updated Successfully!",
                                        text: "",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Ok",
                                        cancelButtonText: false,
                                        closeOnConfirm: false,
                                        closeOnCancel: false,
                                    }, function(modeOfPayment) {
                                        if (modeOfPayment) {
                                            $('#editModal').modal('hide');
                                            window.location.reload();

                                        }
                                    });


                                } else {
                                    swal({
                                        title: "Error",
                                        text: msg.status,
                                        icon: "warning",
                                        // buttons: true,
                                        dangerMode: true,
                                    });

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

                                    $('.results').html(
                                    errorsHtml); //appending to a <div id="form-errors"></div> inside form
                                } else {
                                    /// do some thing else
                                }
                            }
                        });

                    }
                });
            })
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });


            function fetch_data(page) {
                $.ajax({
                    url: "{{ url('/mode-of-payment/fetchdata?page=') }}" + page,
                    type: 'GET',
                    success: function(data) {
                        $('#table_data').html(data);
                    }
                });
            }

        });
    </script>
@endsection
