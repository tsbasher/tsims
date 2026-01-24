@extends('backend.admin.layouts.app')
@section('title', 'WorkOrder')
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
                    <h3 class="card-title">Add New WorkOrder</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.workorder.update', $workorder->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                    <label for="order_number">WorkOrder Number</label>
                                    <input type="text" required readonly class="form-control" name="order_number"
                                        id="order_number" placeholder="Enter WorkOrder Number"
                                        value="{{ old('order_number', $workorder->order_number) }}">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="refference_number">Reference Number</label>
                                    <input type="text" class="form-control" name="refference_number"
                                        id="refference_number" placeholder="Enter Reference Number"
                                        value="{{ old('refference_number', $workorder->refference_number) }}">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="order_date">WorkOrder Date</label>
                                    <input type="text" required class="form-control datepicker" name="order_date"
                                        id="order_date" placeholder="Enter WorkOrder Date"
                                        value="{{ old('order_date', $workorder->order_date) }}">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="delivery_date">Delivery Date</label>
                                    <input type="text" class="form-control datepicker" name="delivery_date"
                                        id="delivery_date" placeholder="Enter delivery date"
                                        value="{{ old('delivery_date', $workorder->delivery_date) }}">
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
                                            <option value="{{ $customer->id }}"
                                                {{ old('customer_id', $workorder->customer_id) == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="merchandiser_id">Merchandiser</label>
                                    <select class="form-control" required name="merchandiser_id" id="merchandiser_id">
                                        @foreach ($merchandisers as $merchandiser)
                                            <option value="{{ $merchandiser->id }}"
                                                {{ old('merchandiser_id', $workorder->merchandiser_id) == $merchandiser->id ? 'selected' : '' }}>
                                                {{ $merchandiser->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description/Note</label>
                                    <input type="text" class="form-control" name="description" id="description"
                                        value="{{ old('description', $workorder->description) }}" />

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr />
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="product_id">Product</label>
                                    <select class="form-control select2" name="product_id" id="product_id">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->code }}-{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="style_id">Style</label>
                                    <select class="form-control select2" name="style_id" id="style_id">
                                        <option value="">Select Style</option>
                                        @foreach ($styles as $style)
                                            <option value="{{ $style->id }}">
                                                {{ $style->code }}-{{ $style->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="color_id">Color</label>
                                    <select class="form-control select2" name="color_id" id="color_id">
                                        <option value="">Select Color</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">
                                                {{ $color->code }}-{{ $color->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="measurement">Measurement</label>
                                    <input type="text" step="0.01" class="form-control" name="measurement"
                                        id="measurement" placeholder="Enter measurement"
                                        value="{{ old('measurement') }}">
                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" step="1" class="form-control" name="quantity"
                                        id="quantity" placeholder="Enter Quantity" value="{{ old('quantity') }}">
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="unit_id">Quantity Unit</label>
                                    <select class="form-control select2" name="unit_id" id="unit_id">
                                        <option value="">Select Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">
                                                {{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="weight">Weight Per Unit</label>
                                    <input type="number" step=".01" class="form-control" name="weight"
                                        id="weight" placeholder="Enter weight" value="{{ old('weight') }}">
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="weight_unit_id">Weight Unit</label>
                                    <select class="form-control select2" name="weight_unit_id" id="weight_unit_id">
                                        <option value="">Select Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">
                                                {{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="rate">Rate</label>
                                    <input type="number" step="0.01" class="form-control" name="rate"
                                        id="rate" placeholder="Enter rate" value="{{ old('rate') }}">
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="sub_total">Total</label>
                                    <input type="number" readonly step="0.01" class="form-control" name="sub_total"
                                        id="sub_total" value="{{ old('sub_total') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="d_description">Description</label>
                                    <input type="text"class="form-control" name="d_description" id="d_description"
                                        value="{{ old('d_description') }}">
                                </div>
                            </div>

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
                                        <th>Product</th>
                                        <th>Style</th>
                                        <th>Color</th>
                                        <th>Measurement</th>
                                        <th>Quantity</th>
                                        <th>Weight per Unit</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workorder->details as $details)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="product_ids[]"
                                                    value="{{ $details->product_id }}" />
                                                {{ $details->product->code }}-{{ $details->product->name }}
                                            </td>
                                            <td>
                                                <input type="hidden" name="style_ids[]"
                                                    value="{{ $details->style_id }}" />
                                                {{ $details->style->code }}-{{ $details->style->name }}
                                            </td>
                                            <td>
                                                <input type="hidden" name="color_ids[]"
                                                    value="{{ $details->color_id }}" />
                                                {{ $details->color->code }}-{{ $details->color->name }}
                                            </td>
                                            <td>
                                                <input type="hidden" name="measurements[]"
                                                    value="{{ $details->measurement }}" />
                                                {{ $details->measurement }}
                                            </td>
                                            <td>
                                                <input type="hidden" name="quantities[]"
                                                    value="{{ $details->quantity }}" />
                                                <input type="hidden" name="unit_ids[]"
                                                    value="{{ $details->quantity_unit_id }}" />
                                                {{ $details->quantity }} {{ $details->quantity_unit->name }}
                                            </td>
                                            <td>
                                                
                                                <input type="hidden" name="weights[]"
                                                    value="{{ $details->weight }}" />
                                                <input type="hidden" name="weight_unit_ids[]"
                                                    value="{{ $details->weight_unit_id }}" />
                                                {{ $details->weight }} {{ $details->weight_unit?$details->weight_unit->name:'' }}
                                            </td>
                                            <td>
                                                <input type="hidden" name="rates[]"
                                                    value="{{ $details->unit_price }}" />
                                                {{ $details->unit_price }}
                                            </td>
                                            <td>
                                                <input type="hidden" name="totals[]"
                                                    value="{{ $details->total_price }}" />
                                                {{ $details->total_price }}
                                            </td>
                                            <td>
                                                <input type="hidden" name="details_description[]"
                                                    value="{{ $details->description }}" />
                                                {{ $details->description }}
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm remove_item">Remove</button>
                        <button type="button" class="btn btn-warning btn-sm edit_item">Edit</button>
                                            </td>

                                        </tr>
                                    @endforeach
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
        var get_merchandiser_by_customer =
            "{{ route('common.get_merchandiser_by_customer', ['customer_id' => '*']) }}";
        var get_style_by_customer =
            "{{ route('common.get_style_by_customer', ['customer_id' => '*']) }}";
        $(document).ready(function() {
            $(".select2").select2();
            $("#customer_id").change();
            debugger;
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });

            $("#quantity").on('keyup', function() {
                var quantity = parseFloat($(this).val()) || 0;
                var rate = parseFloat($("#rate").val()) || 0;
                var total = quantity * rate;
                $("#sub_total").val(total.toFixed(2));
            });


            $("#rate").on('keyup', function() {
                var rate = parseFloat($(this).val()) || 0;
                var quantity = parseFloat($("#quantity").val()) || 0;
                var total = quantity * rate;
                $("#sub_total").val(total.toFixed(2));
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
                var weight_unit_id = $("#weight_unit_id").val();
                var weight_unit_text = $("#weight_unit_id option:selected").text();
                var weight = $("#weight").val();

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
                        <input type="hidden" name="measurements[]" value="${measurement}"/>
                        ${measurement}
                    </td>
                    
                    <td>
                        <input type="hidden" name="quantities[]" value="${quantity}"/>
                        <input type="hidden" name="unit_ids[]" value="${unit_id}"/>
                        ${quantity}  ${unit_text}
                    </td>
                    
                    <td>
                        <input type="hidden" name="weights[]" value="${weight}"/>
                        <input type="hidden" name="weight_unit_ids[]" value="${weight_unit_id}"/>
                        ${weight}  ${weight_unit_text}
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
                        <input type="hidden" name="details_description[]" value="${description}"/>
                        ${description}
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove_item">Remove</button>
                        <button type="button" class="btn btn-warning btn-sm edit_item">Edit</button>
                    </td>
                    </tr>`;
                $("#workorder_item_table tbody").append(html);
                $("#quantity").val('');
                $("#rate").val('');
                $("#sub_total").val('');
            });

            
            $(document).on('click', '.edit_item', function() {
                var product_id=$(this).closest('tr').find('input[name="product_ids[]"]').val();
                $("#product_id").val(product_id).trigger('change');
                var style_id=$(this).closest('tr').find('input[name="style_ids[]"]').val();
                $("#style_id").val(style_id).trigger('change');
                var color_id=$(this).closest('tr').find('input[name="color_ids[]"]').val();
                $("#color_id").val(color_id).trigger('change');
                var measurement=$(this).closest('tr').find('input[name="measurements[]"]').val();
                $("#measurement").val(measurement);
                var quantity=$(this).closest('tr').find('input[name="quantities[]"]').val();
                $("#quantity").val(quantity);
                var unit_id=$(this).closest('tr').find('input[name="unit_ids[]"]').val();
                $("#unit_id").val(unit_id).trigger('change');
                var weight=$(this).closest('tr').find('input[name="weights[]"]').val();
                $("#weight").val(weight);
                var weight_unit_id=$(this).closest('tr').find('input[name="weight_unit_ids[]"]').val();
                $("#weight_unit_id").val(weight_unit_id).trigger('change');
                var rate=$(this).closest('tr').find('input[name="rates[]"]').val();
                $("#rate").val(rate);
                var total=$(this).closest('tr').find('input[name="totals[]"]').val();
                $("#sub_total").val(total);
                var description=$(this).closest('tr').find('input[name="details_description[]"]').val();
                $("#d_description").val(description);
                $(this).closest('tr').remove();
                debugger;
            });
            // $("#customer_id").val("{{ $workorder->customer_id }}").trigger('change');
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

    <script src="{{ asset('backend/dist/js/tsims/merchantdiser.js') }}"></script>
    <script src="{{ asset('backend/dist/js/tsims/style.js') }}"></script>
@endsection
