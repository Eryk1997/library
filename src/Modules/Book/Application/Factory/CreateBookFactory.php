<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Factory;

use App\Modules\Book\Application\Messenger\Command\CreateBookCommand;
use App\Modules\Book\Domain\Embeddable\Author;
use App\Modules\Book\Domain\Embeddable\Isbn;
use App\Modules\Book\Domain\Embeddable\NumberCopies;
use App\Modules\Book\Domain\Embeddable\Title;
use App\Modules\Book\Domain\Embeddable\YearPublished;
use App\Modules\Book\Domain\Entity\Book;

class CreateBookFactory
{
    public function createByCreateBookCommand(CreateBookCommand $createBookCommand): Book
    {
        return new Book(
            id: $createBookCommand->bookId->toUuid(),
            title: new Title($createBookCommand->title),
            author: new Author($createBookCommand->author),
            isbn: new Isbn($createBookCommand->isbn),
            numberCopies: new NumberCopies($createBookCommand->numberCopies),
            yearPublished: new YearPublished($createBookCommand->yearPublished),
        );
    }
}
