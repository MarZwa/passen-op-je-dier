<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('is-owner');

        $pets = Pet::where('owner_id', Auth::user()->id)->get();

        return view('pages.pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('is-owner');

        return view('pages.pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('is-owner');

        $request->validate([
            'name' => 'required|string|max:50',
            'kind' => 'required|string|max:50',
            'description' => 'nullable|string',
            'picture_file' => 'required|image|mimes:png,jpg,jpeg',
            'owner_id' => 'required|exists:users,id',
        ]);

        $this->uploadPicture($request);

        Pet::create($request->all());
        return redirect()->route('pets.index')->with('message', 'Huisdier aangemaakt');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pet = Pet::find($id);

        return view('pages.pets.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = Pet::findOrFail($id);

        $this->authorize('destroy-pet');

        $pet->delete();
        return back()->with('message', 'Huisdier verwijderd');
    }

    protected function uploadPicture(&$input)
    {
        if (request()->hasFile('picture_file')) {
            $uploadedFile = $input['picture_file'];
            $fileName = $uploadedFile->store('pets');
            $input->merge(['picture' => $fileName]);
        }
    }
}
