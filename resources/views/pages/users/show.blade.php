@extends('layouts.main')

@section('content')
    <section class="profile">
        <article class="card">
            <article class="card__header mb-05">
                <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
            </article>
            <article class="mb-03">
                <h2>Email</h2>
                <p>{{ $user->email }}</p>
            </article>
            <article class="mb-03">
                <h2>Account type</h2>
                <p>{{ $user->role }}</p>
            </article>
            <article class="mb-03">
                <h2>Mijn huis</h2>
                @if ($assets && count($assets) > 0)
                    <figure class="profile__figure mb-03">
                        @foreach ($assets as $asset)
                            <section class="flex-center">
                                <img src="{{ url('storage/' . $asset->file_location) }}" alt="Foto van huis"
                                    class="profile__figure__img">
                            </section>
                        @endforeach
                    </figure>
                @else
                    <p class="mb-03">Geen foto's beschikbaar</p>
                @endif
                @if (Auth::user()->id === $user->id)
                    <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data"
                        class="profile__form">
                        @csrf
                        <section>
                            <input type="file" name="picture_file" id="picture_file" accept="image/*"
                                class="@error('picture_file') input--error @enderror profile__form__content" />
                            @error('picture_file')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </section>
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" />
                        <button type="submit" class="btn-primary profile__form__content">Toevoegen</button>
                    </form>
                @endif
            </article>
            @if (Auth::user()->role === 'Owner')
                <article class="mb-03">
                    <h2>Plaats review</h2>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <section class="mb-03">
                            <label for="rating" class="d-block">Beoordeling:</label>
                            <select name="rating" class="d-block @error('rating') input--error @enderror">
                                <option {{ old('rating') === '0' ? 'selected' : '' }} value="0">0</option>
                                <option {{ old('rating') === '1' ? 'selected' : '' }} value="1">1</option>
                                <option {{ old('rating') === '2' ? 'selected' : '' }} value="2">2</option>
                                <option {{ old('rating') === '3' ? 'selected' : '' }} value="3">3</option>
                                <option {{ old('rating') === '4' ? 'selected' : '' }} value="4">4</option>
                                <option {{ old('rating') === '5' ? 'selected' : '' }} value="5">5</option>
                                @error('rating')
                                    <div class="text-error">{{ $message }}</div>
                                @enderror
                            </select>
                        </section>
                        <section class="mb-05 w-100">
                            <label for="review" class="d-block">Review:</label>
                            <textarea name="review" id="review" cols="30" rows="5"
                                class="d-block @error('review') input--error @enderror"></textarea>
                            @error('review')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </section>
                        <input type="hidden" name="owner_id" id="owner_id" value="{{ Auth::user()->id }}" />
                        <input type="hidden" name="sitter_id" id="sitter_id" value="{{ $user->id }}" />
                        <button type="submit" class="btn-primary profile__form__content">Plaatsen</button>
                    </form>
                </article>
            @endif
            <article class="reviews">
                <h2>Reviews</h2>
                @if ($reviews && count($reviews) > 0)
                    @foreach ($reviews as $review)
                        <section class="reviews__review">
                            <h3 class="mb-03">{{ $review->owner->first_name }} {{ $review->owner->last_name }}</h3>
                            <p>Beoordeling: {{ $review->rating }}/5</p>
                            <p>{{ $review->review }}</p>
                        </section>
                    @endforeach
                @else
                    <p>Nog geen reviews</p>
                @endif
            </article>
        </article>
    </section>
@endsection
