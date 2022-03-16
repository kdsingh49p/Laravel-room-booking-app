@extends('layouts.admin')
<?php
$this->title = 'Create Category';
?>
@section('content')

    <div class="col-md-12">
        <div class="alert alert-danger" tabindex='1' style="display:none;"></div>
        <div class="results" tabindex='1'></div>
        <form id="form" action="#" method="POST">
            @include('category.form', ['page_name' => 'create'])
        </form>
    </div>

    @if (count($categories) > 0)
        <div class="row table_row_c">
            <div class="col-md-12">
                <hr>
                <h3>List of Categories</h3>
                <!-- <div style="overflow-x:auto;"> -->

                <table class="table table-bordered table-striped category_table" style="width:100%;   background: #f9f9f9;">

                    <!-- Table Headings -->
                    <thead>
                        <!-- <th>Sr.</th> -->

                        <th></th>
                        <th>Actions</th>

                        <th>Title</th>
                        <th>Slug</th>
                        <th>Parent Category</th>

                    </thead>

                    <!-- Table Body -->
                    <tbody class="table_tbody">
                        @foreach ($categories as $key => $category_value)
                            <tr class="category_row_{{ $category_value->category_id }}">
                                <td>
                                </td>
                                <td>
                                    <a class="delete_action_icon delete_row" id="{{ $category_value->category_id }}"
                                        style="" onclick="return confirm('Are you sure?');"
                                        action="{{ url('category/delete/' . $category_value->category_id) }}"
                                        href="javascript:;">
                                        <i class="fa   fa-trash"></i>
                                    </a>
                                    <a class="edit_action_icon" id="{{ $category_value->category_id }}"
                                        href="javascript:;">
                                        <i class="fa   fa-edit "></i>
                                    </a>

                                </td>
                                <td class="table-text">
                                    <div>{{ $category_value->title }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $category_value->slug }}</div>
                                </td>
                                <td class="table-text">
                                    <?php if ($category_value->parent_id!=0): ?>
                                    <div>{{ $category_value->parent_category->title }}</div>
                                    <?php else: ?>
                                    <div>Parent</div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- </div> -->
        </div>
    @endif
    <div class="temp_append_row" style="display:none;"></div>

    <script>
        $(document).ready(function() {
            $("#company_type").select2({
                // tags: true
            });
            var myTable = $('.category_table').DataTable({
                "scrollY": "400px",
                order: [
                    [0, "desc"]
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Details for ' + data[2];
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                }
            });

            // $(document).on('click', '.table tr td  a.delete_row', function () {
            //  console.log('delete click on');
            // });
            // $('.category_table tbody').on('click', 'td  a.delete_row', function () {
            $(document).on('click', '.table tr td  a.delete_row', function() {

                var tr_temp = $(this).parents('tr');
                $("#loader_c").show();

                $.ajax({
                    url: "{{ url('admin/category/delete/') }}/" + $(this).attr('id'),
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(msg) {
                        console.log(msg);
                        // Do something with the result
                        $("#loader_c").hide('slow');
                        if (msg.status == 'delete') {
                            // myTable.row(tr_temp).remove().draw(false); 


                            swal("Message", "category Delete Successfully", "success").then((
                                value) => {
                                tr_temp.hide('slow', function() {
                                    $('.dtr-bs-modal').modal('hide');
                                    myTable.row(tr_temp).remove().draw(false);

                                });

                            });
                        } else {
                            jQuery('.alert-danger').append('<p>' + msg.status + '</p>');
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').focus();
                        }

                    }
                });



            });
            var edit_id = '';
            $(document).on('click', '.table tbody td  a.edit_action_icon', function() {
                $("#loader_c").show();
                $.ajax({
                    url: "{{ url('admin/category/update/') }}/" + $(this).attr('id'),
                    type: 'GET',
                    success: function(result) {
                        console.log(result);
                        // Do something with the result
                        if (result.status == 'found') {

                            console.log(result.data);
                            $('#title').val(result.data.title);
                            $('#slug').val(result.data.slug);
                            $('#parent_id').val(result.data.parent_id);
                            $('#parent_id').select2().trigger('change');



                            jQuery('.alert-danger').focus();
                            // $('.save').toggleClass('save update');
                            $('.save').val('Update');
                            $('.save').toggleClass('btn-success btn-primary');
                            $('#action').val('update');
                            $("#loader_c").hide('slow');
                            edit_id = result.data.category_id;
                            $('.dtr-bs-modal').modal('hide');
                            $("html, body").animate({
                                scrollTop: 0
                            }, "slow");

                        }
                    }
                });
            });


            $('#form').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true,

                    },
                    slug: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    var action_type = $('#action').val();
                    var url_c = '{{ url('admin/category/store') }}';
                    var method_c = "POST"
                    if (action_type == 'update') {
                        url_c = '{{ url('admin/category/edit/') }}/' + edit_id;
                        method_c = "PUT";
                    }
                    $.ajax({
                        url: url_c,
                        type: method_c,
                        data: $("#form").serialize(),
                        success: function(data) {
                            if (data.status == 'success') {
                                $("#loader_c").hide('slow');
                                var parent_cate = 'Parent';
                                if (data.data.parent_id != 0) {
                                    parent_cate = data.data.parent_category.title;
                                }
                                var htmlAppend = [

                                    ' ',
                                    '<a class="delete_action_icon delete_row" id="' +
                                    data.data.category_id +
                                    '"  onclick="return confirm("Are you sure?");"  href="javascript:;"><i class="fa   fa-trash"></i></a>' +
                                    '<a class="edit_action_icon" id="' + data.data
                                    .category_id +
                                    '"  href="javascript:;"><i class="fa   fa-edit "></i></a>',
                                    data.data.title,
                                    data.data.slug,
                                    parent_cate,
                                ];
                                if (action_type == 'update') {

                                    // var row_class = "tr.category_row_"+data.data.category_id;
                                    // var tr_edit_temp_ = $(row_class);  
                                    var tr_edit_temp_ = $('.edit_action_icon[id="' + data
                                        .data.category_id + '"]').parents('tr');
                                    tr_edit_temp_.hide('slow', function() {
                                        myTable.row(tr_edit_temp_).remove().draw(
                                            false);
                                    });
                                    swal("Congrats", "category Updated Successfully",
                                        "success").then((value) => {
                                        document.getElementById("form").reset();
                                        myTable.row.add(htmlAppend).draw();
                                        // $('.table_row_c').scrollTop($('.table_row_c')[0].scrollHeight);

                                        $("html, body").animate({
                                            scrollTop: $('.table_row_c')
                                                .prop("scrollHeight")
                                        }, 1000);

                                    });
                                    jQuery('.alert-danger').hide();
                                    $('.save').val('Create');
                                    $('.save').toggleClass('btn-success btn-primary');
                                    $('#action').val('Create');
                                } else {

                                    swal("Congrats", "category Added Successfully",
                                        "success").then((value) => {
                                        // window.location.assign("{{ url('admin//index') }}");        
                                        document.getElementById("form").reset();
                                        // $("html, body").animate({ scrollTop: 0 }, "slow");
                                        $("html, body").animate({
                                            scrollTop: $('.table_row_c')
                                                .prop("scrollHeight")
                                        }, 1000);
                                        // $(htmlAppend).insertBefore('table > tbody.table_tbody > tr:first');
                                        myTable.row.add(htmlAppend).draw();


                                    });
                                    jQuery('.alert-danger').hide();
                                }
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
                                    jQuery('.alert-danger').append('<p>' + value +
                                        '</p>');
                                });
                                $("#loader_c").hide('slow');
                            }

                        }
                    });
                    $("#loader_c").show();
                    // $('.results').html("<h1>category Added Successfully</h1>");
                    return false;
                }
            });
        });
    </script>

@endsection
