<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Paginator;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

final readonly class PaginatorFactory
{
    /** @return Paginator<mixed> */
    public static function createScalarFromQuery(Query $query, int $page, int $limit): Paginator
    {
        $query->setFirstResult(($page - 1) * $limit);
        $query->setMaxResults($limit);

        return (new Paginator($query))->setUseOutputWalkers(false);
    }
}
