@extends('backend.admin.layouts.app')
@section('title', 'Team')
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
                            <h3 class="card-title">Update Team</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.team.update',$team->id) }}" enctype="multipart/form-data">
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
                                            <label for="name">Name</label>
                                            <input type="text" required class="form-control" name="name" id="name" placeholder="Enter Buyer Name" value="{{ old('name',$team->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Designation</label>
                                            <select name="designation_id" id="designation_id" class="form-control select2" required>
                                                <option value="">Select Designation</option>
                                                    @foreach ($designations as $designation)
                                                        <option value="{{ $designation->id }}"
                                                             @if (old('designation_id',$team->designation_id) == $designation->id) selected @endif>{{ $designation->name }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>                                
                                </div>    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="url">Facebook url</label>
                                            <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="Enter Facebook url" value="{{ old('facebook_url',$team->facebook_url) }}">
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="url">Instagram url</label>
                                            <input type="text" class="form-control" name="instagram_url" id="instagram_url" placeholder="Enter Instagram url" value="{{ old('instagram_url',$team->instagram_url) }}">
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="url">X url</label>
                                            <input type="text"  class="form-control" name="x_url" id="x_url" placeholder="Enter X url" value="{{ old('x_url',$team->x_url) }}">
                                        </div>
                                    </div>                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="url">Linkedin url</label>
                                            <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" placeholder="Enter Linkedin url" value="{{ old('linkedin_url',$team->linkedin_url) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Featured Image</label>
                                            <input type="file" class="form-control" id="photo" name="photo">
                                            @if ($team->photo)
                                                <img src="{{ asset($team->photo) }}" alt="Featured Image"
                                                style="max-width: 150px; margin-top: 10px;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                                               
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter Description">{{ old('description',$team->description) }}</textarea>
                                </div>


                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                                    @if (old('is_active', $team->is_active) == 1) checked @endif>
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
