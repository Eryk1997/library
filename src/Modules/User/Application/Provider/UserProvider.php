<?php

declare(strict_types=1);

namespace App\Modules\User\Application\Provider;

use App\Modules\User\Application\Exception\NotFoundUserException;
use App\Modules\User\Domain\Entity\User;
use App\Modules\User\Domain\Repositories\UserQueryRepositoryInterface;

final readonly class UserProvider
{
    public function __construct(
        private UserQueryRepositoryInterface $userQueryRepository,
    )
    {
    }

    public function findByEmail(string $email): User
    {
        $user = $this->userQueryRepository->findOneByEmail($email);

        if (!$user) {
            throw new NotFoundUserException('user.not_found');
        }

        return $user;
    }
}
