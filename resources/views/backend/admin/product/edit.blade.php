@extends('backend.admin.layouts.app')
@section('title', 'Product')
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
                    <h3 class="card-title">Edit Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('admin.product.update',$product->id) }}"
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
                                    <label for="name">Product Name</label>
                                    <input type="text" required class="form-control" name="name" id="name"
                                        placeholder="Enter Product Name" value="{{ old('name',$product->name) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Product Code</label>
                                    <input type="text" required class="form-control" name="code" id="code"
                                        placeholder="Enter Product Code" value="{{ old('code',$product->code) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Product Internal Code</label>
                                    <input type="text" class="form-control" name="internal_code" id="internal_code"
                                        placeholder="Enter Internal Code" value="{{ old('internal_code',$product->internal_code) }}">
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
                                                @if (old('group_id',$product->group_id) == $group->id) selected @endif>{{ $group->name }}
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
                                                @if (old('category_id',$product->category_id) == $category->id) selected @endif>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_category_id">Product Sub Category</label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control select2" required>
                                        <option value="">Select Sub Category</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                @if (old('sub_category_id',$product->sub_category_id) == $subcategory->id) selected @endif>{{ $subcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="code">Featured Image</label>
                            <input type="file" class="form-control" id="featured_image" name="featured_image">
                            @if ($product->featured_image)
                                <img src="{{ asset($product->featured_image) }}" alt="Featured Image"
                                    style="max-width: 150px; margin-top: 10px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{ old('description',$product->description) }}</textarea>
                        </div>


                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                @if (old('is_active',$product->is_active) == 1) checked @endif>
                            <label class="form-check-label" for="is_active">Is Active</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="show_as_featured" name="show_as_featured"
                                value="1" @if (old('show_as_featured', $product->is_active) == 1) checked @endif>
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
            var get_sub_category_by_category = "{{ route('common.get_sub_category_by_category', '*') }}";

    </script>
    
    <script src="{{ asset('backend/dist/js/tsims/category.js') }}"></script>
    <script src="{{ asset('backend/dist/js/tsims/sub_category.js') }}"></script>
@endsection
