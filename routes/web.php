<?php

use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Guest (unauthenticated) routes
Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'login']);

Route::get('/register', function () {
    return view('signup');
});

Route::post('/send-admin-code', [UserController::class, 'sendAdminCode']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/resend-admin-code', [UserController::class, 'resendAdminCode']);

Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// Authenticated routes
Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/dashboard', function () {
        $servicePersonnel = Personel::where('personnel_type', 'Service')->paginate(10, ['*'], 'service_page');
        $attachmentPersonnel = Personel::where('personnel_type', 'Attachment')->paginate(10, ['*'], 'attachment_page');

        return view('dashboard', [
            'servicePersonnel' => $servicePersonnel,
            'attachmentPersonnel' => $attachmentPersonnel,
        ]);
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

    Route::post('/removeprofile', [PostController::class, 'removeProfile']);

    Route::get('/searchprofile', [PostController::class, 'searchProfile']);

    Route::get('/editprofile/{id}', [PostController::class, 'editProfile']);
    Route::post('/editprofile', [PostController::class, 'updateProfile']);

    Route::get('/addprofile', function () {
        return view('addprofile');
    });

    Route::post('/create_post', [PostController::class, 'createProfile']);

    Route::get('/personnel', [ProfileController::class, 'personnelProfiles']);

    Route::get('/personnel/add-profile', function () {
        $profile = auth()->user()->resolvePersonelProfile();

        return view('personneladdprofile', compact('profile'));
    });

    Route::get('/personnelsdashboard', function () {
        $user = auth()->user();
        $profile = $user->resolvePersonelProfile();

        if ($profile && ! $profile->user_id) {
            $profile->update(['user_id' => $user->id]);
        }

        return view('personnelsdashboard', compact('profile'));
    });

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
