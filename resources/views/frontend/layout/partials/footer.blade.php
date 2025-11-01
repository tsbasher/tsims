
  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-3 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename"><img src="{{ asset($setting->logo) }}" alt="Logo"></span>
          </a>
          <div class="footer-contact">
            
            <p class="mt-3"><strong>Phone:</strong> <span>{{ $setting->phone }}</span></p>
            <p><strong>Email:</strong> <span>{{ $setting->email }}</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href="{{ $setting->twitter?$setting->twitter:'#' }}"><i class="bi bi-twitter-x"></i></a>
            <a href="{{ $setting->facebook?$setting->facebook:'#' }}"><i class="bi bi-facebook"></i></a>
            <a href="{{ $setting->instagram?$setting->instagram:'#' }}"><i class="bi bi-instagram"></i></a>
            <a href="{{ $setting->linkedin?$setting->linkedin:'#' }}"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 footer-links">
          <h4 class="text-center">Head Office Address</h4>
          
          <div class="footer-contact">
            <p class="mt-3 text-center"><span>{!! $setting->head_address !!}</span></p>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-3 footer-links">
          <h4 class="text-center">China Office Address</h4>
          
          <div class="footer-contact">
            <p class="mt-3 text-center"><span>{!! $setting->china_address !!}</span></p>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 footer-links">
          <h4 class="text-center">Factory Address</h4>
          
          <div class="footer-contact">
            <p class="mt-3 text-center"><span>{!! $setting->factory_address !!}</span></p>
          </div>
        </div>


      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Dewi</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
      </div>
    </div>

  </footer>
