<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Admin Dashboard')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#f4f6f9;
            font-family:'Segoe UI',sans-serif;
        }

        /* Sidebar */

        .sidebar{
            width:260px;
            min-height:100vh;
            background:#212529;
            position:fixed;
            left:0;
            top:0;
            overflow-y:auto;
        }

        .sidebar .nav-link{
            color:#fff !important;
            padding:12px 15px;
            border-radius:8px;
            transition:.3s;
            margin-bottom:5px;
        }

        .sidebar .nav-link:hover{
            background:#495057;
            color:#fff !important;
        }

       .sidebar .sidebar-link.active{
    background:#0d6efd !important;
    color:#fff !important;
}

.sidebar .sidebar-link.active i{
    color:#fff !important;
}
        /* Main */

        .main-content{
            margin-left:260px;
            min-height:100vh;
        }

        /* Navbar */

        .top-navbar{
            background:#fff;
            border-bottom:1px solid #dee2e6;
            padding:15px 25px;
            box-shadow:0 2px 8px rgba(0,0,0,.05);
        }

        /* Content */

        .page-content{
            padding:25px;
        }

    </style>

    @stack('styles')

</head>
<body>

<div class="d-flex">

    {{-- Sidebar --}}
    <aside class="sidebar">

        @include('admin.partials.sidebar')

    </aside>

    {{-- Main --}}
    <div class="main-content flex-grow-1">

        {{-- Navbar --}}
        <div class="top-navbar">

            @include('admin.partials.navbar')

        </div>

        {{-- Page Content --}}
        <div class="page-content">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>