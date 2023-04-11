@extends('layouts.main')

@section('content')
    <section class="head-button">
        <h1 class="head-button__header d-inline-block">Aanmeldingen</h1>
    </section>
    @if ($message = session('message'))
        <section class="status--success">{{ $message }}</section>
    @endif
    <section class="verzoeken">
        @if ($registrations && count($registrations) > 0)
            @foreach ($registrations as $registration)
                <article class="card mb-05 w-auto">
                    <section class="card__header">
                        <h2>{{ $registration->user->first_name }} {{ $registration->user->last_name }}</h2>
                    </section>
                    <section class="mb-03">
                        <h3>Motivatie</h3>
                        @if ($registration->motivation)
                            <p>{{ $registration->motivation }}</p>
                        @else
                            <p>Geen motivatie</p>
                        @endif
                    </section>
                    <section class="mb-05">
                        <h3>Status</h3>
                        @if ($registration->status === null)
                            {{ $registration->status }}
                            <p>Nog niet beoordeeld</p>
                        @else
                        @if ($registration->status)
                        <section class="status--success">Geaccepteerd</section>
                    @else
                        <section class="status--error">Afgewezen</section>
                    @endif
                        @endif
                    </section>
                    <section class="card__buttons">
                        <a href="{{ route('requests.show', ['id' => $registration->request_id]) }}"
                            class="btn-primary mb-03">Bekijk verzoek</a>
                        <form action="{{route('registrations.destroy', ['id' => $registration->id])}}" method="POST" class="w-100">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn-primary btn-primary--red">Verwijderen</button>
                        </form>
                    </section>
                </article>
            @endforeach
        @else
            <p>U heeft zich nog niet aangemeld als oppas</p>
        @endif
    </section>
@endsection
