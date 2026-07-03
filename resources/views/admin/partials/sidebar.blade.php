<ul class="nav flex-column">

    <li class="nav-item mb-2">
        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="{{ route('admin.categories.index') }}" class="nav-link text-white">
            <i class="bi bi-grid me-2"></i>
            Categories
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="{{ route('admin.sub-categories.index') }}" class="nav-link text-white">
            <i class="bi bi-diagram-3 me-2"></i>
            Sub Categories
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="{{ route('admin.brands.index') }}" class="nav-link text-white">
            <i class="bi bi-tags me-2"></i>
            Brands
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="{{ route('admin.products.index') }}" class="nav-link text-white">
            <i class="bi bi-box-seam me-2"></i>
            Products
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="{{ route('admin.product-variants.index') }}" class="nav-link text-white">
            <i class="bi bi-boxes me-2"></i>
            Product Variants
        </a>
    </li>

    {{-- Uncomment this only after Variant Images CRUD is created --}}
    {{--
    <li class="nav-item mb-2">
        <a href="{{ route('admin.variant-images.index') }}" class="nav-link text-white">
            <i class="bi bi-images me-2"></i>
            Variant Images
        </a>
    </li>
    --}}

    <li class="nav-item mb-2">
        <a href="#" class="nav-link text-white">
            <i class="bi bi-cart-check me-2"></i>
            Orders
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="#" class="nav-link text-white">
            <i class="bi bi-people me-2"></i>
            Customers
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="#" class="nav-link text-white">
            <i class="bi bi-gear me-2"></i>
            Settings
        </a>
    </li>
<li class="nav-item mb-2">
    <a href="{{ route('admin.product-attributes.index') }}" class="nav-link text-white">
        <i class="bi bi-list-ul me-2"></i>
        Product Attributes
    </a>
</li>

<li class="nav-item mb-2">
    <a href="{{ route('admin.product-attribute-values.index') }}" class="nav-link text-white">
        <i class="bi bi-card-list me-2"></i>
        Attribute Values
    </a>
</li>

</ul>