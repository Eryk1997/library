<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Provider;

use App\Modules\Book\Application\Exception\NotFoundBookException;
use App\Modules\Book\Domain\Entity\Book;
use App\Modules\Book\Domain\Repositories\BookQueryRepositoryInterface;

final readonly class BookProvider
{
    public function __construct(
        private BookQueryRepositoryInterface $bookQueryRepository,
    ) {
    }

    public function loadById(string $id): Book
    {
        $book = $this->bookQueryRepository->findById($id);

        if ($book === null) {
            throw new NotFoundBookException('book.not_found');
        }

        return $book;
    }
}
