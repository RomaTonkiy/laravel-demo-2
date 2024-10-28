<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Log;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Modules\Auth\DTO\AuthDataDTO;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class PassportService
{
    public function __construct(
        private AccessTokenController $tokenController
    ) {
    }

    /**
     * @throws Throwable
     */
    public function auth(string $email, string $password, int $clientId, string $clientSecret): AuthDataDTO
    {
        try {
            return $this->issueToken(
                [
                    'username' => $email,
                    'password' => $password,
                    'grant_type' => 'password',
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                ]
            );
        } catch (Throwable $exception) {
            Log::error($exception->getMessage());

            throw $exception;
        }
    }

    /**
     * @throws Throwable
     */
    protected function issueToken(array $parameters): AuthDataDTO
    {
        try {
            $response = $this->tokenController->issueToken(
                resolve(ServerRequestInterface::class)->withParsedBody($parameters)
            );

            return $this->transform($response->getContent());
        } catch (Throwable $exception) {
            Log::error($exception);
            throw $exception;
        }
    }

    private function transform(string $data): AuthDataDTO
    {
        $decoded = json_decode($data, true);

        return AuthDataDTO::from([
            'tokenType' => $decoded['token_type'],
            'expiresIn' => $decoded['expires_in'],
            'accessToken' => $decoded['access_token'],
            'refreshToken' => $decoded['refresh_token'],
        ]);
    }

    /**
     * @throws Throwable
     */
    public function refreshToken(string $refreshToken, int $clientId, string $clientSecret): AuthDataDTO
    {
        try {
            return $this->issueToken(
                [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                ]
            );
        } catch (Throwable $exception) {
            Log::error($exception->getMessage());
            throw $exception;
        }
    }
}
