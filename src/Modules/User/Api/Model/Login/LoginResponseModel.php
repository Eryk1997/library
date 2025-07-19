<?php

declare(strict_types=1);

namespace App\Modules\User\Api\Model\Login;

use App\Modules\User\Application\Messenger\QueryResult\Login\LoginQueryResult;

final readonly class LoginResponseModel
{
    public function __construct(
        public string $token,
        public string $email,
    ) {
    }

    public static function fromQueryResult(LoginQueryResult $result): self
    {
        return new self(
            token: $result->token,
            email: $result->email,
        );
    }
}
