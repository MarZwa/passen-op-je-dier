@extends('layouts.main')

@section('content')
    <section class='flex-center h-100'>
        <article class="card w-auto">
            <section class="card__header">
                <h2>{{ $pet->name }}</h2>
            </section>
            @if ($message = session('message'))
                <section class="status--success">{{ $message }}</section>
            @endif
            <figure class="card__fig">
                <img src="{{ url('storage/' . $pet->picture) }}" alt="Foto van {{ $pet->name }}"
                    class="card__fig__img card__fig__img--detail">
            </figure>
            <section>
                <h3>Soort dier</h3>
                <p class="mb-03">{{ $pet->kind }}</p>
            </section>
            <section class="mb-03">
                <h3>Beschrijving</h3>
                @if ($pet->description === null)
                    <p>Geen beschrijving</p>
                @else
                    <p>{{ $pet->description }}</p>
                @endif
            </section>
            <section>
                <h3>Aanvragen</h3>
                <p>{{ count($pet->requests) }}</p>
            </section>
        </article>
    </section>
@endsection
