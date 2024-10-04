<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Corcel\Laravel\Auth\AuthUserProvider;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_email' => ['required', 'email'],
            'user_pass' => ['required'],
        ]);
        if (Auth::attempt(['email' => $credentials['user_email'], 'password' => $credentials['user_pass']])) {
            return redirect()->intended('home');
        } else {
            return back()->withErrors(['user_email' => 'Invalid credentials']);
        }

    //     $user = WordpressUser::where('user_email', $credentials['user_email'])->first();

    //     if ($user) {
    //         $authUserProvider = new AuthUserProvider();
    //         if ($authUserProvider->validateCredentials($user, $credentials)) {
    //             Auth::login($user, true);
    //             return redirect()->intended('home');
    //         }
    //     }

    // return back()->withErrors([
    //     'user_email' => 'The provided credentials do not match our records.',
    // ]);
    }
    

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'user_login' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users',
            'user_pass' => 'required|string|min:8',
        ]);

        DB::table('users')->insert([
            'user_login' => $request->user_login,
            'user_nicename' => $request->user_login,
            'user_pass' => Hash::make($request->user_pass),
            'user_email' => $request->user_email,
            'display_name' => $request->user_login,
            'user_registered'=> now()->format('Y-m-d H:i:s')
        ]);

        return redirect('/login');
    }

    // Show the password reset request form
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Handle sending password reset link
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['user_email' => 'required|email']);

        $status = Password::sendResetLink($request->only('user_email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['user_email' => __($status)]);
    }

    // Show the password reset form
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    // Handle password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'user_email' => 'required|email',
            'user_pass' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('user_email', 'user_pass', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['user_email' => [__($status)]]);
    }
}
