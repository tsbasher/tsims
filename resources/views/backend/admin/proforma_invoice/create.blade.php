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
                                        <option value="">Select Buyer</option>
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
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="workorder_id">Work Order</label>
                                    <select class="form-control select2" name="workorder_ids[]" id="workorder_id" multiple>
                                        <option value="">Select Workorder</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="workorder_id">Payment Terms</label>
                                    <select class="form-control select2" name="payments_terms_id" id="payments_terms_id">
                                        <option value="">Select Payment Terms</option>
                                        @foreach ($payments_terms as $payment_term)
                                            <option value="{{ $payment_term->id }}"
                                                {{ old('payments_terms_id') == $payment_term->id ? 'selected' : '' }}>
                                                {{ $payment_term->name }}</option>
                                        @endforeach

                                    </select>
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
                                    <input type="text" name="term" id="term" class="form-control"
                                        value="">
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
                                    debugger;
                                    $.each(value.details, function(dkey,dvalue) {
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
                                        var weight = dvalue.weight?dvalue.weight:'';
                                        var weight_unit_id = dvalue.weight_unit_id;
                                        var weight_unit_text = dvalue.weight_unit!=null?dvalue.weight_unit.name:'';
                                        var rate = dvalue.unit_price;
                                        var total = dvalue.total_price;
                                        var description = dvalue.description;
                                        var currency_symbol =$('#currency_id').find('option:selected').data('symbol') ||'';

                                        html = `<tr>
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
