<?php

declare(strict_types=1);

namespace App\Modules\User\Api\Model\History;

use App\Modules\Loan\Domain\ValueObject\QueryResult\UserHistoryResult;

readonly class HistoryResponseModel
{
    public function __construct(
        public string $bookTitle,
        public string $bookAuthor,
        public string $isbn,
        public string $yearPublished,
        public string $status,
        public \DateTimeImmutable $rentalDate,
        public ?\DateTimeImmutable $returnDate = null,
    ) {
    }

    public static function fromUserHistoryResult(UserHistoryResult $result): HistoryResponseModel
    {
        return new self(
            bookTitle: $result->bookTitle,
            bookAuthor: $result->bookAuthor,
            isbn: $result->isbn,
            yearPublished: $result->yearPublished,
            status: $result->status->value,
            rentalDate: $result->rentalDate,
            returnDate: $result->returnDate,
        );
    }

    /**
     * @param UserHistoryResult[] $results
     *
     * @return self[]
     */
    public static function multiple(array $results): array
    {
        return array_map(self::fromUserHistoryResult(...), $results);
    }
}
