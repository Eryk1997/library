<?php

declare(strict_types=1);

namespace App\Modules\Loan\Domain\Entity;

use App\Modules\Book\Domain\Entity\Book;
use App\Modules\Loan\Domain\Enums\Status;
use App\Modules\User\Domain\Entity\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'loans')]
#[HasLifecycleCallbacks]
class Loan
{
    #[Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $returnDate = null;

    public function __construct(
        #[Id]
        #[Column(type: UuidType::NAME, unique: true)]
        private Uuid $id,
        #[ManyToOne(targetEntity: Book::class)]
        private Book $book,
        #[ManyToOne(targetEntity: User::class)]
        private User $user,
        #[Column(type: Types::DATETIME_IMMUTABLE)]
        private \DateTimeImmutable $rentalDate,
        #[Column(type: Types::STRING, enumType: Status::class)]
        private Status $status,
    ) {
    }

    public function getReturnDate(): ?\DateTimeImmutable
    {
        return $this->returnDate;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getBook(): Book
    {
        return $this->book;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getRentalDate(): \DateTimeImmutable
    {
        return $this->rentalDate;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
