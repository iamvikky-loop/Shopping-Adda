<div class="p-3">

    <h3 class="fw-bold text-warning mb-0">
        Shopping Adda
    </h3>

    <small class="text-light">
        Admin Panel
    </small>

    <hr class="text-secondary">

    <ul class="nav flex-column">

        {{-- Dashboard --}}
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        {{-- Categories --}}
        <li class="nav-item mb-2">
            <a href="{{ route('admin.categories.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-grid me-2"></i>
                Categories
            </a>
        </li>

        {{-- Sub Categories --}}
        <li class="nav-item mb-2">
            <a href="{{ route('admin.sub-categories.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('admin.sub-categories.*') ? 'active' : '' }}">
                <i class="bi bi-diagram-3 me-2"></i>
                Sub Categories
            </a>
        </li>

        {{-- Brands --}}
        <li class="nav-item mb-2">
            <a href="{{ route('admin.brands.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                <i class="bi bi-tags me-2"></i>
                Brands
            </a>
        </li>

        {{-- Products --}}
        <li class="nav-item mb-2">
            <a href="{{ route('admin.products.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam me-2"></i>
                Products
            </a>
        </li>

        {{-- Product Variants --}}
        <li class="nav-item mb-2">
            <a href="{{ route('admin.product-variants.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('admin.product-variants.*') ? 'active' : '' }}">
                <i class="bi bi-boxes me-2"></i>
                Product Variants
            </a>
        </li>

        {{-- Variant Images --}}
        <li class="nav-item mb-2">
            <a href="{{ route('admin.variant-images.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('admin.variant-images.*') ? 'active' : '' }}">
                <i class="bi bi-images me-2"></i>
                Variant Images
            </a>
        </li>

        {{-- Orders --}}
        <li class="nav-item mb-2">
            <a href="{{ route('admin.orders.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-cart-check me-2"></i>
                Orders
            </a>
        </li>

        {{-- Customers --}}
        <li class="nav-item mb-2">
            <a href="#"
               class="nav-link sidebar-link">
                <i class="bi bi-people me-2"></i>
                Customers
            </a>
        </li>

        {{-- Shipping --}}
        <li class="nav-item mb-2">
            <a href="{{ route('admin.shipping.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('admin.shipping.*') ? 'active' : '' }}">
                <i class="bi bi-truck me-2"></i>
                Shipping Settings
            </a>
        </li>

    </ul>

</div>