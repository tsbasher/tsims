@extends('backend.admin.layouts.app')
@section('title', 'Purchase Order Receive')
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
                    <h3 class="card-title">Add New Purchase Order Receive</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.purchase_order_receive.store') }}" enctype="multipart/form-data">
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
                                    <label for="receive_number">Purchase Order Receive Number</label>
                                    <input type="text" required readonly class="form-control" name="receive_number" id="receive_number" placeholder="Enter Purchase Order Receive Number" value="{{ old('receive_number', $order_number) }}">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="received_date">Receive Date</label>
                                    <input type="text" required class="form-control datepicker" name="received_date" id="received_date" placeholder="Enter Purchase Order Receive Date" value="{{ old('received_date', date('Y-m-d')) }}">
                                </div>
                            </div>
                        </div>



                        <div class="row">

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
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="purchase_order_id">Purchase Order</label>
                                    <select class="form-control select2" name="purchase_order_id" id="purchase_order_id">
                                        <option value="">Select Purchase Order</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">

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
                                        <th>Work Order</th>
                                        <th>Purchase Order</th>
                                        <th>Product</th>
                                        <th>Style</th>
                                        <th>Color</th>
                                        <th>Measurement</th>
                                        <th>Order Quantity</th>
                                        <th>Previously Received Quantity</th>
                                        <th>Receive Quantity</th>
                                        <th>Due/Excess</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" name="work_order_id" id="work_order_id" value="" />
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
        var get_purchase_order_by_supplier =
            "{{ route('common.get_purchase_order_by_supplier', ['supplier_id' => '*']) }}";

        $(document).ready(function() {
            $(".select2").select2();
            debugger;
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });
            var terms_count = 1;
            $("#purchase_order_id").change(function(e) {
                debugger;
                var purchase_order_id = $(this).val();
                $("#workorder_item_table").find("tbody").empty();

                $.ajax({
                    url: "{{ route('admin.get_purchase_order', ['id' => '*']) }}"
                        .replace('*',
                            purchase_order_id),
                    type: 'GET',
                    success: function(data) {
                        debugger;
                        $("#work_order_id").val(data.work_order_id);
                        var index = 1;
                        debugger;
                        $.each(data.details, function(dkey, dvalue) {
                            debugger;
                            var product_text = dvalue.work_order_details.product.name;
                            var style_text = dvalue.work_order_details.style.name;
                            var color_text = dvalue.work_order_details.color.name;
                            var unit_text = dvalue.work_order_details.quantity_unit.name;
                            var measurement = dvalue.work_order_details.measurement;
                            var quantity = dvalue.quantity;
                            var pre_quantity = 0;
                            if (dvalue.receive_details && dvalue.receive_details.length > 0) {
                                pre_quantity = dvalue.receive_details.reduce((sum, receive) => sum + receive.quantity_received, 0);
                            }
                            var description = dvalue.description;
                            var currency_symbol = data.currency.symbol;

                            html = `<tr>
                                            <td>${data.work_order.order_number}</td>
                                    <td>
                                        <input type="hidden" name="purchase_order_details[]" value="${dvalue.id}"/>
                                        <input type="hidden" name="work_order_detail_ids[]" value="${dvalue.work_order_details.id}"/>
                                        ${data.po_number}
                                    </td>
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
                                    <td>
                                        
                                                <div class="input-group mb-3">

                                                    <input type="text" name="quantities[]" readonly class="form-control"
                                                        value="${quantity}" />
                                                    <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">${unit_text}</span>
                                                    </div>
                                                </div>
                                        
                                    </td>
                                    <td>
                                        
                                                <div class="input-group mb-3">

                                                    <input type="text" name="pre_quantities[]" readonly class="form-control"
                                                        value="${pre_quantity}" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">${unit_text}</span>
                                                    </div>
                                                </div>
                                        </td>
                                    <td>
                                        
                                                <div class="input-group mb-3">

                                                    <input type="text" name="received_quantities[]" class="form-control"
                                                        value="0" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">${unit_text}</span>
                                                    </div>
                                                </div>
                                        </td>
                                        
                                    <td>
                                        
                                                <div class="input-group mb-3">

                                                    <input type="text" name="due[]" readonly class="form-control ${(quantity-pre_quantity)<0?'bg-danger':''}"
                                                        value="${quantity-pre_quantity}" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">${unit_text}</span>
                                                    </div>
                                                </div>
                                        </td>
                                    
                                    </tr>`;
                            $("#workorder_item_table tbody")
                                .append(html);
                        }); //details loop

                    }
                });

                //ajax
            });

            $(document).on('input', 'input[name="received_quantities[]"]', function() {
                const $tr = $(this).closest('tr');
                var order_quantity = num($tr.find('input[name="quantities[]"]').val());
                var pre_quantity = num($tr.find('input[name="pre_quantities[]"]').val());
                var received_quantity = num($tr.find('input[name="received_quantities[]"]').val());
                var due = order_quantity - pre_quantity - received_quantity;
                $tr.find('input[name="due[]"]').val(due);

                if(due < 0){
                    $tr.find('input[name="due[]"]').addClass('bg-danger');
                } else {
                    $tr.find('input[name="due[]"]').removeClass('bg-danger');
                }
            });

            

            function num(v) {
                const n = parseFloat(String(v).replace(/,/g, ''));
                return Number.isFinite(n) ? n : 0;
            }


        });
    </script>

    <script src="{{ asset('backend/dist/js/tsims/purchase_order_receive.js') }}"></script>
@endsection
