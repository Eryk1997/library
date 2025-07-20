<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\Embeddable;

use App\Modules\Book\Domain\Exception\BookException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class Isbn
{
    private const MAX_LENGTH = 20;

    public function __construct(
        #[Column(type: Types::STRING, length: self::MAX_LENGTH)]
        private string $isbn,
    ) {
        if (strlen($this->isbn) > self::MAX_LENGTH) {
            throw new BookException('book.isbn.max_length', ['%max%' => self::MAX_LENGTH]);
        }
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }
}
