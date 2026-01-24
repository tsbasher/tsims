<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>INAYA | @yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/sidebar.css') }}" rel="stylesheet">
<style>
    .colored-toast.swal2-icon-success {
  background-color: #34b960ff !important;
  color: white !important;
}

.colored-toast.swal2-icon-error {
  background-color: #f27474 !important;
}

.colored-toast.swal2-icon-warning {
  background-color: #f8bb86 !important;
}

.colored-toast.swal2-icon-info {
  background-color: #3fc3ee !important;
}

.colored-toast.swal2-icon-question {
  background-color: #87adbd !important;
}
</style>
    <!-- =======================================================
  * Template Name: Dewi
  * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    @include('frontend.layout.partials.header')

    @include('frontend.layout.partials.sidebar')

    @yield('main')

    @include('frontend.layout.partials.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- jQuery -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.group-item > p').forEach(el => {
            el.addEventListener('click', () => {
                const catList = el.parentElement.querySelector('.category-list');
                catList.classList.toggle('open');
                el.textContent = el.textContent.includes('▸') ? el.textContent.replace('▸', '▾') : el
                    .textContent.replace('▾', '▸');
            });
        });


        document.querySelectorAll('.category-item').forEach(cat => {
            cat.addEventListener('click', (e) => {
                if (e.target.closest('.subcategory-list')) return;
                const subList = cat.querySelector('.subcategory-list');
                if (subList) {
                    subList.classList.toggle('open');
                    const text = cat.firstChild.textContent.trim();
                    if (cat.firstChild.textContent.includes('▸')) cat.firstChild.textContent = text.replace(
                        '▸', '▾');
                    else cat.firstChild.textContent = text.replace('▾', '▸');
                }
            });
        });

        $(".product_inquery").click(function(event) {
            debugger;
            event.preventDefault(); // Prevent the default link behavior
            const url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        iconColor: 'white',
                        customClass: {
                            popup: 'colored-toast',
                        },
                    });
                    Toast.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data,
                        showConfirmButton: false,

                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });

        });
        const sidebar = document.getElementById('floatingSidebar');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
    </script>
    @yield('scripts')

</body>

</html>
