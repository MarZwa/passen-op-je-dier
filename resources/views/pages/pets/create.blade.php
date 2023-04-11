@extends('layouts.main')

@section('content')
    <section class='flex-center h-100'>
        <article class="card w-auto">
            <section class="card__header">
                <h2>Huisdier toevoegen</h2>
            </section>
            <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <section class="mb-05 w-100">
                    <label for="name" class="d-block">Naam:</label>
                    <input type="text" name="name" id="name" value="{{old('name')}}" class="d-block @error('name') input--error @enderror" />
                    @error('name')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </section>  
                <section class="mb-05 w-100">
                    <label for="kind" class="d-block">Kind:</label>
                    <select name="kind" class="d-block @error('kind') input--error @enderror">
                        <option {{ old('kind') === 'Hond' ? 'selected' : '' }} value="Hond">Hond</option>
                        <option {{ old('kind') === 'Kat' ? 'selected' : '' }} value="Kat">Kat</option>
                        <option {{ old('kind') === 'Capibara' ? 'selected' : '' }} value="Capibara">Capibara</option>
                        <option {{ old('kind') === 'Vis' ? 'selected' : '' }} value="Vis">Vis</option>
                        <option {{ old('kind') === 'Schildpad' ? 'selected' : '' }} value="Schildpad">Schildpad</option>
                        <option {{ old('kind') === 'Hamster' ? 'selected' : '' }} value="Hamster">Hamster</option>
                        <option {{ old('kind') === 'Vos' ? 'selected' : '' }} value="Vos">Vos</option>
                        <option {{ old('kind') === 'Egel' ? 'selected' : '' }} value="Egel">Egel</option>
                    </select>                    
                    @error('kind')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </section>
                <section class="mb-05 w-100">
                    <label for="description" class="d-block">Beschrijving:</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="d-block @error('description') input--error @enderror" ></textarea>
                    @error('description')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </section>
                <section class="mb-05 w-100">
                    <label for="picture_file" class="d-block">Foto:</label>
                    <input type="file" name="picture_file" id="picture_file" accept="image/*" class="d-block @error('picture_file') input--error @enderror" />
                    @error('picture_file')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </section>              
                <input type="hidden" name="owner_id" id="owner_id" value="{{ Auth::user()->id }}" />
                <section class="w-100 flex-center">
                    <button type="submit" class="btn-primary">Toevoegen</button>
                </section>
            </form>
        </article>
    </section>
@endsection
