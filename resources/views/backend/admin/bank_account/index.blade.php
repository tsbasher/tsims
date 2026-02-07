@extends('backend.admin.layouts.app')
@section('title', 'Bank Accounts')
@section('style')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')

    <section class="content">
        <div class="row">
            <!-- left column -->
            <!-- general form elements -->
            <div class="card card-body bg-gray-light">
                <div class="card-header">
                    <h2 class="card-title ">Bank Accounts</h2>
                    <div class="card-tools">
                        <a href="{{ route('admin.bank_account.create') }}" class="btn btn btn-secondary"><i
                                class="fa fa-plus"></i> Add</a>
                    </div>
                </div>
                <div class="card-body ">

                    <form method="get">
                        <div class="row">
                            <div class="col-md-4">

                                <div class="form-group row">
                                    <label for="bank_id" class="col-sm-2 col-form-label">Bank</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="bank_id" placeholder="Bank"
                                            name="bank_id">
                                            <option value="">Select Bank</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}"
                                                    @if (Request::get('bank_id') == $bank->id) selected @endif>{{ $bank->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="form-group row">
                                    <label for="supplier_id" class="col-sm-2 col-form-label">Supplier</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="supplier_id" placeholder="Supplier"
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
                            </div>
                            <div class="col-md-4">

                                <div class="form-group row">
                                    <label for="customer_id" class="col-sm-4 col-form-label">Customer</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" id="customer_id" placeholder="Customer"
                                            name="customer_id">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    @if (Request::get('customer_id') == $customer->id) selected @endif>{{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-8 offset-md-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="search" class="form-control form-control-lg" name="search_text"
                                            id="search_text" placeholder="Type your keywords here"
                                            value="{{ Request::has('search_text') ? Request::get('search_text') : '' }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-lg btn-default">
                                                <i class="fa fa-search"></i>
                                            </button>
                                            <a href="{{ route('admin.bank_account.index') }}"
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
                        <table class="table table-bordered table-hover table-head-fixed" id="bankAccount-table">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Branch</th>
                                    <th>BIN</th>
                                    <th>TIN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bankAccounts as $bankAccount)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $bankAccount->account_name }}</td>
                                        <td>{{ $bankAccount->account_number }}</td>
                                        <td>{{ $bankAccount->branch }}</td>
                                        <td>{{ $bankAccount->bin }}</td>
                                        <td>{{ $bankAccount->tin }}</td>
                                        
                                        <td>
                                            <a href="{{ route('admin.bank_account.edit', $bankAccount->id) }}"
                                                class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger delete_record"
                                                data-url="{{ route('admin.bank_account.destroy', $bankAccount->id) }}"><i
                                                    class="fas fa-trash"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix" style="background: #00000000">
                    {{ $bankAccounts->links() }}
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

    <script type="text/javascript">
        
        
        var get_category_by_group = "{{ route('common.get_category_by_group', '*') }}";
            var get_sub_category_by_category = "{{ route('common.get_sub_category_by_category', '*') }}";
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



        $('#bankAccount-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>

    <script src="{{ asset('backend/dist/js/tsims/category.js') }}"></script>
    <script src="{{ asset('backend/dist/js/tsims/sub_category.js') }}"></script>
@endsection
