<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//get requests

Route::get('/', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('signup');
});
Route::get('/dashboard', function () {
    $servicePersonnel = Personel::where('personnel_type', 'Service')->paginate(10, ['*'], 'service_page');
    $attachmentPersonnel = Personel::where('personnel_type', 'Attachment')->paginate(10, ['*'], 'attachment_page');
    return view('dashboard', ['servicePersonnel' => $servicePersonnel, 'attachmentPersonnel' => $attachmentPersonnel]);
});
Route::get('/viewprofile', [ProfileController::class, 'viewProfile']);

Route::get('/removeprofile', function (Request $request) {
    $query = $request->input('query');

    if ($query !== null && $query !== '') {
        $results = Personel::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('email', 'LIKE', '%' . $query . '%')
            ->when(is_numeric($query), function ($q) use ($query) {
                $q->orWhere('id', $query);
            })->get();
    } else {
        $results = null;
    }

    return view('removeprofile', ['results' => $results, 'query' => $query]);
});

Route::get('/searchprofile', [PostController::class, 'searchProfile']);
Route::get('/editprofile/{id}', [PostController::class, 'editProfile']);
Route::post('/editprofile', [PostController::class, 'updateProfile']);
Route::get('/addprofile', function () {
    return view('addprofile');
});
Route::get('/personnel', function () {
    $profiles = Personel::paginate(10); // Fetch profiles with pagination
    return view('personnel', ['profiles' => $profiles]);
});
Route::get('/personnel/add-profile', function () {
    return view('personneladdprofile');
});
Route::get('/personnelsdashboard', function () {
    return view('personnelsdashboard');
});
//post requests
Route::post('/logout', [UserController::class, 'logout']);
// Route::post('/register', [UserController::class, 'register']);
Route::post('/send-admin-code', [UserController::class, 'sendAdminCode']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/removeprofile', [PostController::class, 'removeProfile']);
Route::post('/searchprofile', [PostController::class, 'searchProfile']);
Route::post('/addprofile', [UserController::class, 'addProfile']);
//blog post request
Route::post('/create_post',[PostController::class, 'createProfile']);
Route::post('/resend-admin-code', [UserController::class, 'resendAdminCode']);
Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
Route::get('/login', function () {
    return view('login');
});
