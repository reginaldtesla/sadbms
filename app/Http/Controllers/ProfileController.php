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
        // Start a new query on the Personel model
        $query = Personel::query();

        // Get the 'name' and 'year' from the search form
        $name = $request->input('name');
        $year = $request->input('year');

        // If a name was provided, filter the results by name
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        // If a year was selected, filter by the 'start_date' column
        if ($year) {
            $query->whereYear('start_date', $year);
        }

        // Paginate the results and ensure filters are kept on pagination links
        $profiles = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->except('page'));

        // Return the view and pass the profiles data to it
        return view('viewprofile', compact('profiles'));
    }
}
