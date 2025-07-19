<?php

declare(strict_types=1);

namespace App\Shared\Api\Model;

use App\Shared\Application\ValueObject\PaginatorVO;

readonly class PaginationModel
{
    public ?int $previousPage;
    public ?int $nextPage;

    public function __construct(
        public int $pageSize,
        public int $totalCount,
        public int $currentPage,
    ) {
        $this->previousPage = ($currentPage - 1) ?: null;
        $this->nextPage = ($currentPage * $pageSize) < $totalCount ? $currentPage + 1 : null;
    }

    public static function fromPaginatorVO(PaginatorVO $paginatorVO): self
    {
        return new self(
            pageSize: $paginatorVO->pageSize,
            totalCount: $paginatorVO->totalCount,
            currentPage: $paginatorVO->currentPage,
        );
    }
}
