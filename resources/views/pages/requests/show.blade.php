@extends('layouts.main')

@section('content')
    <section class='flex-center h-100'>
        <article class="card w-auto">
            <section class="card__header">
                <h2>{{ $request->pet->name }}</h2>
            </section>
            @if ($message = session('message'))
                <section class="status--success">{{ $message }}</section>
            @endif
            <figure class="card__fig">
                <img src="{{ url('storage/' . $request->pet->picture) }}" alt="{{$request->pet->kind}}" class="card__fig__img card__fig__img--detail">
            </figure>
            <section class="mb-03">
                <h3>Soort dier</h3>
                <p>{{ $request->pet->kind }}</p>
            </section>
            <section class="mb-03">
                <h3>Beschrijving</h3>
                @if ($request->pet->description === null)
                    <p>Geen beschrijving</p>
                @else
                    <p>{{ $request->pet->description }}</p>
                @endif
            </section>
            <section class="mb-03">
                <h3>Periode</h3>
                <p>{{ $request->start_date }} tot {{ $request->end_date }}</p>
            </section>
            <section>

            </section>
            <h3>Tarief</h3>
            <p class="mb-03">€{{ $request->rate }}</p>
            <section class="mb-05">
                <h3>Mijn baasje</h3>
                <p>{{ $request->pet->owner->first_name . ' ' . $request->pet->owner->last_name }}</p>
            </section>
            @if (!Auth::user() || Auth::user()->role === 'Sitter')
                <section class="flex-center">
                    <a href="{{ route('registrations.create', ['request_id' => $request->id]) }}" class="btn-primary">Aanmelden</a>
                </section>
            @endif
        </article>
    </section>
@endsection
