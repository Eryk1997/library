<?php

declare(strict_types=1);

namespace App\Modules\Loan\Domain\ValueObject\Query;

readonly class UserHistoryQuery
{
    public function __construct(
        public string $userId,
    ) {
    }
}
