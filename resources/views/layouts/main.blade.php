<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Passen Op Je Dier</title>
</head>

<body>
    <nav class="topnav">
        <section class="topnav__head">
            <a href="{{ route('home') }}" class="topnav__logo">Passen Op Je Dier</a>
        </section>
        <section class="topnav__navbar">
            @if (!Auth::user())
                <a href="{{ route('login') }}" class="topnav__navbar__button">Log in</a>
                <a href="{{ route('register') }}" class="topnav__navbar__button">Registreer</a>
            @else
                @if (Auth::user()->role === 'Owner')
                    <a href="{{ route('pets.index') }}" class="topnav__navbar__button">Mijn huisderen</a>
                @elseif(Auth::user()->role === 'Sitter')
                    <a href="{{ route('registrations.index') }}" class="topnav__navbar__button">Mijn aanmeldingen</a>
                    <a href="{{ route('users.show', ['id' => Auth::user()->id]) }}" class="topnav__navbar__button">Profiel</a>
                @elseif (Auth::user()->role === 'Admin')
                
                <a href="{{ route('users.index') }}" class="topnav__navbar__button">Gebruikers</a>
                @endif
                <form action={{ route('logout') }} method="POST">
                    @csrf
                    <button type="submit" class="topnav__navbar__button topnav__navbar__button--logout">Log
                        uit</button>
                </form>
            @endif
        </section>
    </nav>

    <main>
        @yield('content')
    </main>
</body>

<script src="js/main.js"></script>

</html>
