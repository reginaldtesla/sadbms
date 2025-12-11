<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\AdminRegistrationCodeMail;

class UserController extends Controller
{


     // Handle logout functionality
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/');
    }
//Handle sending admin registration code
    public function sendAdminCode(Request $request)
    {
        $adminEmail = 'reginaldtesla6@gmail.com';
        $code = random_int(100000, 999999);

        // Store the code in the session for later verification
        $request->session()->put('admin_registration_code', $code);
        $request->session()->put('admin_registration_email', $adminEmail);
        $request->session()->put('admin_code_expiry', now()->addMinutes(10));

        try {
            Mail::to($adminEmail)->send(new AdminRegistrationCodeMail($code));
        } catch (\Exception $e) {
            return redirect('/register')->withErrors(['email' => 'Failed to send email: ' . $e->getMessage()]);
        }

        return redirect('/register')->with('code_sent', 'A verification code has been sent to the administrator.');
    }


    //Handle signup functionality
    public function register(Request $request){
        $role = $request->input('role', 'personnel');
        $rules = [
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'password' => ['required', 'string', 'min:3', 'max:50', 'confirmed'],
        ];
        $validatedData = [];

        if ($role === 'admin') {
            if ($this->isAdminCodeExpired($request)) {
                return back()->withErrors(['code' => 'The verification code has expired. Please request a new code.']);
            }

            $rules['code'] = ['required', function ($attribute, $value, $fail) use ($request) {
                $sessionCode = $request->session()->get('admin_registration_code');
                if (!$sessionCode || $value != $sessionCode) {
                    $fail('The provided code is incorrect.');
                }
            }];

            $validatedData = $request->validate($rules);

            $email = $request->session()->get('admin_registration_email');
            if(!$email){
                return back()->withErrors(['name' => 'Session expired. Please request a new code.'])->withInput();
            }

            if (User::where('email', $email)->where('role', 'admin')->exists()) {
                return back()->withErrors(['email' => 'An account with this email and role already exists.'])->withInput();
            }

        } else { // personnel
            $rules['email'] = ['required', 'email', Rule::unique('users', 'email')];
            $validatedData = $request->validate($rules);
        }

        $userData = [
            'name' => $validatedData['name'],
            'email' => $email ?? $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $role,
        ];

        Log::info('Creating user with data:', $userData);
        User::create($userData);

        return redirect('/login')->with('status', 'Registration successful! Please log in.');
    }

    // Improved error handling for expired session
    public function resendAdminCode(Request $request)
    {
        $adminEmail = 'reginaldtesla6@gmail.com';
        $code = random_int(100000, 999999);

        // Store the code in the session for later verification
        $request->session()->put('admin_registration_code', $code);
        $request->session()->put('admin_registration_email', $adminEmail);
        $request->session()->put('admin_code_expiry', now()->addMinutes(10));

        Mail::to($adminEmail)->send(new AdminRegistrationCodeMail($code));

        return back()->with('code_sent', 'A new verification code has been sent to the administrator.');
    }

    // Check session expiry for admin code
    private function isAdminCodeExpired(Request $request): bool
    {
        $expiry = $request->session()->get('admin_code_expiry');
        return !$expiry || now()->greaterThan($expiry);
    }

    //Handle login functionality
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required',
            'role' => 'required|in:admin,personnel',
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();

            $user = auth()->user();
            if ($user->role !== $incomingFields['role']) {
                auth()->logout();
                return redirect('/')->withErrors(['loginname' => 'You are not authorized to log in as ' . $incomingFields['role'] . '.']);
            }

            if ($incomingFields['role'] === 'admin') {
                return redirect('/dashboard');
            } elseif ($incomingFields['role'] === 'personnel') {
                return redirect('/personnel');
            }
        }

        return redirect('/')->withErrors(['loginname' => 'Invalid credentials.']);
    }
}
