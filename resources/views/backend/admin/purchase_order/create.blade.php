@extends('backend.admin.layouts.app')
@section('title', 'Purchase Order')
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
                    <h3 class="card-title">Add New Purchase Order</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.purchase_order.store') }}" enctype="multipart/form-data">
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
                                    <label for="po_number">Purchase Order Number</label>
                                    <input type="text" required readonly class="form-control" name="po_number" id="po_number" placeholder="Enter Purchase Order Number" value="{{ old('po_number', $order_number) }}">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="refference_number">Reference Number</label>
                                    <input type="text" class="form-control" name="refference_number" id="refference_number" placeholder="Enter Reference Number" value="{{ old('refference_number') }}">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="po_date">PO Date</label>
                                    <input type="text" required class="form-control datepicker" name="po_date" id="po_date" placeholder="Enter Purchase Order Date" value="{{ old('po_date', date('Y-m-d')) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="currency_id">Currency</label>
                                    <select class="form-control select2" name="currency_id" id="currency_id">
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}" data-symbol="{{ $currency->symbol }}" {{ old('currency_id') == $currency->id ? 'selected' : '' }}>
                                                {{ $currency->name }}({{ $currency->symbol }})</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="supplier_id">Supplier</label>
                                    <select class="form-control" name="supplier_id" id="supplier_id">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select class="form-control" name="customer_id" id="customer_id">
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="workorder_id">Work Order</label>
                                    <select class="form-control select2" name="workorder_ids" id="workorder_id">
                                        <option value="">Select Workorder</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="workorder_id">Payment Terms</label>
                                    <select class="form-control select2" name="payments_terms_id" id="payments_terms_id">
                                        <option value="">Select Payment Terms</option>
                                        @foreach ($payments_terms as $payment_term)
                                            <option value="{{ $payment_term->id }}" {{ old('payments_terms_id') == $payment_term->id ? 'selected' : '' }}>
                                                {{ $payment_term->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description/Note</label>
                                    <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}" />

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <hr />
                        </div>




                        <div class="row">
                            <hr>
                        </div>


                        <div class="row">
                            <table class="table table-bordered" id="workorder_item_table">
                                <thead>
                                    <tr>
                                        <th>WorkOrder</th>
                                        <th>Product</th>
                                        <th>Style</th>
                                        <th>Color</th>
                                        <th>Measurement</th>
                                        <th>Weight Per Unit</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="terms">Terms & Conditions</label>
                                    <select class="form-control select2" name="lstterm" id="lstterm">
                                        <option value="">Select Terms</option>
                                        @foreach ($terms as $term)
                                            <option value="{{ $term->description }}">
                                                {{ $term->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="sub_total">Terms</label>
                                    <input type="text" name="term" id="term" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="sub_total">&nbsp;</label>
                                    <button type="button" id="add_terms_item" class="btn btn-info form-control">Add
                                        Terms</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="table_terms">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Terms & Condition</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
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
        var get_workorder_by_customer = "{{ route('common.get_workorder_by_customer_for_po', ['customer_id' => '*']) }}";

        $(document).ready(function() {
            $(".select2").select2();

            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });
            var terms_count = 1;
            $("#workorder_id").change(function(e) {

                var workorder_ids = $(this).val();
                if (workorder_ids.length == 0) {
                    $("#workorder_item_table").find("tbody").empty();
                    return;
                }
                        $.ajax({
                            url: "{{ route('admin.get_workorder_for_po', ['workorder_id' => '*']) }}"
                                .replace('*',
                                    workorder_ids),
                            type: 'GET',
                            success: function(data) {

                                html = `<table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>WorkOrder</th>
                                        <th>Product</th>
                                        <th>Style</th>
                                        <th>Color</th>
                                        <th>Measurement</th>
                                        <th>Weight Per Unit</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                `;

                                $.each(data.details, function(dkey, dvalue) {

                                    var product_text = dvalue.product.name;
                                    var style_text = dvalue.style.name;
                                    var color_text = dvalue.color.name;
                                    var unit_text = dvalue.quantity_unit.name;
                                    var measurement = dvalue.measurement;
                                    var quantity = dvalue.quantity;
                                    var weight = dvalue.weight ? dvalue.weight : '';
                                    var weight_unit_text = dvalue.weight_unit != null ? dvalue.weight_unit.name : '';
                                    var rate = dvalue.unit_price;
                                    var total = dvalue.total_price;
                                    var description = dvalue.description;
                                    var currency_symbol = $('#currency_id').find('option:selected').data('symbol') || '';

                                    html += `<tr>
                                <td>
                                    <input type="checkbox" name="workorders[]" class="swal2-wo" value="${dvalue.id}"/>
                                </td>
                                <td>${data.order_number}</td>
                                <td>
                                    ${product_text}
                                </td>
                                <td>
                                    ${style_text}
                                </td>
                                <td>
                                    ${color_text}
                                </td>
                                <td>
                                    ${measurement}
                                </td>
                                <td>${weight} ${weight_unit_text}</td>
                                <td>${quantity} ${unit_text}</td>
                                <td>${currency_symbol} ${rate}</td>
                                <td>${currency_symbol} ${total}</td>
                                <td>${description?description:''}</td>
                                </tr>`;
                                }); //details loop
                                html += `</tbody></table>`;
                                debugger;
                                Swal.fire({
                                    title: 'Select your options',
                                    width: '90%',
                                    html: html,
                                    focusConfirm: false, // Prevents the first focusable element (usually the input) from being focused automatically
                                    preConfirm: () => {
                                        var checkedValues = [];
                                        $("input.swal2-wo:checked").each(function() {

                                            debugger;
                                            checkedValues.push($(this).val());
                                        });

                                        // Access the elements by their IDs and return their checked status
                                        return checkedValues;
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {

                                        var wo_details_ids = result.value;

                                        $.ajax({
                                            url: "{{ route('admin.get_workorder_details_by_id', ['workorder_details_id' => '*']) }}".replace('*', wo_details_ids),
                                            type: 'GET',
                                            success: function(details) {
                                                
                    $("#workorder_item_table").find("tbody").empty();
                                                $.each(details, function(dkey, dvalue) {
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
                                                    var weight = dvalue.weight ? dvalue.weight : '';
                                                    var weight_unit_id = dvalue.weight_unit_id != null ? dvalue.weight_unit_id : '';
                                                    var weight_unit_text = dvalue.weight_unit != null ? dvalue.weight_unit.name : '';
                                                    var rate = dvalue.unit_price;
                                                    var total = dvalue.total_price;
                                                    var description = dvalue.description;
                                                    var currency_symbol = $('#currency_id').find('option:selected').data('symbol') || '';

                                                    html = `<tr>
                                <td>
                                    <input type="hidden" name="workorders[]" value="${dvalue.id}"/>
                                    ${dvalue.work_order.order_number}
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
                                    <input type="hidden" name="measurements[]" value="${measurement}"/>
                                    ${measurement}
                                </td>
                                <td>

                                            <div class="input-group mb-3">

                                                <input type="text" name="weights[]" class="form-control"
                                                    value="${weight}" />
                                                <input type="hidden" name="weight_unit_ids[]"
                                                    value="${weight_unit_id}" />
                                                <div class="input-group-append">
                                                    <span
                                                        class="input-group-text">${weight_unit_text}</span>
                                                </div>
                                            </div>

                                </td>
                                <td>

                                            <div class="input-group mb-3">

                                                <input type="text" name="quantities[]" class="form-control"
                                                    value="${quantity}" />
                                                <input type="hidden" name="unit_ids[]"
                                                    value="${unit_id}" />
                                                <div class="input-group-append">
                                                    <span
                                                        class="input-group-text">${unit_text}</span>
                                                </div>
                                            </div>

                                </td>
                                <td>

                                            <div class="input-group mb-3">

                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">${currency_symbol}</span>
                                                </div>
                                                <input type="text" name="rates[]" class="form-control"
                                                    value="${rate}" />
                                            </div>

                                </td>
                                <td>
                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">${currency_symbol}</span>
                                        </div>
                                    <input type="text" readonly name="totals[]" value="${total}" class="form-control"/>

                                </td>
                                <td>
                                    <input type="text" name="details_description[]"  class="form-control" value="${description?description:''}"/>

                                </td>
                                </tr>`;
                                $("#workorder_item_table tbody").append(html);
                                                }); //details loop
                                            }
                                        });

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
