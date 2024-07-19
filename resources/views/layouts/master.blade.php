<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Semantic HTML Example</title>
    <link rel="stylesheet" href="{{ asset('assets/css') }}/master.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Header section -->
    @include('includes.header_navbar')

    <!-- Main content section -->
    <main>
        <!-- Article section -->
        @yield('content')

    </main>

    <!-- Footer section -->
    @include('includes.footer')

    <script src="{{ asset('assets/js') }}/navigation_bar.js"></script>
    {{-- for more java scripts --}}
    @yield('scripts')
</body>

</html>
