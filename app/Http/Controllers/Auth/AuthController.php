<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    /**
     * Реєстрація нового користувача.
     *
     * @param RegisterRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function register(RegisterRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $validatedData = $request->validated();

            $tokens = $this->authService->register(
                $validatedData['username'],
                $validatedData['email'],
                $validatedData['password']
            );

            return response()->json([
                'message' => __('auth.register_success'),
                'access_token' => $tokens['access_token'],
                'refresh_token' => $tokens['refresh_token'],
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    /**
     * Логін користувача.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $tokens = $this->authService->login(
                $validatedData['email'],
                $validatedData['password']
            );

            return response()->json([
                'message' => __('auth.login_success'),
                'access_token' => $tokens['access_token'],
                'refresh_token' => $tokens['refresh_token'],
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    /**
     * Логаут користувача.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            $this->authService->logout();

            return response()->json(['message' => __('auth.logout_success')]);
        } catch (Exception $e) {
            return response()->json(['error' => __('auth.logout_failed') . ': ' . $e->getMessage()], 400);
        }
    }

    /**
     * Оновлення JWT токена
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function refreshToken(Request $request): JsonResponse
    {
        try {
            $token = $request->bearerToken();

            if (!$token) {
                return response()->json(['error' => __('auth.token_required')], 400);
            }

            $newToken = $this->authService->refreshToken($token);

            return response()->json([
                'token' => $newToken,
                'message' => __('auth.token_refreshed')
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
