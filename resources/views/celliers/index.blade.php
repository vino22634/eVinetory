@extends('layouts/app')
@section('title', 'Celliers')
@section('content')

<div class="container">

    <!-- Créer un nouveau cellier -->
    <div>
        <h3>Mes celliers</h3>
        <a href="{{route('cellier.create')}}" class="btn">Créer un cellier</a>
    </div>

    <!-- Liste de mes cellier -->
    <div>
        <ul>
            @forelse($celliers as $cellier)
            <li><a href="" class="">{{ucfirst($cellier->nom)}}</a></li>
            @empty
            <li>Vous n'avez pas encore de cellier</li>
            @endforelse
        </ul>
    </div>
</div>

@endsection