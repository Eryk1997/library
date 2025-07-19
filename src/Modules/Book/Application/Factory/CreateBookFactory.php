<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Factory;

use App\Modules\Book\Application\Messenger\Command\CreateBookCommand;
use App\Modules\Book\Domain\Entity\Book;

class CreateBookFactory
{
    public function createByCreateBookCommand(CreateBookCommand $createBookCommand): Book
    {
        return new Book(
            id: $createBookCommand->bookId->toUuid(),
            title: $createBookCommand->title,
            author: $createBookCommand->author,
            isbn: $createBookCommand->isbn,
            numberCopies: $createBookCommand->numberCopies,
            yearPublished: $createBookCommand->yearPublished,
        );
    }
}
