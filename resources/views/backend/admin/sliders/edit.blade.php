@extends('backend.admin.layouts.app')
@section('title', 'Slider')
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
                            <h3 class="card-title">Edit Slider</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.sliders.update',$slider->id) }}" enctype="multipart/form-data">
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
                                            <label for="name">Slier Title</label>
                                            <input type="text" required class="form-control" name="title" id="title" placeholder="Enter Slider Title" value="{{ old('title',$slider->title) }}">
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="sub_title">Slier Sub Title</label>
                                            <input type="text" required class="form-control" name="sub_title" id="sub_title" placeholder="Enter Slider Sub Title" value="{{ old('sub_title',$slider->sub_title) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Featured Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            @if($slider->image)
                                                <img src="{{ asset($slider->image) }}" alt="Featured Image" style="max-width: 100px; margin-top: 10px;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                                               
                                <div class="form-group">
                                    <label for="action_button_url">Action Button url</label>
                                    <input type="text" class="form-control" name="action_button_url" id="action_button_url" placeholder="Enter action buttion url" value="{{ old('action_button_url',$slider->action_button_url) }}">
                                </div>


                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" @if (old('is_active', $slider->is_active) == 1) checked @endif>
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
