<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\Repositories;

use App\Modules\Book\Domain\Entity\Book;
use App\Modules\Book\Domain\ValueObject\Query\ListBookQueryVO;
use App\Modules\Book\Domain\ValueObject\QueryResult\ListBookQueryResultVO;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface BookQueryRepositoryInterface
{
    /** @return Paginator<ListBookQueryResultVO> */
    public function findByListBookQuery(ListBookQueryVO $query): Paginator;

    public function findById(string $id): ?Book;

    public function findByTitle(string $title): ?Book;
}
