@extends('layouts.main')

@section('content')
    <section class='flex-center h-100'>
        <article class="card w-auto">
            <section class="card__header">
                <h2>Huisdier toevoegen</h2>
            </section>
            <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <section class="mb-03 w-100">
                    <label for="start_date" class="d-block">Startdatum:</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="d-block @error('start_date') input--error @enderror" />
                    @error('start_date')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </section>
                <section class="mb-03">
                    <label for="end_date" class="d-block">Einddatum:</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="d-block @error('end_date') input--error @enderror" />
                    @error('end_date')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </section>
                <section class="mb-05">
                    <label for="rate" class="d-block">Tarief:</label>
                    <input type="number" step="0.50" name="rate" id="rate" value="{{ old('rate') }}" class="d-block @error('rate') input--error @enderror" />
                    @error('rate')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </section>
                <input type="hidden" name="pet_id" id="pet_id" value="{{ $id }}" />
                <section class="w-100 flex-center">
                    <button type="submit" class="btn-primary">Toevoegen</button>
                </section>
            </form>
        </article>
    </section>
@endsection
