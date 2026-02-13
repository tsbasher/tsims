<aside class="main-sidebar elevation-4 sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <span class="brand-text font-weight-bolder"> <img src="{{ asset('backend/dist/img/short_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            TSIMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-theme-light" style="overflow-y: auto;">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/dist/img/blank.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            <div class="sidebar-search-results">
                <div class="list-group"><a href="#" class="list-group-item">
                        <div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div>
                        <div class="search-path"></div>
                    </a></div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.home') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.website_settings.index') }}" class="nav-link
                        @if (Route::currentRouteName() == 'admin.website_settings.index' || Route::currentRouteName() == 'admin.website_settings.create' || Route::currentRouteName() == 'admin.website_settings.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Company Settings
                                </p>
                            </a>
                        </li>

                <li class="nav-item 
                            @if (Route::currentRouteName() == 'admin.pages.index' || Route::currentRouteName() == 'admin.pages.create' || Route::currentRouteName() == 'admin.pages.edit' || Route::currentRouteName() == 'admin.sliders.index' || Route::currentRouteName() == 'admin.sliders.create' || Route::currentRouteName() == 'admin.sliders.edit' || Route::currentRouteName() == 'admin.certification.index' || Route::currentRouteName() == 'admin.certification.create' || Route::currentRouteName() == 'admin.certification.edit' || Route::currentRouteName() == 'admin.speciality.index' || Route::currentRouteName() == 'admin.speciality.create' || Route::currentRouteName() == 'admin.speciality.edit' || Route::currentRouteName() == 'admin.team.index' || Route::currentRouteName() == 'admin.team.create' || Route::currentRouteName() == 'admin.team.edit') menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Website
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.pages.index') }}" class="nav-link
                        @if (Route::currentRouteName() == 'admin.pages.index' || Route::currentRouteName() == 'admin.pages.create' || Route::currentRouteName() == 'admin.pages.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Pages
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.sliders.index') }}" class="nav-link
                        @if (Route::currentRouteName() == 'admin.sliders.index' || Route::currentRouteName() == 'admin.sliders.create' || Route::currentRouteName() == 'admin.sliders.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Sliders
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.certification.index') }}" class="nav-link
                        @if (Route::currentRouteName() == 'admin.certification.index' || Route::currentRouteName() == 'admin.certification.create' || Route::currentRouteName() == 'admin.certification.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Certification
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.speciality.index') }}" class="nav-link
                        @if (Route::currentRouteName() == 'admin.speciality.index' || Route::currentRouteName() == 'admin.speciality.create' || Route::currentRouteName() == 'admin.speciality.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Speciality
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.team.index') }}" class="nav-link
                        @if (Route::currentRouteName() == 'admin.team.index' || Route::currentRouteName() == 'admin.team.create' || Route::currentRouteName() == 'admin.team.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Team
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item 
                            @if (Route::currentRouteName() == 'admin.product_group.index' || Route::currentRouteName() == 'admin.product_group.create' || Route::currentRouteName() == 'admin.product_group.edit' || Route::currentRouteName() == 'admin.product_category.index' || Route::currentRouteName() == 'admin.product_category.create' || Route::currentRouteName() == 'admin.product_category.edit' || Route::currentRouteName() == 'admin.product_sub_category.index' || Route::currentRouteName() == 'admin.product_sub_category.create' || Route::currentRouteName() == 'admin.product_sub_category.edit' || Route::currentRouteName() == 'admin.product.index' || Route::currentRouteName() == 'admin.product.create' || Route::currentRouteName() == 'admin.product.edit' || Route::currentRouteName() == 'admin.product.show') menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Product Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product_group.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.product_group.index' || Route::currentRouteName() == 'admin.product_group.create' || Route::currentRouteName() == 'admin.product_group.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Product Groups
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product_category.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.product_category.index' || Route::currentRouteName() == 'admin.product_category.create' || Route::currentRouteName() == 'admin.product_category.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Product Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product_sub_category.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.product_sub_category.index' || Route::currentRouteName() == 'admin.product_sub_category.create' || Route::currentRouteName() == 'admin.product_sub_category.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Product Sub Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.product.index' || Route::currentRouteName() == 'admin.product.create' || Route::currentRouteName() == 'admin.product.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Product
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item 
                            @if (Route::currentRouteName() == 'admin.department.index' || Route::currentRouteName() == 'admin.department.create' || Route::currentRouteName() == 'admin.department.edit' || 
                            Route::currentRouteName() == 'admin.designation.index' || Route::currentRouteName() == 'admin.designation.create' || Route::currentRouteName() == 'admin.designation.edit' || 
                            Route::currentRouteName() == 'admin.color.index' || Route::currentRouteName() == 'admin.color.create' || Route::currentRouteName() == 'admin.color.edit' || 
                            Route::currentRouteName() == 'admin.style.index' || Route::currentRouteName() == 'admin.style.create' || Route::currentRouteName() == 'admin.style.edit'||
                            Route::currentRouteName() == 'admin.units.index' || Route::currentRouteName() == 'admin.units.create' || Route::currentRouteName() == 'admin.units.edit'||
                            Route::currentRouteName() == 'admin.country.index' || Route::currentRouteName() == 'admin.country.create' || Route::currentRouteName() == 'admin.country.edit'||
                            Route::currentRouteName() == 'admin.currency.index' || Route::currentRouteName() == 'admin.currency.create' || Route::currentRouteName() == 'admin.currency.edit'||
                            Route::currentRouteName() == 'admin.payment_terms.index' || Route::currentRouteName() == 'admin.payment_terms.create' || Route::currentRouteName() == 'admin.payment_terms.edit'||
                            Route::currentRouteName() == 'admin.lc_type.index' || Route::currentRouteName() == 'admin.lc_type.create' || Route::currentRouteName() == 'admin.lc_type.edit'||
                            Route::currentRouteName() == 'admin.transport_agent.index' || Route::currentRouteName() == 'admin.transport_agent.create' || Route::currentRouteName() == 'admin.transport_agent.edit'||
                            Route::currentRouteName() == 'admin.shipping_type.index' || Route::currentRouteName() == 'admin.shipping_type.create' || Route::currentRouteName() == 'admin.shipping_type.edit'||
                            Route::currentRouteName() == 'admin.terms_condition.index' || Route::currentRouteName() == 'admin.terms_condition.create' || Route::currentRouteName() == 'admin.terms_condition.edit'
                            ) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.department.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.department.index' || Route::currentRouteName() == 'admin.department.create' || Route::currentRouteName() == 'admin.department.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Department
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.designation.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.designation.index' || Route::currentRouteName() == 'admin.designation.create' || Route::currentRouteName() == 'admin.designation.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Designation
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('admin.color.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.color.index' || Route::currentRouteName() == 'admin.color.create' || Route::currentRouteName() == 'admin.color.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Color
                                </p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="{{ route('admin.style.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.style.index' || Route::currentRouteName() == 'admin.style.create' || Route::currentRouteName() == 'admin.style.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Style
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('admin.units.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.units.index' || Route::currentRouteName() == 'admin.units.create' || Route::currentRouteName() == 'admin.units.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Unit
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.country.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.country.index' || Route::currentRouteName() == 'admin.country.create' || Route::currentRouteName() == 'admin.country.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Country
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.currency.index') }}" class="nav-link
                          @if (Route::currentRouteName() == 'admin.currency.index' || Route::currentRouteName() == 'admin.currency.create' || Route::currentRouteName() == 'admin.currency.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Currency
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.payment_terms.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.payment_terms.index' || Route::currentRouteName() == 'admin.payment_terms.create' || Route::currentRouteName() == 'admin.payment_terms.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Payment Terms
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.lc_type.index') }}" class="nav-link
                          @if (Route::currentRouteName() == 'admin.lc_type.index' || Route::currentRouteName() == 'admin.lc_type.create' || Route::currentRouteName() == 'admin.lc_type.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    LC Type
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.transport_agent.index') }}" class="nav-link
                          @if (Route::currentRouteName() == 'admin.transport_agent.index' || Route::currentRouteName() == 'admin.transport_agent.create' || Route::currentRouteName() == 'admin.transport_agent.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Transport Agent
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.shipping_type.index') }}" class="nav-link
                          @if (Route::currentRouteName() == 'admin.shipping_type.index' || Route::currentRouteName() == 'admin.shipping_type.create' || Route::currentRouteName() == 'admin.shipping_type.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Shipping Type
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.terms_condition.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.terms_condition.index' || Route::currentRouteName() == 'admin.terms_condition.create' || Route::currentRouteName() == 'admin.terms_condition.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Terms & Condition
                                </p>
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="nav-item 
                            @if (Route::currentRouteName() == 'admin.workorder.index' || Route::currentRouteName() == 'admin.workorder.create' || Route::currentRouteName() == 'admin.workorder.edit' || Route::currentRouteName() == 'admin.proforma_invoice.index' || Route::currentRouteName() == 'admin.proforma_invoice.create' || Route::currentRouteName() == 'admin.proforma_invoice.edit' || Route::currentRouteName() == 'admin.proforma_invoice.show' || Route::currentRouteName() == 'admin.purchase_order.index' || Route::currentRouteName() == 'admin.purchase_order.create' || Route::currentRouteName() == 'admin.purchase_order.edit' || Route::currentRouteName() == 'admin.purchase_order.show') menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Order Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.workorder.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.workorder.index' || Route::currentRouteName() == 'admin.workorder.create' || Route::currentRouteName() == 'admin.workorder.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Work Order
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.proforma_invoice.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.proforma_invoice.index' || Route::currentRouteName() == 'admin.proforma_invoice.create' || Route::currentRouteName() == 'admin.proforma_invoice.edit' || Route::currentRouteName() == 'admin.proforma_invoice.show') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Proforma Invoice(PI)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.purchase_order.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.purchase_order.index' || Route::currentRouteName() == 'admin.purchase_order.create' || Route::currentRouteName() == 'admin.purchase_order.edit' || Route::currentRouteName() == 'admin.purchase_order.show') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Purchase Order (PO)
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item 
                            @if (Route::currentRouteName() == 'admin.buyer.index' || Route::currentRouteName() == 'admin.buyer.create' || Route::currentRouteName() == 'admin.buyer.edit' || Route::currentRouteName() == 'admin.customer.index' || Route::currentRouteName() == 'admin.customer.create' || Route::currentRouteName() == 'admin.customer.edit' || Route::currentRouteName() == 'admin.merchandiser.index' || Route::currentRouteName() == 'admin.merchandiser.create' || Route::currentRouteName() == 'admin.merchandiser.edit' || Route::currentRouteName() == 'admin.supplier.index' || Route::currentRouteName() == 'admin.supplier.create' || Route::currentRouteName() == 'admin.supplier.edit') menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Client Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.buyer.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.buyer.index' || Route::currentRouteName() == 'admin.buyer.create' || Route::currentRouteName() == 'admin.buyer.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Buyer
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.customer.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.customer.index' || Route::currentRouteName() == 'admin.customer.create' || Route::currentRouteName() == 'admin.customer.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Customer
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.merchandiser.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.merchandiser.index' || Route::currentRouteName() == 'admin.merchandiser.create' || Route::currentRouteName() == 'admin.merchandiser.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Merchandiser
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.supplier.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.supplier.index' || Route::currentRouteName() == 'admin.supplier.create' || Route::currentRouteName() == 'admin.supplier.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Supplier
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item 
                            @if (Route::currentRouteName() == 'admin.bank.index' || Route::currentRouteName() == 'admin.bank.create' || Route::currentRouteName() == 'admin.bank.edit' || Route::currentRouteName() == 'admin.bank_account.index' || Route::currentRouteName() == 'admin.bank_account.create' || Route::currentRouteName() == 'admin.bank_account.edit') menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Bank Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.bank.index') }}" class="nav-link
                          @if (Route::currentRouteName() == 'admin.bank.index' || Route::currentRouteName() == 'admin.bank.create' || Route::currentRouteName() == 'admin.bank.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Bank
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.bank_account.index') }}" class="nav-link
                          @if (Route::currentRouteName() == 'admin.bank_account.index' || Route::currentRouteName() == 'admin.bank_account.create' || Route::currentRouteName() == 'admin.bank_account.edit') active @endif">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Bank Account
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('admin.inquery.index') }}" class="nav-link
                  @if (Route::currentRouteName() == 'admin.inquery.index' || Route::currentRouteName() == 'admin.inquery.show') active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Inquery
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.logout') }}" class="nav-link text-danger text-bold">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
