@extends('layouts.main')

@section('content')
    <section class='flex-center h-100'>
        <article class="card w-auto">
            <section class="card__header">
                <h2>Aanmelden als oppas voor {{ $pet_name }}</h2>
            </section>
            <form action="{{ route('registrations.store') }}" method="POST">
                @csrf
                <section class="mb-05 w-100">
                    <label for="motivation" class="d-block">Motivatie:</label>
                    <textarea name="motivation" id="motivation" cols="30" rows="5" class="d-block"></textarea>
                </section>
                <input type="hidden" name="request_id" id="request_id" value="{{ $request_id }}" />
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
                <section class="w-100 flex-center">
                    <button type="submit" class="btn-primary">Aanmelden</button>
                </section>
            </form>
        </article>
    </section>
@endsection
