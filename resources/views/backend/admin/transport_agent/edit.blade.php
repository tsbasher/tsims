@extends('backend.admin.layouts.app')
@section('title', 'Transport Agent')
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
                            <h3 class="card-title">Edit Transport Agent</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.transport_agent.update', $transportAgent->id) }}" enctype="multipart/form-data">
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
                                            <label for="driver_name">Driver Name</label>
                                            <input type="text" required class="form-control" name="driver_name" id="driver_name" placeholder="Enter Driver Name" value="{{ old('driver_name', $transportAgent->driver_name) }}">
                                        </div>
                                    </div>                                                                      
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="driver_mobile">Driver Mobile</label>
                                            <input type="text" required class="form-control" name="driver_mobile" id="driver_mobile" placeholder="Enter Driver Mobile" value="{{ old('driver_mobile', $transportAgent->driver_mobile) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vehicle_type">Vehicle Type</label>
                                            <input type="text"  class="form-control" name="vehicle_type" id="vehicle_type" placeholder="Enter Vehicle Type" value="{{ old('vehicle_type', $transportAgent->vehicle_type) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vehicle_number">Vehicle Number</label>
                                            <input type="text" class="form-control" name="vehicle_number" id="vehicle_number" placeholder="Enter Vehicle Number" value="{{ old('vehicle_number', $transportAgent->vehicle_number) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_name">Company Name</label>
                                            <input type="text"  class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name" value="{{ old('company_name', $transportAgent->company_name) }}">
                                        </div>
                                    </div>  
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Company Mobile</label>
                                            <input type="text" class="form-control" name="company_mobile" id="company_mobile" placeholder="Enter Company mobile" value="{{ old('company_mobile', $transportAgent->company_mobile) }}">
                                        </div>
                                    </div>                                  
                                </div>                                                               
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="company_address" id="address" placeholder="Enter Address">{{ old('company_address', $transportAgent->company_address) }}</textarea>
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
            $('#address').summernote();
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
@endsection
