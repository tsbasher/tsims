@extends('backend.admin.layouts.app')
@section('title', 'Inquery')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <br>
                        <br>
                        <h2 class="text-center">Product Inquery </h2>
                        <br>
                        <br>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                
                                <address>
                                    <strong>{{ $inquery->name }}</strong><br>
                                    {{ $inquery->company?$inquery->company:''}}<br>
                                    Phone: {{ $inquery->phone }}<br>
                                    Email: {{ $inquery->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-5 invoice-col">
                                
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 invoice-col text-left">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Code</th>
                                            <th>Product</th>
                                            <th class="text-center">Group</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Subcategory</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inquery->details as $p)
                                            <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $p->product->code }}</td>
                                            <td>{{ $p->product->name }}</td>
                                            <td class="text-center">{{ $p->product->group->name }}</td>
                                            <td class="text-center">{{ $p->product->category->name }}</td>
                                            <td class="text-center">{{ $p->product->subCategory?$p->product->subCategory->name:'' }}</td>
                                            
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row mt-4">
                            <h5>Message:</h5>
                            <p>{{ $inquery->message }}</p>
                            </div>

                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('script')
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.full.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        var get_workorder_by_customer =
            "{{ route('common.get_workorder_by_customer', ['customer_id' => '*']) }}";

        $(document).ready(function() {
            $(".select2").select2();
            debugger;
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });
            var terms_count = 1;
            $("#workorder_id").change(function(e) {
                debugger;
                var workorder_ids = $(this).val();
                if (workorder_ids.length == 0) {
                    $("#workorder_item_table").find("tbody").empty();
                    return;
                }
                removeorder(workorder_ids);
                $.each(workorder_ids, function(index, value) {
                    if (!isAlreadyAdded(value)) {
                        $.ajax({
                            url: "{{ route('admin.get_workorder', ['workorder_id' => '*']) }}"
                                .replace('*',
                                    value),
                            type: 'GET',
                            success: function(data) {
                                debugger;

                                var index = 1;
                                $.each(data, function(key, value) {

                                    $.each(value.details, function(dkey,
                                        dvalue) {
                                        debugger;
                                        var product_id = dvalue
                                            .product_id;
                                        var product_text = dvalue
                                            .product.name;
                                        var style_id = dvalue.style_id;
                                        var style_text = dvalue.style
                                            .name;
                                        var color_id = dvalue.color_id;
                                        var color_text = dvalue.color
                                            .name;
                                        var unit_id = dvalue
                                            .quantity_unit_id;
                                        var unit_text = dvalue
                                            .quantity_unit.name;
                                        var measurement = dvalue
                                            .measurement;
                                        var quantity = dvalue.quantity;
                                        var rate = dvalue.unit_price;
                                        var total = dvalue.total_price;
                                        var description = dvalue
                                            .description;
                                        html = `<tr>
                            <td>
                        
                            ${index++}
                                    </td>
                                    <td>
                                        <input type="hidden" name="workorders[]" value="${value.id}"/>
                                        ${value.order_number}
                                    </td>
                                    <td>
                                        <input type="hidden" name="product_ids[]" value="${product_id}"/>
                                        ${product_text}
                                    </td>
                                    <td>
                                        <input type="hidden" name="style_ids[]" value="${style_id}"/>
                                        ${style_text}
                                    </td>
                                    <td>
                                        <input type="hidden" name="color_ids[]" value="${color_id}"/>
                                        ${color_text}
                                    </td>
                                    <td>
                                        <input type="hidden" name="unit_ids[]" value="${unit_id}"/>
                                        ${unit_text}
                                    </td>
                                    <td>
                                        <input type="hidden" name="measurements[]" value="${measurement}"/>
                                        ${measurement}
                                    </td>
                                    <td>
                                        <input type="text" name="quantities[]" value="${quantity}"/>
                                        
                                    </td>
                                    <td>
                                        <input type="text" name="details_description[]" value="${description?description:''}"/>
                                        
                                    </td>
                                    <td>
                                        <input type="text" name="rates[]" value="${rate}"/>
                                    
                                    </td>
                                    <td>
                                        <input type="text" readonly name="totals[]" value="${total}"/>
                                        
                                    </td>
                                    </tr>`;
                                        $("#workorder_item_table tbody")
                                            .append(html);
                                    }); //details loop

                                }); //data loop
                            }
                        });
                    }
                });
                //ajax
            });

            function num(v) {
                const n = parseFloat(String(v).replace(/,/g, ''));
                return Number.isFinite(n) ? n : 0;
            }
            $(document).on('input', 'input[name="quantities[]"], input[name="rates[]"]', function() {
                const $tr = $(this).closest('tr');
                const qty = num($tr.find('input[name="quantities[]"]').val());
                const rate = num($tr.find('input[name="rates[]"]').val());
                $tr.find('input[name="totals[]"]').val((qty * rate).toFixed(2));
            });
            $("#lstterm").change(function() {
                var term = $(this).val();
                $("#term").val(term);
            });
            $("#add_terms_item").click(function(e) {
                e.preventDefault();

                var terms = $("#term").val();
                if (terms != '') {
                    debugger;
                    html = `<tr>
                    <td>
                        <input type="text" class="form-control" name="terms_serial[]" value="${terms_count++}"/>
                    </td>
                    <td>
                        <input type="text"  class="form-control" name="terms[]" value="${terms}"/>
                       
                    </td>
                    
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove_item">Remove</button>
                    </td>
                    </tr>`;
                    $("#table_terms tbody").append(html);
                    $("#term").val('');
                }
            });

            function norm(v) {
                return (v ?? '').toString().trim().toLowerCase();
            }

            function removeorder(workorder_id) {
                $('#workorder_item_table tbody tr').each(function() {
                    const p = norm($(this).find('input[name="workorders[]"]').val());
                    if ($.inArray(p, workorder_id) == -1)
                        $(this).remove();
                });
            }


            function isAlreadyAdded(workorder_id) {
                const p = norm(workorder_id);

                let found = false;

                $('#workorder_item_table tbody tr').each(function() {
                    const ep = norm($(this).find('input[name="workorders[]"]').val());

                    if (ep === p) {
                        found = true;
                        return false; // break loop
                    }
                });

                return found;
            }

            $(document).on('click', '.remove_item', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed)
                        $(this).closest('tr').remove();
                });
            });
        });
    </script>

    <script src="{{ asset('backend/dist/js/tsims/workorder.js') }}"></script>
@endsection
