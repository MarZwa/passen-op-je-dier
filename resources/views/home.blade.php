@extends('layouts.main')

@section('content')
    <h1 class="my-1">Verzoeken</h1>
    @if ($message = session('message'))
        <section class="status--success">{{ $message }}</section>
    @endif
    {{-- @if (Auth::user()) --}}
    <form action="{{route('home')}}" method="GET" class="filter">
        <select name="filter" id="filter" class="filter__select">
            <option {{ $kind === 'Alle' ? 'selected' : '' }} value="Alle">Alle</option>
            <option {{ $kind === 'Hond' ? 'selected' : '' }} value="Hond">Honden</option>
            <option {{ $kind === 'Kat' ? 'selected' : '' }} value="Kat">Kat</option>
            <option {{ $kind === 'Capibara' ? 'selected' : '' }} value="Capibara">Capibara</option>
            <option {{ $kind === 'Vis' ? 'selected' : '' }} value="Vis">Vis</option>
            <option {{ $kind === 'Schildpad' ? 'selected' : '' }} value="Schildpad">Schildpad</option>
            <option {{ $kind === 'Hamster' ? 'selected' : '' }} value="Hamster">Hamster</option>
            <option {{ $kind === 'Vos' ? 'selected' : '' }} value="Vos">Vos</option>
            <option {{ $kind === 'Egel' ? 'selected' : '' }} value="Egel">Egel</option>
        </select>
        <button type="submit" class="btn-primary filter__submit">Filter</button>
    </form>
    {{-- @endif --}}
    <section class="verzoeken">
        @foreach ($requests as $request)
            @include('components._request')
        @endforeach
    </section>
@endsection
