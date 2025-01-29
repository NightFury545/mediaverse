<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\OAuth2Service;
use Exception;
use Illuminate\Http\JsonResponse;

class OAuth2Controller extends Controller
{
    protected OAuth2Service $oAuth2Service;

    public function __construct(OAuth2Service $oAuth2Service)
    {
        $this->oAuth2Service = $oAuth2Service;
    }

    /**
     * Перенаправлення на Google для авторизації.
     */
    public function redirectToGoogle()
    {
        return $this->oAuth2Service->redirectToGoogle();
    }

    /**
     * Callback після авторизації через Google.
     */
    public function handleGoogleCallback(): JsonResponse
    {
        try {
            $token = $this->oAuth2Service->handleGoogleCallback();

            return response()->json([
                'message' => 'Successfully authenticated with Google.',
                'token' => $token,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Перенаправлення на GitHub для авторизації.
     */
    public function redirectToGitHub()
    {
        return $this->oAuth2Service->redirectToGitHub();
    }

    /**
     * Callback після авторизації через GitHub.
     */
    public function handleGitHubCallback(): JsonResponse
    {
        try {
            $token = $this->oAuth2Service->handleGitHubCallback();

            return response()->json([
                'message' => 'Successfully authenticated with GitHub.',
                'token' => $token,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
