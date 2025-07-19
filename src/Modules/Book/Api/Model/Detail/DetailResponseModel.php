<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Model\Detail;

use App\Modules\Book\Application\Messenger\QueryResult\Detail\DetailQueryResult;

final readonly class DetailResponseModel
{
    public function __construct(
        public string $title,
        public string $author,
        public string $isbn,
        public int $numberCopies,
        public int $yearPublished,
    ) {
    }

    public static function fromDetailQueryResult(DetailQueryResult $queryResult): self
    {
        return new self(
            title: $queryResult->title,
            author: $queryResult->author,
            isbn: $queryResult->isbn,
            numberCopies: $queryResult->numberCopies,
            yearPublished: $queryResult->yearPublished,
        );
    }
}
