<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt('password'),
            ]
        );

        Auth::login($user);

        return redirect('/home');
    }

    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();

            if (!$githubUser) {
                return redirect('/')->withErrors('Tidak ada data yang diterima dari GitHub.');
            }

            $email = $githubUser->getEmail();
            $name = $githubUser->getName() ?? $githubUser->getNickname();
            $avatarUrl = $githubUser->getAvatar();

            if (!$email) {
                return redirect('/')->withErrors('Email tidak ditemukan pada akun GitHub Anda.');
            }

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => bcrypt('password'),
                    'avatar' => $avatarUrl,
                ]
            );

            Auth::login($user);

            return redirect('/home');
        } catch (\Exception $e) {
            return redirect('/')->withErrors('Gagal login dengan GitHub: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
