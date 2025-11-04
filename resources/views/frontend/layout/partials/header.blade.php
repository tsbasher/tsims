<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('frontend.home') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset($setting->logo) }}" style="max-height: 50px;" alt=""> 
            {{-- <h1 class="sitename"></h1> --}}
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('frontend.home') }}" >Home</a></li>
                <li><a href="{{ route('frontend.about') }}">About</a></li>
                @foreach ($groups as $group)
                    @if ($group->categories->count() > 0)
                        <li class="dropdown"><a href="{{ route('frontend.product_group', $group->slug) }}"><span>{{ $group->name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                @foreach ($group->categories as $category)
                                    @if ($category->sub->count() > 0)
                                        <li class="dropdown"><a href="{{ route('frontend.product_category', $category->slug) }}"><span>{{ $category->name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                            <ul>
                                                @foreach ($category->sub as $subCategory)
                                                    <li><a  href="{{ route('frontend.product_sub_category', $subCategory->slug) }}">{{ $subCategory->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li><a  href="{{ route('frontend.product_category', $category->slug) }}">{{ $category->name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('frontend.product_group', $group->slug) }}">{{ $group->name }}</a></li>
                    @endif
                @endforeach



            <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


    </div>
</header>
