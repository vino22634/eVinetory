<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="eVinetory, collectionez les saveurs et remplissez votre celliers de vins en ligne dès maintenant. ">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/components/navBar.css" rel="stylesheet">

    <!-- Script JS -->
    <script src="/js/navBar.js" defer></script>

</head>

<body>
    <div class="container">

        <!-- Nav haut -->
        <header>
            <h1>eVinetory</h1>
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Nav Bas -->
        <nav id="navbar">
            <a href="{{route('bouteilles.list')}}" class="{{ request()->is('bouteille*') ? 'active':'' }}">
                <img src="/img/icons/menu_bottles.svg" alt="Icône bouteilles">
                <!-- <x-svg.bottlesIcon /> -->
                <p>Bouteilles</p>
            </a>
            <a href="{{route('celliers.index')}}" class="{{ request()->is('cellier*') ? 'active':'' }}">
                <img src="/img/icons/menu_cellar.svg" alt="Icône celliers">
                <p>Celliers</p>
            </a>
            <a href="">
                <img src="/img/icons/menu_favorite.svg" alt="Icône favoris">
                <p>Favoris</p>
            </a>
            <a href="">
                <img src="/img/icons/menu_cart.svg" alt="Icône liste d'achats">
                <p>Achats</p>
            </a>
            <a href="">
                <img src="/img/icons/menu_profile.svg" alt="Icône profil">
                <p>Profil</p>
            </a>
        </nav>
        <footer></footer>
    </div>
</body>

</html>