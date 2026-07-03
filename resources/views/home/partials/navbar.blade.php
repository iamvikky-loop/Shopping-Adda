<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand fw-bold fs-3 text-primary"
           href="{{ route('home') }}">

            Shopping Adda

        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarMenu">

            {{-- Categories --}}
            <ul class="navbar-nav me-3">

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle fw-semibold"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">

                        <i class="bi bi-grid"></i>
                        All Categories

                    </a>

                    <ul class="dropdown-menu">

                        @forelse($categories as $category)

                            <li>

                                <a class="dropdown-item"
                                   href="{{ route('category.show', $category->slug) }}">

                                    {{ $category->name }}

                                </a>

                            </li>

                        @empty

                            <li>

                                <span class="dropdown-item text-muted">

                                    No Categories Found

                                </span>

                            </li>

                        @endforelse

                    </ul>

                </li>

            </ul>

            {{-- Search --}}
            <form class="d-flex flex-grow-1 mx-lg-3"
                  action="{{ route('search') }}"
                  method="GET">

                <input class="form-control"
                       type="search"
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="Search products...">

                <button class="btn btn-primary ms-2"
                        type="submit">

                    <i class="bi bi-search"></i>

                </button>

            </form>

            {{-- Right Menu --}}
            <ul class="navbar-nav align-items-center ms-lg-3">

                {{-- Wishlist --}}
                <li class="nav-item">

                    <a class="nav-link"
                       href="#">

                        <i class="bi bi-heart fs-5"></i>

                    </a>

                </li>

                {{-- Cart --}}
                <li class="nav-item">

                    <a class="nav-link position-relative"
                       href="{{ route('cart.index') }}">

                        <i class="bi bi-cart3 fs-5"></i>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                            0

                        </span>

                    </a>

                </li>

                @guest

                    <li class="nav-item ms-2">

                        <a class="btn btn-outline-primary"
                           href="{{ route('login') }}">

                            Login

                        </a>

                    </li>

                    <li class="nav-item ms-2">

                        <a class="btn btn-primary"
                           href="{{ route('register') }}">

                            Register

                        </a>

                    </li>

                @else

                    <li class="nav-item dropdown ms-2">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           data-bs-toggle="dropdown">

                            <i class="bi bi-person-circle fs-4"></i>

                            {{ Auth::user()->name }}

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a class="dropdown-item"
                                   href="{{ route('dashboard') }}">

                                    Dashboard

                                </a>

                            </li>

                            <li>

                                <hr class="dropdown-divider">

                            </li>

                            <li>

                                <form method="POST"
                                      action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                            class="dropdown-item">

                                        Logout

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </li>

                @endguest

            </ul>

        </div>

    </div>
</nav>

{{-- Bottom Navigation --}}
<div class="bg-dark">

    <div class="container">

        <ul class="nav py-2">

            <li class="nav-item">

                <a class="nav-link text-white"
                   href="{{ route('home') }}">

                    Home

                </a>

            </li>

            <li class="nav-item">

                <a class="nav-link text-white"
                   href="{{ route('search') }}">

                    Shop

                </a>

            </li>

            @foreach($categories as $category)

                <li class="nav-item">

                    <a class="nav-link text-white"
                       href="{{ route('category.show', $category->slug) }}">

                        {{ $category->name }}

                    </a>

                </li>

            @endforeach

            <li class="nav-item ms-auto">

                <a class="nav-link text-white"
                   href="#">

                    Contact

                </a>

            </li>

        </ul>

    </div>

</div>