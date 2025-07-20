<?php

declare(strict_types=1);

namespace App\Dev\Fixtures;

use App\Modules\Book\Domain\Embeddable\Author;
use App\Modules\Book\Domain\Embeddable\Isbn;
use App\Modules\Book\Domain\Embeddable\NumberCopies;
use App\Modules\Book\Domain\Embeddable\Title;
use App\Modules\Book\Domain\Embeddable\YearPublished;
use App\Modules\Book\Domain\Entity\Book;
use App\Modules\Book\Domain\ValueObject\BookId;
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
                id: BookId::new()->toUuid(),
                title: new Title($faker->sentence(3)) ,
                author: new Author($faker->sentence(3))  ,
                isbn: new Isbn($faker->isbn13()) ,
                numberCopies: new NumberCopies($faker->numberBetween(1,15)) ,
                yearPublished: new YearPublished($faker->numberBetween(1950, 2024)) ,
            );

            $manager->persist($book);
        }

        $manager->flush();
    }
}
