<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\Embeddable;

use App\Modules\Book\Domain\Exception\BookException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class YearPublished
{
    public function __construct(
        #[Column(type: Types::INTEGER)]
        private readonly int $yearPublished,
    ) {
        $currentYear = (int) date('Y');

        if ($this->yearPublished > $currentYear) {
            throw new BookException('book.year_published.max_date');
        }
    }

    public function getYearPublished(): int
    {
        return $this->yearPublished;
    }
}
