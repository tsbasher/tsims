@extends('backend.admin.layouts.app')
@section('title', 'Product Sub Category')
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
                    <h3 class="card-title">Add New Product Sub Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.product_sub_category.store') }}"
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
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="name">Sub Category Name</label>
                                    <input type="text" required class="form-control" name="name" id="name"
                                        placeholder="Enter Category Name" value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Sub Category Code</label>
                                    <input type="text" required class="form-control" name="code" id="code"
                                        placeholder="Enter Category Code" value="{{ old('code') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Sub Category Internal Code</label>
                                    <input type="text" class="form-control" name="internal_code" id="internal_code"
                                        placeholder="Enter Internal Code" value="{{ old('internal_code') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Product group</label>
                                    <select name="group_id" id="group_id" class="form-control select2" required>
                                        <option value="">Select Product Group</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}"
                                                @if (old('group_id') == $group->id) selected @endif>{{ $group->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Product Category</label>
                                    <select name="category_id" id="category_id" class="form-control select2" required>
                                        <option value="">Select Product Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="code">Featured Image</label>
                            <input type="file" class="form-control" id="featured_image" name="featured_image">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{ old('description') }}</textarea>
                        </div>


                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                @if (old('is_active', 1) == 1) checked @endif>
                            <label class="form-check-label" for="is_active">Is Active</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="show_as_featured" name="show_as_featured"
                                value="1" @if (old('show_as_featured', 1) == 1) checked @endif>
                            <label class="form-check-label" for="is_active">Show as Featured</label>
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
                            var get_category_by_group = "{{ route('common.get_category_by_group', '*') }}";

    </script>
    
    <script src="{{ asset('backend/dist/js/tsims/category.js') }}"></script>
@endsection
