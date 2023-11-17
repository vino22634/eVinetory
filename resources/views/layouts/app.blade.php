<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="eVinetory, collectionez les saveurs et remplissez votre celliers de vins en ligne dès maintenant. ">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/components/navBar.css" rel="stylesheet">

    <!-- Script JS -->
    <!-- <script src="/js/navBar.js" defer></script> -->

</head>

<body>
    <div class="container">

        <!-- Nav haut -->
        <header>
            <h1>eVinetory</h1>
        </header>

        <!-- Nav Bar -->
        <nav id="navbar">
            <a href="{{route('bouteilles.list')}}" class="{{ request()->is('bouteille*') ? 'active':'' }}">
                <x-svg.bottlesIcon />
                <p>Bouteilles</p>
            </a>
            <a href="{{route('celliers.index')}}" class="{{ request()->is('cellier*') ? 'active':'' }}">
                <x-svg.cellarIcon />
                <p>Celliers</p>
            </a>
            <a href="{{route('bouteilles.favoris')}}" class="{{ request()->is('cellier*') ? 'active':'' }}">
                <x-svg.heartIcon />
                <p>Favoris</p>
            </a>
            <a href="{{route('bouteilles.achats')}}" class="{{ request()->is('achats*') ? 'active':'' }}">
                <x-svg.cartIcon />
                <p>Achats</p>
            </a>
            <a href="{{route('profile.index')}}">
                <x-svg.profilIcon />
                <p>Profil</p>
            </a>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <footer></footer>
    </div>
</body>

</html>