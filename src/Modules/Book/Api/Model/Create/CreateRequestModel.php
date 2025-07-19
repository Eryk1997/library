<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Model\Create;

use App\Modules\Book\Application\Messenger\Command\CreateBookCommand;
use App\Modules\Book\Domain\ValueObject\BookId;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class CreateRequestModel
{
    public function __construct(
        #[NotBlank]
        public string $title,
        #[NotBlank]
        public string $author,
        #[NotBlank]
        public string $isbn,
        #[NotBlank]
        #[GreaterThanOrEqual(1, message: 'Liczba egzemplarzy musi być co najmniej 1.')]
        public int $numberCopies,
        #[NotBlank]
        public int $yearPublished,
    ) {
    }

    public function toCreateBookCommand(BookId $bookId): CreateBookCommand
    {
        return new CreateBookCommand(
            bookId: $bookId,
            title: $this->title,
            author: $this->author,
            isbn: $this->isbn,
            numberCopies: $this->numberCopies,
            yearPublished: $this->yearPublished,
        );
    }
}
