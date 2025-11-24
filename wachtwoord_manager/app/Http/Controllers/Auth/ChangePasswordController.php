<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required', 'string', 'max:50',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'new_password' => [
                'required', 'string', 'max:50',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('changePassword.index')->withErrors(['current_password' => 'Het wachtwoord is niet correct.']);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('changePassword.index')->with('success', 'Wachtwoord succesvol gewijzigd.');
        }

        
    }
}