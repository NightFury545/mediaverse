<?php

namespace App\Services\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(private JWTService $jwtService)
    {
    }

    /**
     * Логіка для реєстрації користувача та створення токена.
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @return array
     * @throws Exception
     */
    public function register(string $username, string $email, string $password): array
    {
        $user = new User([
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        if (!$user->save()) {
            throw new Exception(__('auth.user_save_failed'));
        }

        $user->sendEmailVerificationNotification();

        $accessToken = $this->jwtService->createToken($user);

        $refreshToken = $this->jwtService->createRefreshToken($user);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }

    /**
     * Логіка для входу користувача та створення токена.
     *
     * @param string $email
     * @param string $password
     * @return array
     * @throws Exception
     */
    public function login(string $email, string $password): array
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new Exception(__('auth.invalid_login'));
        }

        $accessToken = $this->jwtService->createToken($user);

        $refreshToken = $this->jwtService->createRefreshToken($user);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }

    /**
     * @throws Exception
     */
    public function logout(): bool
    {
        return $this->jwtService->logout();
    }

    /**
     * Оновлення JWT токена.
     *
     * @param string $token
     * @return string
     * @throws Exception
     */
    public function refreshToken(string $token): string
    {
        return $this->jwtService->refreshToken($token);
    }
}
