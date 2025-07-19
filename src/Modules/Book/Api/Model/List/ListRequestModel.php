<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Model\List;

use App\Modules\Book\Application\Messenger\Queries\ListBookQuery;

readonly class ListRequestModel
{
    public function __construct(
        public ?string $title = null,
        public ?string $author = null,
        public ?int $isbn = null,
        public ?int $yearPublished = null,
        public int $currentPage = 1,
        public int $pageSize = 50,
    ) {
    }

    public function toListBookQuery(): ListBookQuery
    {
        return new ListBookQuery(
            currentPage: $this->currentPage,
            pageSize: $this->pageSize,
            title: $this->title,
            author: $this->author,
            isbn: $this->isbn,
            yearPublished: $this->yearPublished,
        );
    }
}
