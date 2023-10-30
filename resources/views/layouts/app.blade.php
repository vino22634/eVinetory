<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

</head>

<body>
    <div class="container">

        <!-- Composant Nav haut -->
        <header>
            <h1>eVinetory</h1>
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Composant Nav Bas -->

    </div>
</body>

</html>