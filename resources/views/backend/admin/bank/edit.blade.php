@extends('backend.admin.layouts.app')
@section('title', 'Bank')
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
                            <h3 class="card-title">Edit Bank</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.bank.update',$bank->id) }}" enctype="multipart/form-data">
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
                                            <label for="name">Bank Name</label>
                                            <input type="text" required class="form-control" name="name" id="name" placeholder="Enter Bank Name" value="{{ old('name',$bank->name) }}"">
                                        </div>
                                    </div>                             
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Bank Code</label>
                                            <input type="text" class="form-control" name="code" id="code" placeholder="Enter Bank Code" value="{{ old('code',$bank->code) }}">
                                        </div>
                                    </div>                                    
                                </div>
                                            
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="bin">Bank BIN</label>
                                    <input type="text" required class="form-control" name="bin" id="bin" placeholder="Enter Bank bin" value="{{ old('bin',$bank->bin) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tin">Bank TIN</label>
                                    <input type="text" class="form-control" name="tin" id="tin" placeholder="Enter Bank Tin" value="{{ old('tin',$bank->tin) }}">
                                </div>
                            </div>
                        </div>                   
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{ old('description',$bank->description) }}</textarea>
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
