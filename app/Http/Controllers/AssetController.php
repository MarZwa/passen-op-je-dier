<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('store-assets', $request);

        $request->validate([
            'picture_file' => 'required|image|mimes:png,jpg,jpeg',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $this->uploadPicture($request);

        Asset::create($request->all());
        return redirect()->route('users.show', ['id' => $request['user_id']])->with('message', 'Foto toegevoegd');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    protected function uploadPicture(&$input)
    {
        if (request()->hasFile('picture_file')) {
            $uploadedFile = $input['picture_file'];
            $fileName = $uploadedFile->store('assets');
            $input->merge(['file_location' => $fileName]);
        }
    }
}
