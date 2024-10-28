<?php

namespace Modules\Auth\Services;

use Exception;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Modules\Auth\DTO\AuthDataDTO;
use Modules\Core\Services\BaseServiceWithValidator;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Repositories\BaseAuthenticatableRepositoryInterface;
use Throwable;

abstract class AuthService extends BaseServiceWithValidator
{
    protected Client $oAuthClient;

    public function __construct(
        protected BaseAuthenticatableRepositoryInterface $authenticatableRepository,
        protected PassportService                        $passportService,
    )
    {
        parent::__construct();
    }

    /**
     * @throws Throwable
     */
    public function authenticate(string $email, string $password, bool $rememberMe = false): AuthDataDTO
    {
        $user = $this->authenticatableRepository->findByEmail($email);

        if (!$user) {
            $this->addError('email', trans('exceptions.user_email_not_exists'));
        }

        if ($user && !Hash::check($password, $user->password)) {
            $this->addError('email', trans('exceptions.exceptions.password_wrong'));
        }

        $this->checkValidator();

        $this->setTokenTTL($rememberMe);

        return $this->passportService->auth(
            $email,
            $password,
            $this->getClientId(),
            $this->getClientSecret(),
        );
    }

    /**
     * @throws Throwable
     */
    public function refreshToken(string $refreshToken): AuthDataDTO
    {
        return $this->passportService->refreshToken(
            $refreshToken,
            $this->getClientId(),
            $this->getClientSecret()
        );
    }

    public function logout(BaseAuthenticatableUser $user): ?bool
    {
        /** @var Token $token */
        $token = $user->token();

        RefreshToken::query()
            ->where('access_token_id', $token->id)
            ->delete();

        return $token->delete();
    }

    protected function setTokenTTL(bool $rememberMe = false): void
    {
        if ($rememberMe) {
            Passport::refreshTokensExpireIn(now()->addDays(30));
        } else {
            Passport::refreshTokensExpireIn(now()->addHour());
        }
    }

    /**
     * @throws Exception
     */
    protected function getOAuthClient(): Client
    {
        if (empty($this->oAuthClient)) {
            $this->oAuthClient = Client::where('name', get_class($this->authenticatableRepository->getModel()))->first();
        }

        if (empty($this->oAuthClient)) {
            throw new Exception('OAuth client not found');
        }

        return $this->oAuthClient;
    }

    /**
     * @throws Exception
     */
    protected function getClientId(): int
    {
        return $this->getOAuthClient()->id;
    }

    /**
     * @throws Exception
     */
    protected function getClientSecret(): string
    {
        return $this->getOAuthClient()->secret;
    }
}
