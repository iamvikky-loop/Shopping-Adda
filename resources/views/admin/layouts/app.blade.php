<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Shopping Adda Admin</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3 shadow"
         style="width:260px; min-height:100vh;">

        @include('admin.partials.sidebar')

    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">

        @include('admin.partials.navbar')

        <div class="container-fluid py-4">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>