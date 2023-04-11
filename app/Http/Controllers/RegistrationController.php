<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as RequestModel;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('is-sitter');

        $registrations = Registration::all()->where('user_id', Auth::user()->id);

        return view('pages.registrations.index', compact('registrations'));
    }

    public function indexRequest(string $id)
    {
        $request = RequestModel::find($id);

        $this->authorize('get-request-registrations', $request);

        $registrations = $request->registrations;

        return view('pages.registrations.index-request', compact('request', 'registrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $request_id)
    {
        $this->authorize('is-sitter');

        $pet_name = RequestModel::find($request_id)->pet->name;

        return view('pages.registrations.create', compact('request_id', 'pet_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('is-sitter');

        $request->validate([
            'request_id' => 'required|exists:requests,id',
            'user_id' => 'required|exists:users,id',
            'motivation' => 'nullable|string'
        ]);

        Registration::create($request->all());
        return redirect()->route('registrations.index')->with('message', 'Aanmelding ingediend');
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
        $registration = Registration::findOrFail($id);
        
        $this->authorize('destroy-registration', $registration);

        $registration->delete();
        return back()->with('message', 'Verzoek verwijderd');
    }

    public function accept(Request $request)
    {
        $registration = Registration::findOrFail($request['registration_id']);

        $this->authorize('answer-registration', $registration);

        RequestModel::where('id', $request['request_id'])->update(['status' => true, 'sitter_id' => $request['sitter_id']]);
        Registration::where('id', $request['registration_id'])->update(['status' => true]);
        Registration::where('request_id', $request['request_id'])->where('id', '!=', $request['registration_id'])->where('status', null)->update(['status' => false]);

        return redirect()->route('registrations.index-request', ['id' => $request['request_id']])->with('message', 'Aanmelding goedgekeurd');
    }

    public function decline(Request $request)
    {
        $registration = Registration::find($request['registration_id']);

        $this->authorize('answer-registration', $registration);
        
        Registration::where('id', $request['registration_id'])->update(['status' => false]);

        return redirect()->route('registrations.index-request', ['id' => $request['request_id']])->with('message', 'Aanmelding afgekeurd');
    }
}
