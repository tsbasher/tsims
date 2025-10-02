@extends('backend.admin.layouts.app')
@section('title', 'Country')
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
                            <h3 class="card-title">Edit Country</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.country.update',$country->id) }}" enctype="multipart/form-data">
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
                                            <label for="name">Country Name</label>
                                            <input type="text" required class="form-control" name="name" id="name" 
                                            placeholder="Enter Country Name" value="{{ old('name',$country->name) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="code">Country Code</label>
                                            <input type="text" required class="form-control" name="code" id="code" 
                                            placeholder="Enter Country Code" value="{{ old('code',$country->code) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="code">Internal Code</label>
                                            <input type="text"  class="form-control" name="internal_code" id="internal_code" 
                                            placeholder="Enter Internal Code" value="{{ old('internal_code',$country->internal_code) }}">
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                                    @if (old('is_active',$country->is_active) == 1) checked @endif>
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
