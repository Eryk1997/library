<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\ValueObject\Query;

final readonly class ListBookQueryVO
{
    public function __construct(
        public int $currentPage,
        public int $pageSize,
        public ?string $title = null,
        public ?string $author = null,
        public ?int $isbn = null,
        public ?int $yearPublished = null,
    ) {
    }
}
