<?php

namespace App\Services\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OAuth2Service
{
    public function __construct(private JWTService $jwtService)
    {
    }

    /**
     * Redirect на Google для авторизації.
     */
    public function redirectToGoogle(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback після авторизації через Google.
     *
     * @throws Exception
     */
    public function handleGoogleCallback(): array
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Exception $e) {
            throw new Exception(__('auth.google_data_failed'));
        }

        $user = $this->findOrCreateUser($googleUser, 'google');

        $accessToken = $this->jwtService->createToken($user);

        $refreshToken = $this->jwtService->createRefreshToken($user);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }

    /**
     * Redirect на GitHub для авторизації.
     */
    public function redirectToGitHub(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Callback після авторизації через GitHub.
     *
     * @throws Exception
     */
    public function handleGitHubCallback(): array
    {
        try {
            $gitHubUser = Socialite::driver('github')->user();
        } catch (Exception $e) {
            throw new Exception(__('auth.github_data_failed'));
        }

        $user = $this->findOrCreateUser($gitHubUser, 'github');

        $accessToken = $this->jwtService->createToken($user);

        $refreshToken = $this->jwtService->createRefreshToken($user);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }

    /**
     * Знайти або створити користувача в базі даних.
     */
    private function findOrCreateUser($socialUser, $provider): User
    {
        $user = User::where($provider . '_id', $socialUser->getId())->first();

        if (!$user) {
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                $user->update([
                    $provider . '_id' => $socialUser->getId(),
                ]);
            } else {
                $user = User::create([
                    'username' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'avatar' => $socialUser->getAvatar() ?? asset('storage/avatars/default-avatar.png'),
                    $provider . '_id' => $socialUser->getId(),
                    'password' => bcrypt(Str::random(16)),
                ]);
            }
        }

        return $user;
    }
}
