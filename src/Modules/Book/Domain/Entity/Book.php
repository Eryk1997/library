<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\Entity;

use App\Modules\Book\Domain\Embeddable\Author;
use App\Modules\Book\Domain\Embeddable\Isbn;
use App\Modules\Book\Domain\Embeddable\NumberCopies;
use App\Modules\Book\Domain\Embeddable\Title;
use App\Modules\Book\Domain\Embeddable\YearPublished;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
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
        #[Embedded(class: Title::class, columnPrefix: false)]
        private Title $title,
        #[Embedded(class: Author::class, columnPrefix: false)]
        private Author $author,
        #[Embedded(class: Isbn::class, columnPrefix: false)]
        private Isbn $isbn,
        #[Embedded(class: NumberCopies::class, columnPrefix: false)]
        private NumberCopies $numberCopies,
        #[Embedded(class: YearPublished::class, columnPrefix: false)]
        private readonly YearPublished $yearPublished,
    ) {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title->getTitle();
    }

    public function getAuthor(): string
    {
        return $this->author->getAuthor();
    }

    public function getIsbn(): string
    {
        return $this->isbn->getIsbn();
    }

    public function getYearPublished(): int
    {
        return $this->yearPublished->getYearPublished();
    }

    public function getNumberCopies(): int
    {
        return $this->numberCopies->getNumberCopies();
    }
}
