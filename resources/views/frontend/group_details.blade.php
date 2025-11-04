@extends('frontend.layout.app')
@section('title', 'Product Group Details')
@section('main')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade"
            style="background-image: url({{ asset($data->featured_image) }});">
            <div class="container position-relative">
                <h1>{{ $data->name }}</h1>
                {{-- <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Service Details</li>
          </ol>
        </nav> --}}
            </div>
        </div><!-- End Page Title -->

        <!-- Service Details Section -->

        <!-- Services Section -->
        <section id="services" class="services section">


            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row pb-2">
                    <span>{!! $data->description !!}</span>
                </div>
                <div class="row gy-5">
                    <div class="col-md-9">
                        <div class="row">
                            @if ($data->products->count() > 0)

                                @foreach ($data->products as $product)
                                    <div class="col-xl-4 col-md-3 mt-4" data-aos="zoom-in" data-aos-delay="200">
                                        <div class="service-item">
<div style="position: absolute; top: 10px; right: 20px; background-color: #16a6ad; color: white; padding: 5px 10px; border-radius: 5px; font-weight: bold; z-index: 999;">
                                        <a href="{{ route('frontend.product_inquery', $product->id) }}" style="color: white; text-decoration: none;"> <i class="bi bi-clipboard2-plus-fill"></i> Inquery</a>
                                      </div>
                                            <a href="{{ route('frontend.product', $product->slug) }}"
                                                class="stretched-link">
                                                <div class="img">
                                                    <img src="{{ asset($product->featured_image) }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                                <div class="details position-relative">

                                                    <h3>{{ $product->name }}</h3>

                                                </div>
                                            </a>
                                        </div>
                                    </div><!-- End Service Item -->
                                @endforeach
                            @else
                                <div class="col-12">
                                    <h3 class="text-center pt-5 pb-5">No products found in this category.</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3 mt-4">

                        @if ($sub_data->count() > 0)
                            <div class="row mb-2">
                                <h4 class="text-center">Select Category</h4>
                            </div>
                            @foreach ($sub_data as $category)
                                <div class="row">
                                    <a href="{{ route('frontend.product_category', $category->slug) }}"
                                        class="d-flex align-items-center text-decoration-none">
                                        <div class="col-md-4">
                                            <img src="{{ asset($category->featured_image) }}" style="padding:10px;" class="img-fluid"
                                                alt="">
                                        </div>
                                        <div class="col-md-8">
                                            <p style="margin-bottom:0px; margin-left:5px; font-weight:700">
                                                {{ $category->name }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif

                    </div>

                </div>
            </div>

        </section><!-- /Services Section -->


    </main>


@endsection
