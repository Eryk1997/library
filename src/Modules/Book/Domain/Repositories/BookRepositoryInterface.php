<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\Repositories;

use App\Modules\Book\Domain\Entity\Book;

interface BookRepositoryInterface
{
    public function save(Book $book): void;
}
