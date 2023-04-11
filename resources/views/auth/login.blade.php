@extends('layouts.main')

@section('content')
    <section class="flex-center h-100">
        <form action="{{ route('login') }}" method="POST" class="card card--login">
            @csrf
            <article class="card__header mb-05">
                <h1>Inloggen</h1>
            </article>
            @if (session('error'))
                <article class="mb-05 status--error">
                    {{ session('error') }}
                </article>
            @endif
            <article class="mb-03 w-100">
                <label for="email" class="d-block">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="d-block @error('email') input--error @enderror" placeholder="Email" />
                @error('email')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </article>
            <article class="mb-05 w-100">
                <label for="password" class="d-block">Wachtwoord:</label>
                <input type="password" name="password" class="d-block @error('password') input--error @enderror"
                    placeholder="Wachtwoord" />
                @error('password')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </article>
            <article>
                <button type="submit" class="btn-primary w-100">Inloggen</button>
                <div>
                    Nog geen account?
                    <a href="{{ route('register') }}">Registreer</a>
                </div>
            </article>
        </form>
    </section>
@endsection
