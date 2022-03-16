@extends("layouts.app")
<?php
$this->title = 'Booking Report';
?>
@section('content')
    <style type="text/css">
        .COLOR_GREEN {
            color: green;
        }

        .COLOR_RED {
            color: red;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="text" name="from_date" id="from_date" class="form-control from_date">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>To Date </label>
                                    <input type="text" readonly="true" name="to_date" id="to_date"
                                        class="form-control to_date">
                                </div>
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a href="javascript:;" style="float:right;" class="export_csv">Export CSV</a>
                                </div>

                            </div>
                        </div>
                        <!-- <div  class="dataTables_filter">
                                  <label><input name="search" placeholder="Type and Hit Tab" type="text" class="input-xs form-control search " style="    height: 35px;"></label>
                              </div> -->
                        <div id="table_data" class="result_append">
                            @include('booking.room_report_row', [
                                'daily_collection' => $daily_collection,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade openDtlModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Booking Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body modal_detail">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.open_followup', function() {

                window.open($(this).attr('link'), '_blank');


            })
            var searchParams = {
                'from_date': '',
                'to_date': '',
                'search': '',
            };
            init_from_date();

            function init_from_date() {
                $('#from_date').datepicker({
                    setDate: 'today',
                    todayHighlight: true,
                    autoclose: true,
                    format: "dd/mm/yyyy"
                }).on('changeDate', function(selected) {
                    var from_date = $('#from_date').val().split("/");
                    var format_from_date = from_date[2] + '/' + from_date[1] + '/' + from_date[0];
                    searchParams.from_date = format_from_date;
                    start_loader();
                    $.get('{{ url('booking/room_report_search') }}', searchParams, function(data) {
                        // console.log(data);
                        if ($('#from_date').val() == '') {
                            $('.when_fromdate').hide('slow');
                        } else {
                            $('.when_fromdate').show('slow');
                        }
                        if ($('#to_date').val() == "") {
                            var minDate = new Date(selected.date.valueOf());
                            minDate.setDate(minDate.getDate() + 1)
                            $('#to_date').datepicker('setStartDate', minDate);
                            $('#to_date').datepicker("setDate", minDate);
                        }

                        $('.result_append').html(data)
                        stop_loader();

                    });
                });
            }


            init_to_date();

            function init_to_date() {
                $('#to_date').datepicker({
                    setDate: 'today',
                    todayHighlight: true,
                    autoclose: true,
                    format: "dd/mm/yyyy"
                }).on('changeDate', function(selected) {

                    var to_date = $('#to_date').val().split("/");
                    var format_to_date = to_date[2] + '/' + to_date[1] + '/' + to_date[0];
                    searchParams.to_date = format_to_date;
                    start_loader();


                    $.get('{{ url('booking/room_report_search') }}', searchParams, function(data) {
                        $('.result_append').html(data)
                        stop_loader();
                    });
                });
            }





            $(document).on('click', '.export_csv', function() {
                var params = $.param(searchParams);
                window.location = '<?= url('/booking/room_report_export') ?>?' + params;
            })



            $(document).on("blur", ".search", function() {
                searchParams.search = $(this).val();

                start_loader();
                $.get("<?= url('booking/room_report_search') ?>", searchParams, function(data) {
                    $(".result_append").html(data)
                    stop_loader();
                });

            });

        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on("click", ".delete", function() {
                var link = $(this).attr("link");
                var parent_tr = $(this).closest("tr");
                var result = confirm("Are you sure ?");
                if (result) {
                    $.get(link, function(data) {
                        if (data.status == "success") {
                            $.toast({
                                heading: "Message",
                                text: "Booking Cancel Successfully",
                                position: "top-right",
                                loaderBg: "#ff6849",
                                icon: "success",
                                hideAfter: 3500,
                                stack: 6
                            });
                            parent_tr.remove();
                            window.location.reload()
                        } else {

                            $.toast({
                                heading: "Message",
                                text: "Guest Not Deleted",
                                position: "top-right",
                                loaderBg: "#ff6849",
                                icon: "warning",
                                hideAfter: 3500,
                                stack: 6
                            });
                        }
                    });
                }

            })



            $(document).on("click", ".pagination a", function(event) {
                event.preventDefault();
                var page = $(this).attr("href").split("page=")[1];
                fetch_data(page);
            });

            function fetch_data(page) {

                start_loader();
                $.ajax({
                    url: "<?= url('/booking/room_report_search?page=') ?>" + page,
                    type: "GET",
                    data: searchParams,
                    success: function(data) {
                        $(".result_append").html(data);
                        stop_loader();
                    }
                });
            }
        });
    </script>
@endsection
