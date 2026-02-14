@extends('backend.admin.layouts.app')
@section('title', 'Purchase Order Receive')
@section('style')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')

    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- general form elements -->
            <div class="card card-body bg-gray-light">
                <div class="card-header">
                    <h2 class="card-title ">Purchase Order Receive</h2>
                    <div class="card-tools">
                        <a href="{{ route('admin.purchase_order_receive.create') }}" class="btn btn btn-secondary"><i
                                class="fa fa-plus"></i> Add</a>
                    </div>
                </div>
                <div class="card-body ">

                    <form method="get">
                        <div class="row">
                            
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="supplier_id" class="col-form-label">Supplier</label>
                                    
                                        <select class="form-control select2" id="supplier_id" placeholder="Group"
                                            name="supplier_id">
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}"
                                                    @if (Request::get('supplier_id') == $supplier->id) selected @endif>{{ $supplier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="purchase_order_id" class="col-form-label">Purchase Order</label>
                                    
                                        <select class="form-control select2" id="purchase_order_id" placeholder="Group"
                                            name="purchase_order_id">
                                            <option value="">Select Purchase Order</option>
                                            @foreach ($pos as $po)
                                                <option value="{{ $po->id }}"
                                                    @if (Request::get('purchase_order_id') == $po->id) selected @endif>{{ $po->po_number }}
                                                </option>
                                                
                                            @endforeach
                                        </select>
                                    
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group ">
                                    <label for="order_date_from" class="col-form-label">From Date</label>
                                    
                                        <input type="text" class="form-control datepicker" name="order_date_from"
                                            id="order_date_from"
                                            value="{{ Request::has('order_date_from') ? Request::get('order_date_from') : '' }}">
                                    
                                </div>
                            </div>

                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="order_date_to" class="col-form-label">To Date</label>
                                    
                                        <input type="text" class="form-control datepicker" name="order_date_to"
                                            id="order_date_to"
                                            value="{{ Request::has('order_date_to') ? Request::get('order_date_to') : '' }}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-8 offset-md-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="search" class="form-control form-control-lg" name="order_number"
                                            id="order_number" placeholder="Type your Order Number"
                                            value="{{ Request::has('order_number') ? Request::get('order_number') : '' }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-lg btn-default">
                                                <i class="fa fa-search"></i>
                                            </button>
                                            <a href="{{ route('admin.purchase_order_receive.index') }}"
                                                class="btn btn-lg btn-default">
                                                <i class="fas fa-sync-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible">{{ $message }}</div>
                            @endif
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible">{{ $message }}</div>
                            @endif

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover " id="category-table">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Receive Number</th>
                                    <th>Purchase Order Number</th>
                                    <th>Work Order Number</th>
                                    <th>Supplier</th>
                                    <th>Received Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pors as $por)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $por->receive_number }}</td>
                                        <td>{{ $por->purchase_order->po_number }}</td>
                                        <td>{{ $por->work_order?$por->work_order->order_number:"N/A" }}</td>
                                        <td>{{ $por->supplier->name }}</td>
                                        <td>{{ date('d F Y',strtotime($por->received_date)) }}</td>
                                        
                                        <td>
                                            <a href="{{ route('admin.purchase_order_receive.edit', $por->id) }}"
                                                class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger delete_record"
                                                data-url="{{ route('admin.purchase_order_receive.destroy', $por->id) }}"><i
                                                    class="fas fa-trash"></i></a>
                                            <a class="btn btn-sm btn-primary pl-2 pr-2"
                                                href="{{ route('admin.purchase_order_receive.show', $por->id) }}"><i
                                                    class="fas fa-info"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix" style="background: #00000000">
                    {{ $pors->links() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>


@endsection

@section('script')
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>

    {{-- <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- DataTables  & Plugins -->
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script type="text/javascript">

    
        var get_purchase_order_by_supplier =
            "{{ route('common.get_all_purchase_order_by_supplier', ['supplier_id' => '*']) }}";
    $(".select2").select2();
        $(".delete_record").click(function() {
            var url = $(this).data('url');

            debugger;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    var token = "{{ csrf_token() }}";

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            "_token": token,
                        },
                        success: function(data) {
                            debugger;
                            // var data = JSON.parse(response);
                            if (data.status == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    text: data.message,
                                    icon: 'success'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            } else {

                                Swal.fire({
                                    timer: 1500,
                                    title: 'ERROR',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(ex) {

                            debugger;
                            Swal.fire({
                                timer: 1500,
                                title: 'ERROR',
                                text: 'Something Went Wrong',
                                icon: 'error'
                            });
                        }
                    });
                }
                // else if (result.dismiss === Swal.DismissReason.cancel) {
                //     Swal.fire({
                //         timer: 1500,
                //         title: 'Cancelled',
                //         text: 'Your Record is safe',
                //         icon: 'error'
                //     });
                // }
            });
        });

$('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });

        $('#category-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>

    
    <script src="{{ asset('backend/dist/js/tsims/purchase_order_receive.js') }}"></script>
@endsection
