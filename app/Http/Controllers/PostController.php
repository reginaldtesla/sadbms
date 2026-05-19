<?php

namespace App\Http\Controllers;

use App\Models\Personel;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    //create profile
    public function createProfile(Request $request)
    {
        $user = auth()->user();
        $existingProfile = null;

        if ($user->role === 'personnel') {
            $existingProfile = Personel::where('user_id', $user->id)->first();

            if (! $existingProfile && $user->email) {
                $existingProfile = Personel::where('email', $user->email)->first();
            }
        }

        $emailRules = ['required', 'email'];
        $emailRules[] = $existingProfile
            ? Rule::unique('personels', 'email')->ignore($existingProfile->id)
            : Rule::unique('personels', 'email');

        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => $emailRules,
            'phone' => 'required|string|max:30',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female,other,Male,Female,Other',
            'personnel_type' => 'required',
            'department' => 'required',
            'supervision_name' => 'required',
            'assigned_role' => 'nullable',
            'institution_name' => 'required',
            'company_location' => ['required', Rule::in(Personel::COMPANY_LOCATIONS)],
            'remarks' => 'nullable',
            'duration' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'address' => 'required',
            'bio' => 'nullable',
            'program' => 'nullable',
            'photo' => 'nullable|image|max:4048',
        ]);

        $fieldsToSanitize = [
            'name',
            'email',
            'phone',
            'age',
            'supervision_name',
            'institution_name',
            'address',
            'program',
        ];

        foreach ($fieldsToSanitize as $field) {
            if (isset($incomingFields[$field])) {
                $incomingFields[$field] = strip_tags($incomingFields[$field]);
            }
        }

        $incomingFields['gender'] = ucfirst(strtolower($incomingFields['gender']));

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('personel_photos', 'public');
            $incomingFields['photo'] = $path;
        } elseif ($request->filled('photo_data')) {
            $data = $request->input('photo_data');
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = strtolower($type[1]);
                $data = base64_decode($data);
                $fileName = 'personel_' . time() . '.' . $type;
                Storage::disk('public')->put('personel_photos/' . $fileName, $data);
                $incomingFields['photo'] = 'personel_photos/' . $fileName;
            }
        }

        $incomingFields['user_id'] = $user->id;

        if ($existingProfile && $user->role === 'personnel') {
            $existingProfile->update($incomingFields);

            return redirect('/personnelsdashboard')->with('status', 'Profile updated successfully!');
        }

        try {
            Personel::create($incomingFields);
        } catch (UniqueConstraintViolationException) {
            return back()
                ->withErrors(['email' => 'This email is already used by another profile.'])
                ->withInput();
        }

        if ($user->role === 'personnel') {
            return redirect('/personnelsdashboard')->with('status', 'Profile created successfully!');
        }

        return redirect('/viewprofile')->with('status', 'Profile created successfully!');
    }
    //search profile
    public function searchProfile(Request $request){
        // Accept the query parameter from the view (input name="query").
        $searchTerm = $request->input('query', $request->input('search_term'));
        $type = $request->input('type', 'all');

        // If no search term and type is 'all', just render the view (no results).
        if ((is_null($searchTerm) || $searchTerm === '') && ($type === 'all' || is_null($type))) {
            return view('searchprofile');
        }

        $query = Personel::query();

        // If a specific type is selected, filter by it (AND with the search conditions).
        if ($type && $type !== 'all') {
            $query->where('personnel_type', $type);
        }

        // If a search term exists, match it against name/email/department or id when numeric.
        if (!is_null($searchTerm) && $searchTerm !== '') {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('department', 'LIKE', '%' . $searchTerm . '%');

                if (is_numeric($searchTerm)) {
                    $q->orWhere('id', $searchTerm);
                }
            });
        }

        $results = $query->get();

        return view('searchprofile', ['results' => $results, 'searchTerm' => $searchTerm, 'type' => $type]);
    }

    // remove profile (handles deletion from removeprofile view)
    public function removeProfile(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Only administrators can remove profiles.');
        }

        $request->validate([
            'delete_id' => 'required|integer|exists:personels,id',
        ]);

        $id = $request->input('delete_id');
        $person = Personel::find($id);
        if ($person) {
            $name = $person->name;
            $person->delete();
            return redirect('/removeprofile')->with('status', "Profile (ID: $id, $name) deleted successfully.");
        }

        return redirect('/removeprofile')->with('error', 'Profile not found.');
    }

    // Show edit form for a profile
    public function editProfile($id){
        $profile = Personel::findOrFail($id);
        return view('editprofile', ['profile' => $profile]);
    }

    // Handle update from edit form
    public function updateProfile(Request $request){
        $incomingFields = $request->validate([
            'id' => 'required|integer|exists:personels,id',
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|integer',
            'age'=>'required|integer',
            'gender'=>'required',
            'personnel_type'=>'required',
            'department'=>'required',
            'supervision_name'=>'required',
            'assigned_role'=>'nullable',
            'institution_name'=>'required',
            'company_location' => ['required', Rule::in(Personel::COMPANY_LOCATIONS)],
            'remarks'=>'nullable',
            'duration'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'address'=>'required',
            'bio'=>'nullable',
            'program'=>'nullable',
            'photo' => 'nullable|image|max:4048',
        ]);

        $fieldsToSanitize = [
            'name','email','phone','age','supervision_name','institution_name','address','program'
        ];
        foreach ($fieldsToSanitize as $field) {
            if (isset($incomingFields[$field])) {
                $incomingFields[$field] = strip_tags($incomingFields[$field]);
            }
        }
        $profile = Personel::findOrFail($incomingFields['id']);
        // don't overwrite id
        unset($incomingFields['id']);

        if ($request->hasFile('photo')) {
            // delete old photo if exists
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $path = $request->file('photo')->store('personel_photos', 'public');
            $incomingFields['photo'] = $path;
        }

        $profile->update($incomingFields);

        return redirect('/viewprofile')->with('status', 'Profile updated successfully.');
    }
}
