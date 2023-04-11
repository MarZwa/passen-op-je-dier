@extends('layouts.main')

@section('content')
    <section class="head-button">
        <h1 class="head-button__header d-inline-block">Aanmeldingen voor {{ $request->pet->name }},
            {{ $request->start_date }} tot {{ $request->end_date }}</h1>
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
                        <a href="{{ route('users.show', ['id' => $registration->user_id]) }}" class="btn-primary mb-03">Bekijk profiel</a>
                        <form action="{{ route('registrations.accept') }}" method="POST" class="mb-03 w-100">
                            @csrf
                            @method('put')
                            <input type="hidden" name="request_id" id="request_id" value={{ $request->id }}>
                            <input type="hidden" name="registration_id" id="registration_id"
                                value={{ $registration->id }}>
                            <input type="hidden" name="sitter_id" id="sitter_id" value={{ $registration->user_id }}>
                            <button type="submit" class="btn-primary btn-primary--green @if($registration->status !== null) disabled @endif" @if($registration->status !== null) disabled @endif>Accepteren</button>
                        </form>
                        <form action="{{ route('registrations.decline') }}" method="POST" class="w-100">
                            @csrf
                            @method('put')
                            <input type="hidden" name="request_id" id="request_id" value={{ $request->id }}>
                            <input type="hidden" name="registration_id" id="registration_id"
                                value={{ $registration->id }}>
                            <button type="submit" class="btn-primary btn-primary--red @if($registration->status !== null) disabled @endif" @if($registration->status !== null) disabled @endif>Afwijzen</button>
                        </form>
                    </section>
                </article>
            @endforeach
        @else
            <p>Er zijn nog geen aanmeldingen voor {{ $request->pet->name }}</p>
        @endif
    </section>
@endsection
