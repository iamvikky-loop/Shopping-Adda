<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold fs-3" href="{{ route('home') }}">
            Shopping Adda
        </a>

        <!-- Mobile Toggle -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- Search -->

            <form
                action="{{ route('search') }}"
                method="GET"
                class="d-flex mx-auto w-50">

                <input
                    class="form-control"
                    type="search"
                    name="search"
                    placeholder="Search products..."
                    value="{{ request('search') }}">

                <button
                    class="btn btn-warning ms-2"
                    type="submit">

                    <i class="bi bi-search"></i>

                </button>

            </form>

            <!-- Right Menu -->

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item me-3">

                    <a
                        class="nav-link"
                        href="#">

                        <i class="bi bi-heart fs-5"></i>

                    </a>

                </li>

                <li class="nav-item me-3">

                    <a
                        class="nav-link"
                        href="{{ route('cart.index') }}">

                        <i class="bi bi-cart3 fs-5"></i>

                    </a>

                </li>

                @guest

                    <li class="nav-item">

                        <a
                            href="{{ route('login') }}"
                            class="btn btn-warning">

                            Login

                        </a>

                    </li>

                @endguest

                @auth

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">

                            {{ Auth::user()->name }}

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a
                                    class="dropdown-item"
                                    href="{{ route('dashboard') }}">

                                    Dashboard

                                </a>

                            </li>

                            <li>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}">

                                    @csrf

                                    <button
                                        class="dropdown-item">

                                        Logout

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>

<div class="bg-light border-top">

    <div class="container">

        <ul class="nav py-2">

            <li class="nav-item">
                <a class="nav-link text-dark" href="/">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Men</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Women</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Electronics</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Beauty</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="#">More</a>
            </li>

        </ul>

    </div>

</div>