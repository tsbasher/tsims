@extends('backend.admin.layouts.app')
@section('title', 'Style')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{asset('backend/plugins/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/jquery-ui/jquery-ui.theme.min.css')}}">
@endsection

@section('content')

    <section class="content">
            <div class="row">
                    <!-- general form elements -->
                    <div class="card card-body bg-gray-light">
                        <div class="card-header">
                            <h3 class="card-title">Add New Style</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.style.store') }}" enctype="multipart/form-data">
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
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="name">Style Name</label>
                                            <input type="text" required class="form-control" name="name" id="name" placeholder="Enter Style Name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Style Code</label>
                                            <input type="text" required class="form-control" name="code" id="code" placeholder="Enter Style Code" value="{{ old('code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Internal Code</label>
                                            <input type="text"  class="form-control" name="internal_code" id="internal_code" placeholder="Enter Internal Code" value="{{ old('internal_code') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Buyer</label>
                                            <select name="buyer_id" id="buyer_id" class="form-control select2" required>
                                                <option value="">Select Buyer</option>
                                                    @foreach ($buyers as $buyer)
                                                        <option value="{{ $buyer->id }}"
                                                             @if (old('buyer_id') == $buyer->id) selected @endif>{{ $buyer->name }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Customer</label>
                                            <select name="customer_id" id="customer_id" class="form-control select2" required>
                                                <option value="">Select Customer</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}"
                                                             @if (old('customer_id') == $customer->id) selected @endif>{{ $customer->name }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>                                                               
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{ old('description') }}</textarea>
                                </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="code">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" @if (old('is_active', 1) == 1) checked @endif>
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
    <script src="{{asset('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
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
