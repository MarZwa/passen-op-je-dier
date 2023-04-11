<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request) {
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
}
