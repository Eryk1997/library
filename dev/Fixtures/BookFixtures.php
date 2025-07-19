<?php

declare(strict_types=1);

namespace App\Dev\Fixtures;

use App\Modules\Book\Domain\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Uid\Uuid;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $book = new Book(
                id: Uuid::v7(),
                title: $faker->sentence(3),
                author: $faker->sentence(3),
                isbn: $faker->isbn13(),
                numberCopies: $faker->numberBetween(1,15),
                yearPublished: $faker->numberBetween(1950, 2024),
            );

            $manager->persist($book);
        }

        $manager->flush();
    }
}
