@extends('layouts.main')

@section('content')
    <section class="flex-center h-100">
        <form action="{{ route('register') }}" method="POST" class="card card--login">
            @csrf
            <article class="card__header mb-05">
                <h1>Registreren</h1>
            </article>
            <article class="mb-03 w-100">
                <label for="first_name" class="d-block">Voornaam:</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="d-block @error('first_name') input--error @enderror" />
                @error('first_name')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </article>
            <article class="mb-03 w-100">
                <label for="last_name" class="d-block">Achternaam:</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="d-block @error('last_name') input--error @enderror" />
                @error('last_name')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </article>
            <article class="mb-03 w-100">
                <label for="email" class="d-block">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" class="d-block @error('email') input--error @enderror" />
                @error('email')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </article>
            <article class="mb-03 w-100">
                <label for="password" class="d-block">Wachtwoord:</label>
                <input type="password" name="password" class="d-block @error('password') input--error @enderror" />
                @error('password')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </article>
            <article class="mb-03 w-100">
                <label for="password_confirmation" class="d-block">Bevestig wachtwoord:</label>
                <input type="password" name="password_confirmation" class="d-block" />
            </article>
            <article class="mb-05 w-100">
                <label for="role" class="d-block">Accounttype:</label>
                <select name="role" class="d-block @error('role') input--error @enderror">
                    <option {{ old('role') === 'Owner' ? 'selected' : '' }} value="Owner">Eigenaar</option>
                    <option {{ old('role') === 'Sitter' ? 'selected' : '' }} value="Sitter">Oppas</option>
                </select>
                @error('role')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </article>
            <article>
                <button type="submit" class="btn-primary w-100">Registreren</button>
                <div>
                    Heb je al een account?
                    <a href="{{ route('login') }}">Login</a>
                </div>
            </article>
        </form>
    </section>
@endsection
