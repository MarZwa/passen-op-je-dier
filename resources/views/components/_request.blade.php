<article class="card mb-05 w-auto">
    <section class="card__header">
        <h2>{{ $request->pet->name }}</h2>
    </section>
    <figure class="card__fig">
        <img src="{{ url('storage/' . $request->pet->picture) }}" alt="{{$request->pet->kind}}" class="card__fig__img">
    </figure>
    <h3>Soort dier</h3>
    <p class="mb-03">{{ $request->pet->kind }}</p>
    <h3>Periode</h3>
    <p class="mb-03">{{ $request->start_date }} tot {{ $request->end_date }}</p>
    <h3>Tarief</h3>
    @if (strlen(substr(strrchr($request->rate, '.'), 1)) == 1)
        <p class="mb-05">€{{ $request->rate }}0</p>
    @else
        <p class="mb-05">€{{ $request->rate }}</p>
    @endif
    @if (Auth::user() && Auth::user()->id === $request->pet->owner_id)
        <section class="flex-center">
            <a href="{{ route('registrations.index-request', ['id' => $request->id]) }}"
                class="btn-primary">Aanmeldingen bekijken</a>
        </section>
    @else
        <section class="flex-center">
            <a href="{{ route('requests.show', ['id' => $request->id]) }}" class="btn-primary">Meer informatie</a>
        </section>
    @endif
    @if (Auth::user() && ((Auth::user()->role === 'Admin') || (Auth::user()->id === $request->pet->owner_id && Request::is('requests/index/pet/*'))))
    <form action="{{ route('requests.destroy', ['id' => $request->id]) }}" method="POST" class="mt-03">
    @csrf
    @method('delete')    
    <button type="submit" class="btn-primary btn-primary--red">Verwijderen</button>
    </form>
    @endif
</article>
