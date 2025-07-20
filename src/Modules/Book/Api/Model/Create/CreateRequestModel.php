<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Model\Create;

use App\Modules\Book\Api\Validator\Constraint\UniqueBookTitle;
use App\Modules\Book\Application\Messenger\Command\CreateBookCommand;
use App\Modules\Book\Domain\ValueObject\BookId;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class CreateRequestModel
{
    public function __construct(
        #[NotBlank]
        #[UniqueBookTitle]
        #[Length(max: 255)]
        public string $title,
        #[NotBlank]
        #[Length(max: 255)]
        public string $author,
        #[NotBlank]
        #[Length(max: 20)]
        public string $isbn,
        #[NotBlank]
        #[GreaterThanOrEqual(1)]
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
