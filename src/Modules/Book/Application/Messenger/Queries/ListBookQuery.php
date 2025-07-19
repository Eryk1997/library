<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Messenger\Queries;

use App\Modules\Book\Domain\ValueObject\Query\ListBookQueryVO;

final readonly class ListBookQuery
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

    public function toListBookQueryVO(): ListBookQueryVO
    {
        return new ListBookQueryVO(
            currentPage: $this->currentPage,
            pageSize: $this->pageSize,
            title: $this->title,
            author: $this->author,
            isbn: $this->isbn,
            yearPublished: $this->yearPublished,
        );
    }
}
