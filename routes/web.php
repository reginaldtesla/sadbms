<?php

use App\Http\Controllers\PostController;
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
    Personel::all();
    return view('dashboard');
});
Route::get('/viewprofile', function (Request $request) {
    $id = $request->input('id');

    if ($id !== null && $id !== '') {
        // Only perform exact ID lookup when an id parameter is provided
        $profiles = Personel::where('id', $id)->get();
    } else {
        $profiles = Personel::all();
    }

    return view('viewprofile', ['profiles' => $profiles]);
});

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
//post requests
Route::post('/logout', [UserController::class, 'logout']);
// Route::post('/register', [UserController::class, 'register']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/removeprofile', [PostController::class, 'removeProfile']);
Route::post('/searchprofile', [PostController::class, 'searchProfile']);
Route::post('/addprofile', [UserController::class, 'addProfile']);
//blog post request
Route::post('/create_post',[PostController::class, 'createProfile']);
