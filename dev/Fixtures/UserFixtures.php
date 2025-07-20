<?php

declare(strict_types=1);

namespace App\Dev\Fixtures;

use App\Modules\User\Domain\Entity\User;
use App\Modules\User\Domain\Enums\Type;
use App\Modules\User\Domain\ValueObject\UserId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHarsher,
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $users = $this->getUsers();

        foreach ($users as $user) {
            $password = $this->userPasswordHarsher->hashPassword($user, $user->getType()->value);
            $user->setPassword($password);

            $manager->persist($user);
        }

        $manager->flush();
    }

    /** @return User[] */
    private function getUsers(): array
    {
        return [
            new User(
                id: UserId::new()->toUuid(),
                fistName: 'eryk',
                lastName: 'janocha',
                email: 'eryk.librarian@gmail.com',
                type: Type::LIBRARIAN,
            ),
            new User(
                id: UserId::new()->toUuid(),
                fistName: 'eryk',
                lastName: 'janocha',
                email: 'eryk.member@gmail.com',
                type: Type::MEMBER,
            ),
        ];
    }
}
