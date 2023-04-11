@extends('layouts.main')

@section('content')
    <section class="head-button">
        <h1 class="head-button__header d-inline-block">Mijn huisdieren</h1>
        <a href="{{ route('pets.create') }}" class="btn-primary d-inline-block head-button__button">Huisdier toevoegen</a>
    </section>
    @if ($message = session('message'))
        <section class="status--success">{{ $message }}</section>
    @endif
    <section class="verzoeken">
        @if ($pets && count($pets) > 0)
            @foreach ($pets as $pet)
                <article class="card mb-05 w-auto">
                    <section class="card__header">
                        <h2>{{ $pet->name }}</h2>
                    </section>
                    @if ($pet->picture)
                        <figure class="card__fig">
                            <img src="{{ url('storage/' . $pet->picture) }}" alt="Foto van {{ $pet->name }}"
                                class="card__fig__img">
                        </figure>
                    @endif
                    <section class="mb-03">
                        <h3>Soort dier</h3>
                        <p>{{ $pet->kind }}</p>
                    </section>
                    <section class="mb-05">
                        <h3>Beschrijving</h3>
                        @if($pet->description)
                        <p>{{ $pet->description }}</p>
                        @else
                        <p>Geen beschrijving</p>
                        @endif
                    </section>
                    <section class="flex-center">
                        <a href="{{ route('requests.index-pet', ['id' => $pet->id]) }}" class="btn-primary">Bekijk
                            aanvragen</a>
                    </section>
                    <section>
                        @if (Auth::user() && Auth::user()->id === $pet->owner_id)
                            <form action="{{ route('pets.destroy', ['id' => $pet->id]) }}" method="POST"
                                class="mt-03">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn-primary btn-primary--red">Verwijderen</button>
                            </form>
                        @endif
                    </section>
                </article>
            @endforeach
        @else
            <p>U heeft nog geen huisdieren</p>
        @endif
    </section>
@endsection
