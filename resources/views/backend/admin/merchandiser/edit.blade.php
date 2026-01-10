@extends('backend.admin.layouts.app')
@section('title', 'Merchandiser')
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
                    <h3 class="card-title">Edit Merchandiser</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.merchandiser.update', $merchandiser->id) }}"
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
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select required class="form-control" name="customer_id" id="customer_id">
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" @if (old('customer_id', $merchandiser->customer_id) == $customer->id) selected @endif>{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="name">Merchandiser Name</label>
                                    <input type="text" required class="form-control" name="name" id="name"
                                        placeholder="Enter Merchandiser Name" value="{{ old('name', $merchandiser->name) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Merchandiser Email</label>
                                    <input type="email" required class="form-control" name="email" id="email"
                                        placeholder="Enter Merchandiser Email" value="{{ old('email', $merchandiser->email) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Merchandiser Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        placeholder="Enter Phone" value="{{ old('phone', $merchandiser->phone) }}" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                @if (old('is_active', $merchandiser->is_active) == 1) checked @endif>
                            <label class="form-check-label" for="is_active">Is Active</label>
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
            
    $(".select2").select2();
            debugger;
            $('#description').summernote();
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
@endsection
