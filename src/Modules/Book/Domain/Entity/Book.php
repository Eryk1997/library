<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'books')]
#[HasLifecycleCallbacks]
class Book
{
    public function __construct(
        #[Id]
        #[Column(type: UuidType::NAME, unique: true)]
        private Uuid $id,
        #[Column(type: Types::STRING, length: 255)]
        private string $title,
        #[Column(type: Types::STRING, length: 255)]
        private string $author,
        #[Column(type: Types::STRING, length: 20)]
        private string $isbn,
        #[Column(type: Types::INTEGER)]
        private int $numberCopies,
        #[Column(type: Types::INTEGER)]
        private readonly int $yearPublished,
    )
    {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getYearPublished(): int
    {
        return $this->yearPublished;
    }

    public function getNumberCopies(): int
    {
        return $this->numberCopies;
    }
}
