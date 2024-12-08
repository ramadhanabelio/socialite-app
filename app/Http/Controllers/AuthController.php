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
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            if (!$googleUser) {
                return redirect('/')->withErrors('Tidak ada data yang diterima dari Google.');
            }

            $email = $googleUser->getEmail();
            $name = $googleUser->getName();
            $avatarUrl = $googleUser->getAvatar();
            $loginType = 'google';

            if (!$email) {
                return redirect('/')->withErrors('Email tidak ditemukan pada akun Google Anda.');
            }

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => bcrypt('password'),
                    'avatar' => $avatarUrl,
                    'login_type' => $loginType,
                ]
            );

            Auth::login($user);

            return redirect('/home');
        } catch (\Exception $e) {
            return redirect('/')->withErrors('Gagal login dengan Google: ' . $e->getMessage());
        }
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
            $loginType = 'github';

            if (!$email) {
                return redirect('/')->withErrors('Email tidak ditemukan pada akun GitHub Anda.');
            }

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => bcrypt('password'),
                    'avatar' => $avatarUrl,
                    'login_type' => $loginType,
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
