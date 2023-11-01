@extends('layouts/app')
@section('title', 'Celliers')
@section('content')

<style>
    section {
        padding: 2rem 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .cellier__card-container {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .cellier__card a {
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: inherit;
    }

    .cellier__card a:hover {
        -webkit-transform: scale(1.05, 1.05);
        transform: scale(1.05, 1.05);
        cursor: pointer;
    }

    .cellier__card img {
        width: 2rem;
        height: 2rem;
        margin-left: 0.5rem;
        display: inline;
    }
</style>
<section>
    <h2>Mes celliers</h2>

    <!-- Liste de mes cellier -->
    <div>
        <ul class="cellier__card-container">
            @forelse($celliers as $cellier)
            <li class="cellier__card">
                <a href="{{route('cellier.show', $cellier->id)}}">
                    <h3>{{ucfirst($cellier->name)}}</h3>
                    <span><img src="img/icons/menu_bottles.svg" alt="">x {{$cellier->bouteillesCellier->count()}}</span>
                </a>
            </li>
            @empty
            <li>Vous n'avez pas encore de cellier</li>
            @endforelse
        </ul>
    </div>

    <!-- Créer un nouveau cellier -->
    <a href="{{route('cellier.create')}}" class="button">Ajouter un cellier</a>

</section>

@endsection