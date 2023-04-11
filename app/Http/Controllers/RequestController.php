<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kind = $request['filter'];

        if($kind === 'Alle' || $kind === null) {
            $requests = RequestModel::all()->where('status', null);
        } else {
            $pets = Pet::all()->where('kind', $kind);
            $requests = [];

            foreach($pets as $pet) {
                $petRequests = $pet->requests;
                foreach($petRequests as $petRequest) {
                    $requests[] = $petRequest;
                }
            }
        }

        return view('home', compact('requests', 'kind'));
    }

    public function indexPet(string $id)
    {
        $pet = Pet::find($id);

        $this->authorize('get-pet-requests', $pet);

        $requests = $pet->requests;

        return view('pages.requests.pet-index', compact('pet', 'requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $pet = Pet::find($id);

        // $this->authorize('get-pet-requests', $pet);

        return view('pages.requests.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('is-owner');

        $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'rate' => 'required|numeric|decimal:1,2',
            'pet_id' => 'required|exists:pets,id',
        ]);

        RequestModel::create($request->all());
        return redirect()->route('requests.index-pet', ['id' => $request['pet_id']])->with('message', 'Aanvraag aangemaakt');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = RequestModel::find($id);

        return view('pages.requests.show', compact('request'));
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
        $request = RequestModel::findOrFail($id);
        
        $this->authorize('destroy-request', $request);

        $request->delete();
        return back()->with('message', 'Verzoek verwijderd');
    }
}
