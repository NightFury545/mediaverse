<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\OAuth2Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OAuth2Controller extends Controller
{
    public function __construct(protected OAuth2Service $oAuth2Service)
    {
    }

    /**
     * Перенаправлення на Google для авторизації.
     */
    public function redirectToGoogle(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return $this->oAuth2Service->redirectToGoogle();
    }

    /**
     * Callback після авторизації через Google.
     */
    public function handleGoogleCallback(): JsonResponse
    {
        try {
            $tokens = $this->oAuth2Service->handleGoogleCallback();

            return response()->json([
                'message' => 'Successfully authenticated with Google.',
                'access_token' => $tokens['access_token'],
            ])->cookie('refresh_token', $tokens['refresh_token'], 20160, null, null, false, true);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Перенаправлення на GitHub для авторизації.
     */
    public function redirectToGitHub(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return $this->oAuth2Service->redirectToGitHub();
    }

    /**
     * Callback після авторизації через GitHub.
     */
    public function handleGitHubCallback(): JsonResponse
    {
        try {
            $tokens = $this->oAuth2Service->handleGitHubCallback();

            return response()->json([
                'message' => 'Successfully authenticated with GitHub.',
                'access_token' => $tokens['access_token'],
            ])->cookie('refresh_token', $tokens['refresh_token'], 20160, null, null, false, true);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
