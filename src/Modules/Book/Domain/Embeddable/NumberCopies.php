<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\Embeddable;

use App\Modules\Book\Domain\Exception\BookException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class NumberCopies
{
    private const MIN = 1;

    public function __construct(
        #[Column(type: Types::INTEGER)]
        private int $numberCopies,
    ) {
        if ($this->numberCopies < self::MIN) {
            throw new BookException('book.number_copies.min', ['%min%' => self::MIN]);
        }
    }

    public function getNumberCopies(): int
    {
        return $this->numberCopies;
    }
}
