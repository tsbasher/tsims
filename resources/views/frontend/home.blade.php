@extends('frontend.layout.app')
@section('title', 'Home')
@section('main')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="{{ asset($slider->image) }}" alt="" data-aos="fade-in">

            <div class="container d-flex flex-column align-items-center">
                <h2 data-aos="fade-up" data-aos-delay="100">{{ $slider->title }}</h2>
                <p data-aos="fade-up" data-aos-delay="200">{{ $slider->sub_title }}</p>
                @if ($slider->action_button_url)
                    <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ $slider->action_button_url }}" class="btn-get-started">Get Started</a>
                    </div>
                @endif
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">
                <div class="container section-title" data-aos="fade-up">
                    <h2>About</h2>
                    <p>{{ $about->title }}<br></p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset($about->featured_image) }}" class="img-fluid rounded-4 mb-4" alt="">
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="content ps-0 ps-lg-5">
                            <h3></h3>
                            <p class="fst-italic">
                                {!! $about->content !!}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Our Speciality</h2>
                <p>Why Choose us<br></p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-5">
                    @foreach ($speciality as $item)
                        <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                            <div class="service-item">
                                <div class="img">
                                    <img src="{{ asset($item->image) }}" class="img-fluid" alt="">
                                </div>
                                <div class="details position-relative">

                                    <h3>{{ $item->name }}</h3>
                                    <p>{!! $item->description !!}</p>
                                </div>
                            </div>
                        </div><!-- End Service Item -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Clients Section -->
        <section class="clients section dark-background">

            <div class="container" data-aos="fade-up">

                <div class="row gy-4 pt-5 pb-5">
                    @foreach ($certification as $item)
                        <div class="col-xl-2 col-md-3 col-6 client-logo">
                            <img src="{{ asset($item->featured_image) }}" class="img-fluid" alt=""
                                style="padding:0px; opacity: 1;">
                        </div><!-- End Client Item -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Clients Section -->

                <!-- Services Section -->
                <section id="services" class="services section light-background">

                    <!-- Section Title -->
                    <div class="container section-title" data-aos="fade-up">
                        <h2>Our</h2>
                        <p>Products<br></p>
                    </div><!-- End Section Title -->

                    <div class="container" data-aos="fade-up" data-aos-delay="100">

                        <div class="row gy-5">
                            @foreach ($products as $p)
                                <div class="col-xl-3 col-6 col-md-4" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="service-item">
                                      <div style="position: absolute; top: 10px; right: 20px; background-color: #a6c4e7; color: white; padding: 5px 10px; border-radius: 5px; font-weight: bold; z-index: 999;">
                                        
                                        <a href="{{ route('frontend.product_inquery', $p->id) }}" style="color: #151f46; text-decoration: none;"> <i class="bi bi-clipboard2-plus-fill"></i> Inquery</a>
                                      </div>

                                        <a href="{{ route('frontend.product', $p->slug) }}" class="stretched-link">
                                            <div class="img">
                                                <img src="{{ asset($p->featured_image) }}" class="img-fluid"
                                                    alt="">
                                            </div>
                                            <div class="details position-relative">

                                                <h3>{{ $p->name }}</h3>
                                            </div>
                                        </a>
                                    </div>
                                </div><!-- End Service Item -->
                            @endforeach

                        </div>

                    </div>

                </section><!-- /Services Section -->




        <!-- Clients Section -->
        <section class="clients section dark-background">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4 pt-5 pb-5">
                    @foreach ($buyer as $item)
                        <div class="col-xl-2 col-md-3 col-6 client-logo">
                            <img src="{{ asset($item->featured_image) }}" class="img-fluid" alt=""
                                style="padding:0px; opacity: 1;">
                        </div><!-- End Client Item -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Clients Section -->


@if($teams->count() > 0)
        <!-- Team Section -->
        <section id="team" class="team section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Team</h2>
                <p>CHECK OUR TEAM</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">
                    @foreach ($teams as $item)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="pic"><img src="{{ asset($item->photo) }}" class="img-fluid"
                                        alt=""></div>
                                <div class="member-info">
                                    <h4>{{ $item->name }}</h4>
                                    <span>{{ $item->designation->name }}</span>
                                    <div class="social">
                                        <a href="{{ $item->x_url }}"><i class="bi bi-twitter-x"></i></a>
                                        <a href="{{ $item->facebook_url }}"><i class="bi bi-facebook"></i></a>
                                        <a href="{{ $item->instagram_url }}"><i class="bi bi-instagram"></i></a>
                                        <a href="{{ $item->linkedin_url }}"><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Team Member -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Team Section -->
@endif
    </main>

@endsection
