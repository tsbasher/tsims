<!-- Toggle Button (only visible on mobile) -->
<button class="sidebar-toggle" id="sidebarToggle">☰</button>

<aside class="floating-sidebar" id="floatingSidebar">
    <p class="text-center" style="font-size:16px; color:#151f46; font-weight:bold">Product Category</p>
    <ul class="group-list">
        @foreach ($groups as $group)
            <li class="group-item">
                <p style="margin:0">{{ $group->name }} ▸</p>
                <ul class="category-list">
                    @foreach ($group->categories as $category)
                    @if($category->sub->count() >0)
                            <li class="category-item">
                                {{ $category->name }} @if($category->sub->count() > 0) ▸ @endif
                                <ul class="subcategory-list">
                                    @foreach ($category->sub as $subCategory)
                                    <a href="{{ route('frontend.product_sub_category', $subCategory->slug) }}">
                                        <li class="subcategory-item">
                                            {{ $subCategory->name }}
                                        </li>
                                        </a>
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            
                                <a href="{{ route('frontend.product_category', $category->slug) }}">
                            <li class="category-item">
                                {{ $category->name }} 
                                
                            </li>
                            </a>
                            @endif
                    @endforeach
                </ul>
            </li>
        @endforeach

    </ul>
</aside>
