<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\AdminRegistrationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'You have been logged out.');
    }

    public function sendAdminCode(Request $request)
    {
        return $this->issueAdminRegistrationCode($request, redirect('/register'));
    }

    public function register(Request $request)
    {
        $role = $request->input('role', 'personnel');
        $rules = [
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'password' => ['required', 'string', 'min:3', 'max:50', 'confirmed'],
        ];
        $validatedData = [];
        $email = null;

        if ($role === 'admin') {
            $codeStatus = $this->adminCodeSessionStatus($request);

            if ($codeStatus === 'missing') {
                return back()
                    ->withErrors(['code' => 'Please click "Send verification code" before signing up as admin.'])
                    ->withInput();
            }

            if ($codeStatus === 'expired') {
                return back()
                    ->withErrors(['code' => 'The verification code has expired. Please request a new code.'])
                    ->withInput();
            }

            $rules['email'] = ['required', 'email', Rule::unique('users', 'email')];
            $rules['code'] = ['required', function ($attribute, $value, $fail) use ($request) {
                $sessionCode = $request->session()->get('admin_registration_code');
                if (! $sessionCode || $value != $sessionCode) {
                    $fail('The provided code is incorrect.');
                }
            }];

            $validatedData = $request->validate($rules);
            $email = $validatedData['email'];
        } else {
            $rules['email'] = ['required', 'email', Rule::unique('users', 'email')];
            $validatedData = $request->validate($rules);
            $email = $validatedData['email'];
        }

        $userData = [
            'name' => $validatedData['name'],
            'email' => $email,
            'password' => bcrypt($validatedData['password']),
            'role' => $role,
        ];

        Log::info('Creating user with data:', $userData);
        User::create($userData);

        if ($role === 'admin') {
            $request->session()->forget([
                'admin_registration_code',
                'admin_code_expiry',
            ]);
        }

        return redirect('/login')->with('status', 'Registration successful! Please log in.');
    }

    public function resendAdminCode(Request $request)
    {
        return $this->issueAdminRegistrationCode($request, back());
    }

    private function issueAdminRegistrationCode(Request $request, $redirectResponse)
    {
        $adminEmail = config('mail.admin_registration_email');
        $code = random_int(100000, 999999);

        $request->session()->put('admin_registration_code', $code);
        $request->session()->put('admin_code_expiry', now()->addMinutes(10));

        try {
            Mail::to($adminEmail)->send(new AdminRegistrationCodeMail($code));
        } catch (\Exception $e) {
            Log::error('Admin registration code email failed', [
                'email' => $adminEmail,
                'error' => $e->getMessage(),
            ]);

            return $redirectResponse->withErrors([
                'code' => 'Could not send the verification email. Check mail settings in .env or ask your administrator.',
            ]);
        }

        $message = 'A verification code was sent to '.$adminEmail.'. Check that inbox (including spam).';

        $response = $redirectResponse->with('code_sent', $message);

        if (config('mail.default') === 'log' && config('app.debug')) {
            $response = $response->with(
                'dev_admin_code',
                'Mail is set to "log" — no real email was sent. Your code for testing: '.$code
            );
        }

        return $response;
    }

    private function adminCodeSessionStatus(Request $request): string
    {
        if (! $request->session()->has('admin_registration_code')) {
            return 'missing';
        }

        if ($this->isAdminCodeExpired($request)) {
            return 'expired';
        }

        return 'valid';
    }

    private function isAdminCodeExpired(Request $request): bool
    {
        $expiry = $request->session()->get('admin_code_expiry');

        return ! $expiry || now()->greaterThan($expiry);
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();

            $user = auth()->user();

            if ($user->role === 'admin') {
                return redirect('/dashboard');
            }

            return redirect('/personnelsdashboard');
        }

        return redirect('/')->withErrors(['loginname' => 'Invalid credentials.']);
    }
}
