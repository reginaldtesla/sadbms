<?php

namespace App\Http\Controllers;

use App\Models\Personel; // Make sure you have a Personel model
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function viewProfile(Request $request)
    {
        return view('viewprofile', $this->listingData($request));
    }

    public function personnelProfiles(Request $request)
    {
        return view('personnel', $this->listingData($request));
    }

    private function listingData(Request $request): array
    {
        $query = Personel::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('year')) {
            $query->whereYear('start_date', $request->input('year'));
        }

        $companyLocation = $request->input('company_location');
        if ($companyLocation && in_array($companyLocation, Personel::COMPANY_LOCATIONS, true)) {
            $query->where('company_location', $companyLocation);
        }

        return [
            'profiles' => $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->except('page')),
            'companyLocations' => Personel::COMPANY_LOCATIONS,
        ];
    }
}
