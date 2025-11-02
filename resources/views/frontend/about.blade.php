@extends('frontend.layout.app')
@section('title', 'About Us')
@section('main')
    <main class="main">
       
        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade"
            style="background-image: url({{ asset($about->featured_image) }});">
            <div class="container position-relative">
                <h1>About Us</h1>
                {{-- <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Service Details</li>
          </ol>
        </nav> --}}
            </div>
        </div><!-- End Page Title -->

        <!-- About Section -->
        <section class="about section">

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


        <!-- About Section -->
        <section class="about section">

            <div class="container">
                <div class="container section-title" data-aos="fade-up">
                    <h2>Our</h2>
                    <p>{{ $mission->title }}<br></p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="content ps-0 ps-lg-5">
                            <h3></h3>
                            <p class="fst-italic">
                                {!! $mission->content !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset($mission->featured_image) }}" class="img-fluid rounded-4 mb-4" alt="">
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- About Section -->
        <section class="about section">

            <div class="container">
                <div class="container section-title" data-aos="fade-up">
                    <h2>Our</h2>
                    <p>{{ $vision->title }}<br></p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset($vision->featured_image) }}" class="img-fluid rounded-4 mb-4" alt="">
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="content ps-0 ps-lg-5">
                            <h3></h3>
                            <p class="fst-italic">
                                {!! $vision->content !!}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->


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

    </main>

@endsection
