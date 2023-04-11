<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
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
        $this->authorize('is_owner');

        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
            'owner_id' => 'required|numeric|exists:users,id',
            'sitter_id' => 'required|numeric|exists:users,id',
        ]);

        Review::create($request->all());
        return redirect()->route('users.show', ['id' => $request['sitter_id']])->with('message', 'Review geplaatst');
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
}
