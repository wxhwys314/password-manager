<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public $redirectTo = '/';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function validateLogin(Request $request)
    {
        $request->validate([
            'password' => [
                'required', 'string', 'max:50',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);
    }

    public function attemptLogin(Request $request)
    {        
        $user = User::first();

        // check password
        if (\Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('login');
        } else {
            throw ValidationException::withMessages([
                'password' => ['Het wachtwoord is niet correct.'],
            ]);
        }
    }
}
