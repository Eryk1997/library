<?php

declare(strict_types=1);

namespace App\Modules\Loan\Domain\ValueObject\QueryResult;

use App\Modules\Loan\Domain\Enums\Status;

readonly class UserHistoryResult
{
    public function __construct(
        public string $bookTitle,
        public string $bookAuthor,
        public string $isbn,
        public string $yearPublished,
        public Status $status,
        public \DateTimeImmutable $rentalDate,
        public ?\DateTimeImmutable $returnDate = null,
    ) {
    }
}
