<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\ValueObject\QueryResult;

readonly class ListBookQueryResultVO
{
    public function __construct(
        public string $title,
        public string $author,
        public int $isbn,
        public int $yearPublished,
    ) {
    }
}
