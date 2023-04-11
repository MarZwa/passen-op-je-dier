@extends('layouts.main')

@section('content')
    <section class="head-button">
        <h1 class="head-button__header d-inline-block">Aanvragen voor {{$pet->name}}</h1>
        <a href="{{ route('requests.create', ['id' => $pet->id]) }}" class="btn-primary d-inline-block head-button__button">Aanvraag toevoegen</a>
    </section>
    <section class="verzoeken">
        @if ($requests && count($requests) > 0)
            @foreach ($requests as $request)
                @include('components._request')
            @endforeach
        @else
            <p>U heeft nog geen aanvragen aangemaakt voor {{$pet->name}}</p>
        @endif
    </section>
@endsection
