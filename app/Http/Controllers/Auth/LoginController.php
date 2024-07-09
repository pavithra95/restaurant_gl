<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Optionally, you can redirect the user to a different page after logout
        return redirect('/login');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate login request
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful, retrieve user's database name
            $user = Auth::user();
            $userDatabaseName = 'kggl_' . Str::slug($user->name, '_');

            // Update database connection configuration
            config(['database.connections.new_user.database' => $userDatabaseName]);

            // Use the updated database connection for subsequent queries
            DB::purge('new_user');
            DB::reconnect('new_user');

            // Optionally, redirect the user to a specific page after login
            return redirect()->intended('/home');
        }

        // Authentication failed, redirect back with error message
        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }
}
