<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- SweetAlert2 -->
        <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <title>Larazillow</title>
        {{-- plus besoin de ca depuis la nouvelle version d'inertia <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" /> --}}

        @routes
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        @inertiaHead
    </head>

    <body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">
        @inertia
    </body>
</html>
