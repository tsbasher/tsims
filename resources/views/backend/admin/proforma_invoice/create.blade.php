@extends('backend.admin.layouts.app')
@section('title', 'Proforma Invoice')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')

    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="card card-body bg-gray-light">
                <div class="card-header">
                    <h3 class="card-title">Add New Proforma Invoice</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.proforma_invoice.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="pi_number">Proforma Invoice Number</label>
                                    <input type="text" required readonly class="form-control" name="pi_number"
                                        id="pi_number" placeholder="Enter Proforma Invoice Number"
                                        value="{{ old('pi_number', $order_number) }}">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="refference_number">Reference Number</label>
                                    <input type="text" class="form-control" name="refference_number"
                                        id="refference_number" placeholder="Enter Reference Number"
                                        value="{{ old('refference_number') }}">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="pi_date">PI Date</label>
                                    <input type="text" required class="form-control datepicker" name="pi_date"
                                        id="pi_date" placeholder="Enter Proforma Invoice Date"
                                        value="{{ old('pi_date', date('Y-m-d')) }}">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="pi_expire_date">PI Exprire Date</label>
                                    <input type="text" class="form-control datepicker" name="pi_expire_date"
                                        id="pi_expire_date" placeholder="Enter Expire date"
                                        value="{{ old('pi_expire_date', date('Y-m-d', strtotime(date('Y-m-d') . ' +15 days'))) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="buyer_id">Buyer</label>
                                    <select class="form-control" name="buyer_id" id="buyer_id">
                                        <option value="">Select Customer</option>
                                        @foreach ($buyers as $buyer)
                                            <option value="{{ $buyer->id }}"
                                                {{ old('buyer_id') == $buyer->id ? 'selected' : '' }}>
                                                {{ $buyer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select class="form-control" name="customer_id" id="customer_id">
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="workorder_id">Work Order</label>
                                    <select class="form-control select2" name="workorder_ids[]" id="workorder_id" multiple>
                                        <option value="">Select Workorder</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description/Note</label>
                                    <input type="text" class="form-control" name="description" id="description"
                                        value="{{ old('description') }}" />

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <hr />
                        </div>



                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="sub_total">&nbsp;</label>
                                    <button type="button" id="add_more_item" class="btn btn-info form-control">Add
                                        Product</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <hr>
                        </div>


                        <div class="row">
                            <table class="table table-bordered" id="workorder_item_table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>WorkOrder</th>
                                        <th>Product</th>
                                        <th>Style</th>
                                        <th>Color</th>
                                        <th>Unit</th>
                                        <th>Measurement</th>
                                        <th>Quantity</th>
                                        <th>Note</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>


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
            $("#workorder_id").change(function() {
                debugger;
                var workorder_ids = $(this).val();
                $.ajax({
                    url: "{{ route('admin.get_workorder', ['workorder_id' => '*']) }}".replace('*',
                        workorder_ids),
                    type: 'GET',
                    success: function(data) {
                        debugger;

                        $("#workorder_item_table").find("tbody").empty();
                        var index = 1;
                        $.each(data, function(key, value) {

                            $.each(value.details, function(dkey, dvalue) {
                                debugger;
                                var product_id = dvalue.product_id;
                                var product_text = dvalue.product.name;
                                var style_id = dvalue.style_id;
                                var style_text = dvalue.style.name;
                                var color_id = dvalue.color_id;
                                var color_text = dvalue.color.name;
                                var unit_id = dvalue.quantity_unit_id;
                                var unit_text = dvalue.quantity_unit.name;
                                var measurement = dvalue.measurement;
                                var quantity = dvalue.quantity;
                                var rate = dvalue.unit_price;
                                var total = dvalue.total_price;
                                var description = dvalue.description;
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
                                $("#workorder_item_table tbody").append(html);
                            }); //details loop

                        }); //data loop
                    }
                }); //ajax
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
            $("#add_more_item").click(function(e) {
                e.preventDefault();
                var product_id = $("#product_id").val();
                var product_text = $("#product_id option:selected").text();
                var style_id = $("#style_id").val();
                var style_text = $("#style_id option:selected").text();
                var color_id = $("#color_id").val();
                var color_text = $("#color_id option:selected").text();
                var unit_id = $("#unit_id").val();
                var unit_text = $("#unit_id option:selected").text();
                var measurement = $("#measurement").val();
                var quantity = $("#quantity").val();
                var rate = $("#rate").val();
                var total = $("#sub_total").val();
                var description = $("#d_description").val();
                debugger;
                if (isAlreadyAdded(product_id, style_id, color_id, measurement)) {
                    Swal.fire({
                        title: 'ERROR',
                        text: "Product with the same Style, Color, and Measurement already added!",
                        icon: 'error'
                    });
                    return;
                }
                html = `<tr>
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
                        <input type="hidden" name="quantities[]" value="${quantity}"/>
                        ${quantity}
                    </td>
                    <td>
                        <input type="hidden" name="details_description[]" value="${description}"/>
                        ${description}
                    </td>
                    <td>
                        <input type="hidden" name="rates[]" value="${rate}"/>
                        ${rate}
                    </td>
                    <td>
                        <input type="hidden" name="totals[]" value="${total}"/>
                        ${total}
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove_item">Remove</button>
                    </td>
                    </tr>`;
                $("#workorder_item_table tbody").append(html);
                $("#quantity").val('');
                $("#rate").val('');
                $("#sub_total").val('');
            });

            function norm(v) {
                return (v ?? '').toString().trim().toLowerCase();
            }

            function isAlreadyAdded(product_id, style_id, color_id, measurement) {
                const p = norm(product_id);
                const s = norm(style_id);
                const c = norm(color_id);
                const m = norm(measurement); // or normMeasure(measurement)

                let found = false;

                $('#workorder_item_table tbody tr').each(function() {
                    const ep = norm($(this).find('input[name="product_ids[]"]').val());
                    const es = norm($(this).find('input[name="style_ids[]"]').val());
                    const ec = norm($(this).find('input[name="color_ids[]"]').val());
                    const em = norm($(this).find('input[name="measurements[]"]')
                        .val()); // or normMeasure(...)

                    if (ep === p && es === s && ec === c && em === m) {
                        found = true;
                        return false; // break loop
                    }
                });

                return found;
            }

            // $(document).on('click', '.remove_item', function() {
            //     Swal.fire({
            //         title: 'Are you sure?',
            //         text: "You won't be able to revert this!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonText: 'Yes, delete it!',
            //         cancelButtonText: 'No, cancel!',
            //         reverseButtons: true
            //     }).then((result) => {
            //         if (result.isConfirmed)
            //             $(this).closest('tr').remove();
            //     });
            // });
        });
    </script>

    <script src="{{ asset('backend/dist/js/tsims/workorder.js') }}"></script>
@endsection
