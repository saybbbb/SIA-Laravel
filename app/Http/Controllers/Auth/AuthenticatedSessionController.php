<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Attempt login via your existing authenticate() method
        $request->authenticate();

        // Get the authenticated user
        $user = Auth::user();

        // Check if user is approved
        if ($user->status !== 'approved') {
            // Logout immediately
            Auth::logout();

            // Invalidate the session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Throw validation exception with message
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Your account is pending approval by an administrator.',
            ]);
        }

        // If approved, regenerate session and continue normally
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
