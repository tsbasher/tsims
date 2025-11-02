@extends('frontend.layout.app')
@section('title', 'Home')
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
                    @if($data->products->count()>0)
                        
                    @foreach ($data->products as $product)
                        <div class="col-xl-3 col-md-4" data-aos="zoom-in" data-aos-delay="200">
                            <div class="service-item">

                                <a href="{{ route('frontend.product', $product->slug) }}" class="stretched-link">
                                    <div class="img">
                                        <img src="{{ asset($product->featured_image) }}" class="img-fluid" alt="">
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

        </section><!-- /Services Section -->


    </main>


@endsection
