<?php

declare(strict_types=1);

namespace App\Modules\User\Application\Messenger\QueryHandlers;

use App\Modules\User\Application\Exception\UserInvalidCredential;
use App\Modules\User\Application\Messenger\Queries\Login\LoginQuery;
use App\Modules\User\Application\Messenger\QueryResult\Login\LoginQueryResult;
use App\Modules\User\Application\Provider\UserProvider;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class LoginQueryHandler
{
    public function __construct(
        private UserProvider $userProvider,
        private UserPasswordHasherInterface $passwordHasher,
        private JWTTokenManagerInterface $jwtManager,
    ) {
    }

    public function __invoke(LoginQuery $query): LoginQueryResult
    {
        $user = $this->userProvider->findByEmail($query->email);

        if (!$this->passwordHasher->isPasswordValid($user, $query->password)) {
            throw new UserInvalidCredential('user.invalid_credentials');
        }

        $token = $this->jwtManager->create($user);

        return new LoginQueryResult(
            token: $token,
            email: $query->email,
        );
    }
}
