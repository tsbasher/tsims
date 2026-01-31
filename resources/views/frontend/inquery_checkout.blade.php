@extends('frontend.layout.app')
@section('title', 'Product Group Details')
@section('main')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade" style="background-image: url();">
            <div class="container position-relative">
                <h1>Inquery Checkout</h1>
                {{-- <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Service Details</li>
          </ol>
        </nav> --}}
            </div>
        </div><!-- End Page Title -->

        <!-- Portfolio Details Section -->
        <section id="portfolio-details" class="portfolio-details section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                @if (Session::get('error') || Session::get('success') || $errors->any())
                    <div class="col-lg-12 pt-3">
                        <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">

                            <div class="row">
                                <div class="col-md-12">
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger alert-dismissible">{{ $message }}</div>
                                    @endif
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success alert-dismissible">{{ $message }}</div>
                                    @endif

                                </div>
                                <div class="col-md-12">
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
                            </div>
                        </div>

                    </div>
                @endif
                @if ($inquery_products && count($inquery_products) > 0)
                    <div class="row gy-4">

                        <div class="portfolio-info pt-3" data-aos="fade-up" data-aos-delay="200">
                            <h3>Inquery Products</h3>
                            <table width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Code</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inquery_products as $key => $inquery_product)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><img src="{{ asset($inquery_product->associatedModel->featured_image) }}" alt="" style="max-height: 50px;"></td>
                                            <td>{{ $inquery_product->associatedModel->code }}</td>
                                            <td>{{ $inquery_product->name }}</td>
                                            <td>{{ $inquery_product->associatedModel->category->name }}</td>
                                            <td>
                                                <a href="{{ route('frontend.product_inquery_remove', $inquery_product->id) }}" class="btn btn-danger btn-sm product_inquery_remove">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>


                        <div class="col-lg-12 pt-3">
                            <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                                <h3>Contact Form</h3>

                                <form action="{{ route('frontend.inquery.store') }}" method="post" class="php-email-form" id="inquery_form" data-aos="fade-up" data-aos-delay="500">
                                    @csrf
                                    <div class="row gy-4">

                                        <div class="col-md-6">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Your Name (Required)" required>
                                        </div>

                                        <div class="col-md-6 ">
                                            <input type="email" id="email" class="form-control" name="email" placeholder="Your Email (Required)" required>
                                        </div>


                                        <div class="col-md-6">
                                            <input type="text" name="phone" class="form-control" placeholder="Your Phone">
                                        </div>

                                        <div class="col-md-6 ">
                                            <input type="text" class="form-control" name="company" placeholder="Your Company Name">
                                        </div>

                                        <div class="col-md-12">
                                            <textarea class="form-control" name="message" rows="4" placeholder="Message"></textarea>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            {{-- <div class="h-captcha" data-sitekey="74c4844e-caa6-4a62-b6ac-4de6adb01fc4"></div> --}}

                                            <button type="submit" id="btn_inquery_form" class="btn btn-primary btn-block h-captcha" data-sitekey="74c4844e-caa6-4a62-b6ac-4de6adb01fc4" onClick="this.disabled = true" data-callback="onSubmit">
                                                Submit
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12 pt-3">
                            <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                                <h3>Inquery Product</h3>
                                <p class="text-center">No products in your inquery list.</p>
                                <p class="text-center">Please Add some Product to Inquery.</p>
                            </div>

                        </div>

                @endif


                <div class="col-lg-12 pt-3">





                </div>
            </div>

        </section><!-- /Portfolio Details Section -->


    </main>


@endsection

@section('scripts')
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function onSubmit(token) {
            debugger;
            if ($("#name").val() === '' || $("#email").val() === '') {

                return false;
            }
            document.getElementById('inquery_form').submit();
        }
        $(document).ready(function() {
            $("#btn_inquery_form").on("click", function(e) {
                e.preventDefault();
                debugger;
                this.disabled = true;
                if ($("#name").val() === '' || $("#email").val() === '') {
                    Swal.fire({
                        title: 'Warning',
                        text: "Please fill all required fields.",
                        icon: 'warning'
                    });
                    this.disabled = false;
                    return false;
                }

            });
            $('.product_inquery_remove').on('click', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        debugger;
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            iconColor: 'white',
                            customClass: {
                                popup: 'colored-toast'
                            },
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });

                        Toast.fire({
                            icon: 'success',
                            title: data.message,
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            });
        });
    </script>
@endsection
