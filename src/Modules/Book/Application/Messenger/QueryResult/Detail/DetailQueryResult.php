<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Messenger\QueryResult\Detail;

use App\Modules\Book\Domain\Entity\Book;

readonly class DetailQueryResult
{
    public function __construct(
        public string $title,
        public string $author,
        public string $isbn,
        public int $numberCopies,
        public int $yearPublished,
    ) {
    }

    public static function fromBook(Book $book): self
    {
        return new self(
            title: $book->getTitle(),
            author: $book->getAuthor(),
            isbn: $book->getIsbn(),
            numberCopies: $book->getNumberCopies(),
            yearPublished: $book->getYearPublished(),
        );
    }
}
