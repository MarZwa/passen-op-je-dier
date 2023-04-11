<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->where('role', '!=', 'Admin');

        return view('pages.users.index', compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $assets = Asset::all()->where('user_id', $id);
        $reviews = Review::all()->where('sitter_id', $id);

        return view('pages.users.show', compact('user', 'assets', 'reviews'));
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

    public function block (Request $request) 
    {
        $this->authorize('is-admin');

        User::where('id', $request['id'])->update(['blocked' => true]);

        return back()->with('message', 'Gebruiker geblokkeerd');
    }

    public function unblock (Request $request) 
    {
        $this->authorize('is-admin');

        User::where('id', $request['id'])->update(['blocked' => false]);

        return back()->with('message', 'Gebruiker gedeblokkeerd');
    }
}
