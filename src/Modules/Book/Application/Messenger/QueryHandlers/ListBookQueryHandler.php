<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Messenger\QueryHandlers;

use App\Modules\Book\Application\Messenger\Queries\ListBookQuery;
use App\Modules\Book\Domain\Repositories\BookQueryRepositoryInterface;
use App\Modules\Book\Domain\ValueObject\QueryResult\ListBookQueryResultVO;
use App\Shared\Application\ValueObject\PaginatorVO;

final readonly class ListBookQueryHandler
{
    public function __construct(
        private BookQueryRepositoryInterface $bookQueryRepository,
    ) {
    }

    /** @return PaginatorVO<ListBookQueryResultVO> */
    public function __invoke(ListBookQuery $query): PaginatorVO
    {
        $paginator = $this->bookQueryRepository->findByListBookQuery($query->toListBookQueryVO());

        return new PaginatorVO(
            data: iterator_to_array($paginator),
            pageSize: $query->pageSize,
            totalCount: $paginator->count(),
            currentPage: $query->currentPage,
        );
    }
}
