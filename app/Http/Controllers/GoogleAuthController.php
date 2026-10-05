<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
public function redirect()
{
    return Socialite::driver('google')
        ->redirectUrl(config('services.google_login.redirect'))
        ->scopes([
            'openid',
            'profile',
            'email',
        ])
        ->redirect();
}
public function callback()
{
    $googleUser = Socialite::driver('google')
        ->redirectUrl(config('services.google_login.redirect'))
        ->user();

    $user = \App\Models\User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        return redirect()
            ->route('admin.login')
            ->withErrors([
                'email' => 'This Google account is not authorized.',
            ]);
    }

    Auth::login($user);

    request()->session()->regenerate();

    return redirect()->route('admin.employees.index');
}
}
