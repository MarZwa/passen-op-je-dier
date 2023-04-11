@extends('layouts.main')

@section('content')
    <h1 class="my-1">Gebruikers</h1>
    @if ($message = session('message'))
        <section class="status--success">{{ $message }}</section>
    @endif
    <section class="verzoeken">
        @if ($users && count($users) > 0)
            @foreach ($users as $user)
                <article class="card mb-05 w-auto">
                    <section class="card__header">
                        <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
                    </section>
                    <section class="mb-03">
                        <h3>Email</h3>
                        <p>{{ $user->email }}</p>
                    </section>
                    <section class="mb-03">
                        <h3>Type account</h3>
                        <p>{{ $user->role }}</p>
                    </section>
                    <section class="mb-05">
                        <h3>Account geblokkeerd</h3>
                        @if ($user->blocked)
                            <p>Ja</p>
                        @else
                            <p>Nee</p>
                        @endif
                    </section>
                    <section class="flex-center">
                        <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn-primary">Bekijk
                            profiel</a>
                    </section>
                    <section>
                        @if (!$user->blocked)
                            <form action="{{ route('users.block', ['id' => $user->id]) }}" method="POST" class="mt-03">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn-primary">Blokkeren</button>
                            </form>
                        @else
                            <form action="{{ route('users.unblock', ['id' => $user->id]) }}" method="POST" class="mt-03">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn-primary">Deblokkeren</button>
                            </form>
                        @endif
                    </section>
                </article>
            @endforeach
        @else
            <p>Er zijn nog geen users</p>
        @endif
    </section>
@endsection
