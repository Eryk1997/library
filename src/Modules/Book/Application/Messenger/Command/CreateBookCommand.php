<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Messenger\Command;

use App\Modules\Book\Domain\ValueObject\BookId;
use App\Shared\Infrastructure\Messenger\CommandBus\Command;

class CreateBookCommand implements Command
{
    public function __construct(
        public BookId $bookId,
        public string $title,
        public string $author,
        public string $isbn,
        public int $numberCopies,
        public int $yearPublished,
    ) {
    }
}
