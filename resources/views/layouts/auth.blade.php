<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="eVinetory, collectionez les saveurs et remplissez votre celliers de vins en ligne dès maintenant. ">
    <link rel="icon" href="/img/icons/appmetalogo.svg" type="image/svg">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="/css/auth.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

</head>

<body>
    <div class="container">

        <!-- Logo haut -->
        <div class="login_logo_form">
            <img src="/img/logo.webp" alt="Logo eVinetory" width='80px' height='80px'>
            <h1>eVinetory</h1>
            <h2>Collectionnez les saveurs</h2>
        </div>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

    </div>
</body>

</html>