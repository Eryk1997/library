<?php

declare(strict_types=1);

namespace App\Modules\User\Application\Validator;

use App\Modules\User\Application\Exception\UserException;
use App\Modules\User\Domain\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class CheckHistoryAccess
{
    /** @param User $user */
    public static function byUserIdAndUser(string $userId, UserInterface $user): void
    {
        if ($userId !== $user->getId()->toRfc4122() && $user->isMember()) {
            throw new UserException('user.history.access_failed');
        }
    }
}
