<?php

declare(strict_types=1);

namespace App\Modules\User\Application\Messenger\Queries\History;

use Symfony\Component\Security\Core\User\UserInterface;

readonly class HistoryQuery
{
    public function __construct(
        public string $userId,
        public UserInterface $user,
    ) {
    }
}
