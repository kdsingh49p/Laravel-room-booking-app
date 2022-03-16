@extends("layouts.app")
<?php
$this->title = 'patients';
?>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dataTables_filter">
                            <label><input name="search" placeholder="Type and Hit Tab" type="text"
                                    class="input-xs form-control search " style="    height: 35px;"></label>
                        </div>
                        <div id="table_data" class="result_append">
                            @include('patient.patient_row', ['patient' => $patient])
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
                    <h4 class="modal-title" id="myLargeModalLabel">patient Detail</h4>
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

            $(document).on("click", ".delete", function() {
                var link = $(this).attr("link");
                var parent_tr = $(this).closest("tr");
                var result = confirm("Are you sure ?");
                if (result) {
                    $.get(link, function(data) {
                        if (data.status == "success") {
                            $.toast({
                                heading: "Message",
                                text: "patient Deleted Successfully",
                                position: "top-right",
                                loaderBg: "#ff6849",
                                icon: "success",
                                hideAfter: 3500,
                                stack: 6
                            });
                            parent_tr.remove();

                        } else {

                            $.toast({
                                heading: "Message",
                                text: "patient Not Deleted",
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

            $(document).on("click", "input[name=user_status]", function() {
                var attrfr = $(this).attr("eid");

                $.get("<?= url('patient/active-inactive') ?>" + "/" + attrfr, function(data) {

                });
            })

            $(document).on("click", ".openDetailModal", function() {
                start_loader()
                var attrfr = $(this).attr("eid");
                $.get("<?= url('patient/show') ?>" + "/" + attrfr, function(data) {
                    $(".modal_detail").html(data)
                    $(".openDtlModal").modal("show")
                    stop_loader();
                });
            })



            var searchParams = {
                "search": "",
            };

            $(document).on("blur", ".search", function() {
                searchParams.search = $(this).val();

                start_loader();
                $.get("<?= url('patient/search') ?>", searchParams, function(data) {
                    $(".result_append").html(data)
                    stop_loader();
                });

            });

            $(document).on("click", ".pagination a", function(event) {
                event.preventDefault();
                var page = $(this).attr("href").split("page=")[1];
                fetch_data(page);
            });

            function fetch_data(page) {

                start_loader();
                $.ajax({
                    url: "<?= url('/patient/search?page=') ?>" + page,
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
