<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Messenger\Queries;

readonly class DetailBookQuery
{
    public function __construct(
        public string $id,
    ) {
    }
}
