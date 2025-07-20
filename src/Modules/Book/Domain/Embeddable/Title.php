<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\Embeddable;

use App\Modules\Book\Domain\Exception\BookException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class Title
{
    private const MAX_LENGTH = 255;

    public function __construct(
        #[Column(type: Types::STRING, length: self::MAX_LENGTH, unique: true)]
        private string $title,
    ) {
        if (strlen($this->title) > self::MAX_LENGTH) {
            throw new BookException('book.title.max_length', ['%max%' => self::MAX_LENGTH]);
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
