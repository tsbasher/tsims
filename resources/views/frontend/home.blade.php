@extends("frontend.layout.app")
@section('title','Home')
@section('main')
  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="{{ asset($slider->image) }}" alt="" data-aos="fade-in">

      <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">{{ $slider->title }}</h2>
        <p data-aos="fade-up" data-aos-delay="200">{{ $slider->sub_title }}</p>
@if($slider->action_button_url)
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

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projects</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-headset color-green flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hours Of Support</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-people color-pink flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hard Workers</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Featured Srvices<br></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">

          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-item">
              <div class="img">
                <img src="{{ asset('frontend/assets/img/services-1.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-activity"></i>
                </div>
                <a href="service-details.html" class="stretched-link">
                  <h3>Nesciunt Mete</h3>
                </a>
                <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="service-item">
              <div class="img">
                <img src="{{ asset('frontend/assets/img/services-2.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-broadcast"></i>
                </div>
                <a href="service-details.html" class="stretched-link">
                  <h3>Eosle Commodi</h3>
                </a>
                <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="service-item">
              <div class="img">
                <img src="{{ asset('frontend/assets/img/services-3.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-easel"></i>
                </div>
                <a href="service-details.html" class="stretched-link">
                  <h3>Ledo Markt</h3>
                </a>
                <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('frontend/assets/img/clients/client-1.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('frontend/assets/img/clients/client-2.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('frontend/assets/img/clients/client-3.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('frontend/assets/img/clients/client-4.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('frontend/assets/img/clients/client-5.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('frontend/assets/img/clients/client-6.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <div class="container">

        <ul class="nav nav-tabs row  d-flex" data-aos="fade-up" data-aos-delay="100">
          <li class="nav-item col-3">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
              <i class="bi bi-binoculars"></i>
              <h4 class="d-none d-lg-block">Modi sit est dela pireda nest</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
              <i class="bi bi-box-seam"></i>
              <h4 class="d-none d-lg-block">Unde praesenti mara setra le</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
              <i class="bi bi-brightness-high"></i>
              <h4 class="d-none d-lg-block">Pariatur explica nitro dela</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
              <i class="bi bi-command"></i>
              <h4 class="d-none d-lg-block">Nostrum qui dile node</h4>
            </a>
          </li>
        </ul><!-- End Tab Nav -->

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

          <div class="tab-pane fade active show" id="features-tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i>
                    <spab>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</spab>
                  </li>
                  <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit</span>.</li>
                  <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                </ul>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('frontend/assets/img/working-1.jpg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content Item -->

          <div class="tab-pane fade" id="features-tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Neque exercitationem debitis soluta quos debitis quo mollitia officia est</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('frontend/assets/img/working-2.jpg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content Item -->

          <div class="tab-pane fade" id="features-tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Voluptatibus commodi ut accusamus ea repudiandae ut autem dolor ut assumenda</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</span></li>
                </ul>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('frontend/assets/img/working-3.jpg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content Item -->

          <div class="tab-pane fade" id="features-tab-4">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Omnis fugiat ea explicabo sunt dolorum asperiores sequi inventore rerum</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('frontend/assets/img/working-4.jpg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content Item -->

        </div>

      </div>

    </section><!-- /Features Section -->

    <!-- Services 2 Section -->
    <section id="services-2" class="services-2 section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>CHECK OUR SERVICES</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item d-flex position-relative h-100">
              <i class="bi bi-briefcase icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Lorem Ipsum</a></h4>
                <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item d-flex position-relative h-100">
              <i class="bi bi-card-checklist icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Dolor Sitema</a></h4>
                <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex position-relative h-100">
              <i class="bi bi-bar-chart icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Sed ut perspiciatis</a></h4>
                <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item d-flex position-relative h-100">
              <i class="bi bi-binoculars icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Magni Dolores</a></h4>
                <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item d-flex position-relative h-100">
              <i class="bi bi-brightness-high icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Nemo Enim</a></h4>
                <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item d-flex position-relative h-100">
              <i class="bi bi-calendar4-week icon flex-shrink-0"></i>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Eiusmod Tempor</a></h4>
                <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services 2 Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">

      <img src="{{ asset('frontend/assets/img/testimonials-bg.jpg') }}" class="testimonials-bg" alt="">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
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
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('frontend/assets/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>CHECK OUR PORTFOLIO</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-product">Product</li>
            <li data-filter=".filter-branding">Branding</li>
            <li data-filter=".filter-books">Books</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/app-1.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>App 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/app-1.jpg') }}" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/product-1.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Product 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/product-1.jpg') }}" title="Product 1" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/branding-1.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Branding 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/branding-1.jpg') }}" title="Branding 1" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/books-1.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Books 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/books-1.jpg') }}" title="Branding 1" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/app-2.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>App 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/app-2.jpg') }}" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/product-2.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Product 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/product-2.jpg') }}" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/branding-2.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Branding 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/branding-2.jpg') }}" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/books-2.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Books 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/books-2.jpg') }}" title="Branding 2" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/app-3.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>App 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/app-3.jpg') }}" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/product-3.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Product 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/product-3.jpg') }}" title="Product 3" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/branding-3.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Branding 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/branding-3.jpg') }}" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
              <div class="portfolio-content h-100">
                <img src="{{ asset('frontend/assets/img/portfolio/books-3.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Books 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{ asset('frontend/assets/img/portfolio/books-3.jpg') }}" title="Branding 3" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Team Section -->
    <section id="team" class="team section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>CHECK OUR TEAM</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="pic"><img src="{{ asset('frontend/assets/img/team/team-1.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <div class="pic"><img src="{{ asset('frontend/assets/img/team/team-2.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="pic"><img src="{{ asset('frontend/assets/img/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 ">
            <div class="row gy-4">

              <div class="col-lg-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

            </div>
          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="4" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  @endsection