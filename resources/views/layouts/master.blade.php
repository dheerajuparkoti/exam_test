<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Semantic HTML Example</title>
    <link rel="stylesheet" href="{{ asset('assets/css') }}/layout.css" />
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
</body>

</html>
