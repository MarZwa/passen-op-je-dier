@extends('layouts.main')

@section('content')
    <h1>Registreren</h1>
    <section>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <article>
                <label for="first_name">Voornaam:</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" />
                @error('first_name')
                    <div>{{ $message }}</div>
                @enderror
            </article>
            <article>
                <label for="last_name">Achternaam:</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" />
                @error('last_name')
                    <div>{{ $message }}</div>
                @enderror
            </article>
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
                <label for="password_confirmation">Bevestig wachtwoord:</label>
                <input type="password" name="password_confirmation" />
            </article>
            <article>
                <label for="role">Accounttype:</label>
                <select name="role">
                    <option {{ old('role') == 'Owner' ? 'selected' : '' }} value="Owner">Eigenaar</option>
                    <option {{ old('role') == 'Sitter' ? 'selected' : '' }} value="Sitter">Oppas</option>
                </select>
                {{-- <input type="text" name="voornaam" value="{{ old('first_name') }}" /> --}}
                @error('role')
                    <div>{{ $message }}</div>
                @enderror
            </article>
            <article>
                <button type="submit">Registreren</button>
                <div>
                    Heb je al een account?
                    <a href="{{ route('login') }}">Login</a>
                </div>
            </article>
        </form>
    </section>
@endsection
