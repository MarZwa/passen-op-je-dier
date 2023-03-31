@extends('layouts.main')

@section('content')
    <h1>Registreren</h1>
    <section>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <article>
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" />
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </article>
            <article>
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" />
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </article>
            <article>
                <button type="submit">Inloggen</button>
                <div>
                    Nog geen account?
                    <a href="{{ route('register') }}">Registreer</a>
                </div>
            </article>
        </form>
    </section>
@endsection
