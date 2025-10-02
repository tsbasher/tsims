@extends('backend.admin.layouts.app')
@section('title', 'Page')
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
                            <h3 class="card-title">Edit Page</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.pages.update',$page->id) }}" enctype="multipart/form-data">
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
                                            <label for="name">Page Name</label>
                                            <input type="text" required class="form-control" name="title" id="title" placeholder="Enter Page Title" value="{{ old('title',$page->title) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="code">Page Code</label>
                                            <input type="text" required class="form-control" name="code" id="code" placeholder="Enter Page Code" value="{{ old('code',$page->code) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="code">Internal Code</label>
                                            <input type="text"  class="form-control" name="internal_code" id="internal_code" placeholder="Enter Internal Code" value="{{ old('internal_code',$page->internal_code) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="code">Featured Image</label>
                                    <input type="file" class="form-control" id="featured_image" name="featured_image">
                                    @if($page->featured_image)
                                        <img src="{{ asset($page->featured_image) }}" alt="Featured Image" style="max-width: 100px; margin-top: 10px;">
                                    @endif
                                        </div>
                                    </div>
                                </div>
                                                               
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{ old('content',$page->content) }}</textarea>
                                </div>


                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" @if (old('is_active', $page->is_active) == 1) checked @endif>
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
