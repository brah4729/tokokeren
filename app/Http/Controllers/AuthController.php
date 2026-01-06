<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if email is verified
            if (!$user->hasVerifiedEmail()) {
                // Send new verification code
                $this->sendVerificationCode($user);
                return redirect()->route('verification.notice')
                    ->with('info', 'Please verify your email first.');
            }

            return redirect()->intended('/')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ])->onlyInput('name');
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        // Send verification code
        $this->sendVerificationCode($user);

        return redirect()->route('verification.notice')
            ->with('success', 'Registration successful! Please check your email for the verification code.');
    }

    /**
     * Show the email verification form.
     */
    public function showVerifyForm()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect('/')->with('info', 'Your email is already verified.');
        }

        return view('auth.verify');
    }

    /**
     * Handle verification code submission.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $user = Auth::user();

        // Find valid verification code
        $verificationCode = $user->verificationCodes()
            ->where('code', $request->code)
            ->valid()
            ->latest()
            ->first();

        if (!$verificationCode) {
            return back()->withErrors([
                'code' => 'Invalid or expired verification code.',
            ]);
        }

        // Mark email as verified
        $user->markEmailAsVerified();

        // Delete all verification codes for this user
        $user->verificationCodes()->delete();

        return redirect('/')->with('success', 'Email verified successfully! Welcome to Toko Keren!');
    }

    /**
     * Resend verification code.
     */
    public function resendCode(Request $request)
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('info', 'Your email is already verified.');
        }

        $this->sendVerificationCode($user);

        return back()->with('success', 'A new verification code has been sent to your email.');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }

    /**
     * Send a verification code to the user.
     */
    private function sendVerificationCode(User $user): void
    {
        // Delete old verification codes
        $user->verificationCodes()->delete();

        // Create new verification code
        $code = VerificationCode::generateCode();
        $user->verificationCodes()->create([
            'code' => $code,
            'expires_at' => now()->addMinutes(15),
        ]);

        // Send email
        Mail::to($user->email)->send(new VerificationCodeMail($code, $user->name));
    }
}
