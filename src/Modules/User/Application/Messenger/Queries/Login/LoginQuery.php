<?php

declare(strict_types=1);

namespace App\Modules\User\Application\Messenger\Queries\Login;

final readonly class LoginQuery
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
