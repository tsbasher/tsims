@extends('backend.admin.layouts.app')
@section('title', 'Bank Account')
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
                    <h3 class="card-title">Edit Bank Account</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.bank_account.update', $bankAccount->id) }}"
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
                                    <label for="account_name">Account Name</label>
                                    <input type="text" required class="form-control" name="account_name" id="account_name"
                                        placeholder="Enter Account Name" value="{{ old('account_name', $bankAccount->account_name) }}">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" required class="form-control" name="account_number"
                                        id="account_number" placeholder="Enter Account Number"
                                        value="{{ old('account_number', $bankAccount->account_number) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_id">Bank</label>
                                    <select name="bank_id" id="bank_id" class="form-control select2" required>
                                        <option value="">Select Bank</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}" data-prefix="{{ $bank->internal_code }}"
                                                @if (old('bank_id', $bankAccount->bank_id) == $bank->id) selected @endif>{{ $bank->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <input type="text" required class="form-control" name="branch" id="branch"
                                        placeholder="Enter Branch Name" value="{{ old('branch', $bankAccount->branch) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="branch_address">Branch Address</label>
                                    <textarea class="form-control" name="branch_address" id="branch_address" placeholder="Enter Branch Address">{{ old('branch_address', $bankAccount->branch_address) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bin">BIN</label>
                                    <input type="text" class="form-control" name="bin"
                                        id="bin" placeholder="Enter BIN"
                                        value="{{ old('bin', $bankAccount->bin) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tin">TIN</label>
                                    <input type="text" class="form-control" name="tin"
                                        id="tin" placeholder="Enter TIN"
                                        value="{{ old('tin', $bankAccount->tin) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="routing_number">Routing Number</label>
                                    <input type="text" class="form-control" name="routing_number"
                                        id="routing_number" placeholder="Enter Routing Number"
                                        value="{{ old('routing_number', $bankAccount->routing_number) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="swiftcode">Swift Code</label>
                                    <input type="text"  class="form-control" name="swiftcode" id="swiftcode"
                                        placeholder="Enter Swift Code" value="{{ old('swiftcode', $bankAccount->swiftcode) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Bank For:</label>
                                    <div>
                                        <input type="radio" id="own" name="account_for" value="own" class="account_for"
                                            {{ old('account_for', $bankAccount->account_for) == 'own' ? 'checked' : '' }}>
                                        <label for="own">Own</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="customer" name="account_for" value="customer" class="account_for"
                                            {{ old('account_for', $bankAccount->account_for) == 'customer' ? 'checked' : '' }}>
                                        <label for="customer">Customer</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="supplier" name="account_for" value="supplier" class="account_for"
                                            {{ old('account_for', $bankAccount->account_for) == 'supplier' ? 'checked' : '' }}>
                                        <label for="supplier">Supplier</label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">

                            <div class="col-md-6" id="supplier_div">
                                <div class="form-group">
                                    <label for="supplier_id">Supplier</label>
                                    <select name="supplier_id" id="supplier_id" class="form-control select2">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                data-prefix="{{ $supplier->internal_code }}"
                                                @if (old('supplier_id', $bankAccount->supplier_id) == $supplier->id) selected @endif>{{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="customer_div">
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-control select2">
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                data-prefix="{{ $customer->internal_code }}"
                                                @if (old('customer_id', $bankAccount->customer_id) == $customer->id) selected @endif>{{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
    <script type="text/javascript">
        $(document).ready(function() {

            $(".account_for").change(function() {
                var accountFor = $(this).val();
                if (accountFor === 'supplier') {
                    $('#supplier_div').show();
                    $('#customer_div').hide();
                } else if (accountFor === 'customer') {
                    $('#customer_div').show();
                    $('#supplier_div').hide();
                } else {
                    $('#supplier_div').hide();
                    $('#customer_div').hide();
                }
            });

            $('.account_for:checked').trigger('change');
            $(".select2").select2();
            debugger;
            $('#branch_address').summernote();
            });
    </script>

    <script src="{{ asset('backend/dist/js/tsims/category.js') }}"></script>
    <script src="{{ asset('backend/dist/js/tsims/sub_category.js') }}"></script>

@endsection
