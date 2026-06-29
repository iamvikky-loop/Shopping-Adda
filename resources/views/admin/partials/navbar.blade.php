<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

    <div class="container-fluid">

        <span class="navbar-brand fw-bold">

            Admin Dashboard

        </span>

        <div class="ms-auto">

            <span class="me-3">

                Welcome,

                <strong>{{ auth()->user()->name }}</strong>

            </span>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">

                @csrf

                <button class="btn btn-danger btn-sm">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>