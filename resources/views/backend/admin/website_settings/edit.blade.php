@extends('backend.admin.layouts.app')
@section('title', 'Website Settings')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.theme.min.css') }}">
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
                <form role="form" method="POST" action="{{ route('admin.website_settings.update', $setting->id) }}"
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
                                <label for="logo">Logo Image</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                                @if ($setting->logo)
                                    <img src="{{ asset($setting->logo) }}" alt="logo Image"
                                        style="max-width: 100px; margin-top: 10px;">
                                @endif
                            </div>
                        </div>
                    </div>
                        <div class="row">

                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" required class="form-control" name="company_name" id="company_name"
                                    placeholder="Enter company name"
                                    value="{{ old('company_name', $setting->company_name) }}">
                            </div>
                        </div></div>
                        <div class="row">

                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="head_address">Head Office Address</label>
                                <textarea class="form-control" name="head_address" id="head_address" placeholder="Enter head office address">{{ old('head_address', $setting->head_address) }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                        <div class="row">

                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="china_address">China Office Address</label>
                                <textarea class="form-control" name="china_address" id="china_address" placeholder="Enter China office address">{{ old('china_address', $setting->china_address) }}</textarea>
                            </div>
                        </div>
                    </div>
                        <div class="row">

                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="factory_address">Factory Address</label>
                                <textarea class="form-control" name="factory_address" id="factory_address" placeholder="Enter factory address">{{ old('factory_address', $setting->factory_address) }}</textarea>
                            </div>
                        </div>
                    </div>
                        <div class="row">

                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Company Email</label>
                                <input type="text" required class="form-control" name="email" id="email"
                                    placeholder="Enter company email" value="{{ old('email', $setting->email) }}">
                            </div>
                        </div>
                    </div>
                        <div class="row">

                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone">Company phone</label>
                                <input type="text" required class="form-control" name="phone" id="phone"
                                    placeholder="Enter company phone" value="{{ old('phone', $setting->phone) }}">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="facebook">Company Facebook URL</label>
                                <input type="text" class="form-control" name="facebook" id="facebook"
                                    placeholder="Enter company facebook url"
                                    value="{{ old('facebook', $setting->facebook) }}">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="twitter">Company X URL</label>
                                <input type="text" class="form-control" name="twitter" id="twitter"
                                    placeholder="Enter company X url" value="{{ old('twitter', $setting->twitter) }}">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="instagram">Company Instagram URL</label>
                                <input type="text" class="form-control" name="instagram" id="instagram"
                                    placeholder="Enter company instagram url"
                                    value="{{ old('instagram', $setting->instagram) }}">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="linkedin">Company Linkedin URL</label>
                                <input type="text" class="form-control" name="linkedin" id="linkedin"
                                    placeholder="Enter company linkedin url"
                                    value="{{ old('linkedin', $setting->linkedin) }}">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="contact_notification_email">Contact Form Notification Email</label>
                                <input type="text" class="form-control" name="contact_notification_email"
                                    id="contact_notification_email" placeholder="Enter Contact from notification email"
                                    value="{{ old('contact_notification_email', $setting->contact_notification_email) }}">
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
    <script type="text/javascript">
        $(document).ready(function() {
            debugger;
            $('#head_address').summernote();
            $('#china_address').summernote();
            $('#factory_address').summernote();
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
@endsection
