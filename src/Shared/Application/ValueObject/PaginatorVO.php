<?php

declare(strict_types=1);

namespace App\Shared\Application\ValueObject;

/** @template T */
class PaginatorVO
{
    /** @param T[] $data */
    public function __construct(
        public array $data,
        public int $pageSize,
        public int $totalCount,
        public int $currentPage,
    ) {
    }
}
