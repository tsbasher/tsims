@extends('frontend.layout.app')
@section('title', 'Product Group Details')
@section('main')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade"
            style="background-image: url({{ asset($product->featured_image) }});">
            <div class="container position-relative">
                <h1>{{ $product->name }}</h1>
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

                <div class="row gy-4">
                    <div class="col-lg-12 text-center">
                        <img src="{{ asset($product->featured_image) }}" class="img-fluid" alt="">
                    </div>
                    <div class="portfolio-info pt-3" data-aos="fade-up" data-aos-delay="200">
                        <h3>Product information</h3>
                        <ul>
                            <li><strong>Name</strong>: {{ $product->name }}</li>
                            <li><strong>Product Group</strong>: {{ $product->group->name }}</li>
                            <li><strong>Product Category</strong>: {{ $product->category->name }}</li>
                            @if ($product->subCategory)
                                <li><strong>Product Subcategory</strong>: {{ $product->subCategory->name }}</li>
                            @endif
                            <li><strong>Product Code</strong>: {{ $product->code }}</li>
                        </ul>
                    </div>

                    <div class="col-lg-12 pt-3">
                        <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                            <h3>Product Description</h3>
                            <p>
                                {!! $product->description !!}</p>
                        </div>

                    </div>


                    <div class="col-lg-12 pt-3">

                        <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                            <h3>Product Gallery</h3>

                            <div class="portfolio-details-slider swiper init-swiper">

                                <script type="application/json" class="swiper-config">
                                {
                                "loop": true,
                                "speed": 600,
                                "autoplay": {
                                    "delay": 5000
                                },
                                "slidesPerView": "auto",
                                "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                }
                                }
                            </script>

                                <div class="swiper-wrapper align-items-center">
                                    @foreach ($product->galleries as $gallery)
                                        <div class="swiper-slide">
                                            <img src="{{ asset($gallery->image) }}" alt="">
                                        </div>
                                    @endforeach


                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="row text-center">
                    <a href="{{ route('frontend.product_inquery', $product->id) }}" class="pt-4 pb-4"
                        style="background-color: #16a6ad; color: white; padding: 5px 10px; border-radius: 5px; font-weight: bold; z-index: 999; color: white; text-decoration: none;">
                        <i class="bi bi-clipboard2-plus-fill"></i>Add to Inquery</a>

                </div>
                <div class="col-lg-12 pt-3">
                        <div class="portfolio-info pt-3" data-aos="fade-up" data-aos-delay="200">
                            <h3>Others Product</h3>
                            <div class="row services section">
                                @foreach ($others as $product)
                                    <div class="col-xl-3 col-md-3 mt-4" data-aos="zoom-in" data-aos-delay="200">
                                        <div class="service-item">
                                            <div
                                                style="position: absolute; top: 10px; right: 20px; background-color: #16a6ad; color: white; padding: 5px 10px; border-radius: 5px; font-weight: bold; z-index: 999;">
                                                <a href="{{ route('frontend.product_inquery', $product->id) }}"
                                                    style="color: white; text-decoration: none;"> <i
                                                        class="bi bi-clipboard2-plus-fill"></i> Inquery</a>
                                            </div>
                                            <a href="{{ route('frontend.product', $product->slug) }}"
                                                class="stretched-link">
                                                <div class="img">
                                                    <img src="{{ asset($product->featured_image) }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                                <div class="details position-relative">

                                                    <h3 style="padding-bottom:0px;border-bottom:0">{{ $product->name }}</h3>

                                                </div>
                                            </a>
                                        </div>
                                    </div><!-- End Service Item -->
                                @endforeach
                                </div>
                        </div>
                    </div>

            </div>

        </section><!-- /Portfolio Details Section -->


    </main>


@endsection
