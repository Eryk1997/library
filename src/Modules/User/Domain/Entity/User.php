<?php

declare(strict_types=1);

namespace App\Modules\User\Domain\Entity;

use App\Modules\User\Domain\Enums\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'users')]
#[HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Column(type: Types::STRING, length: 255)]
    private string $password;

    public function __construct(
        #[Id]
        #[Column(type: 'uuid_mariadb', unique: true)]
        private Uuid $id,
        #[Column(type: Types::STRING, length: 255)]
        private string $fistName,
        #[Column(type: Types::STRING, length: 255)]
        private string $lastName,
        #[Column(type: Types::STRING, length: 180, unique: true)]
        private string $email,
        #[Column(type: Types::STRING, enumType: Type::class)]
        private Type $type,
    ) {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getFistName(): string
    {
        return $this->fistName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRoles(): array
    {
        return match ($this->type) {
            Type::LIBRARIAN => ['ROLE_LIBRARIAN'],
            Type::MEMBER => ['ROLE_MEMBER'],
        };
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function isMember(): bool
    {
        return $this->type === Type::MEMBER;
    }
}
