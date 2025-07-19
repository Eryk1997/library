<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Messenger\QueryHandlers;

use App\Modules\Book\Application\Messenger\Queries\DetailBookQuery;
use App\Modules\Book\Application\Messenger\QueryResult\Detail\DetailQueryResult;
use App\Modules\Book\Application\Provider\BookProvider;

final readonly class DetailBookQueryHandler
{
    public function __construct(
        private BookProvider $bookProvider,
    ) {
    }

    public function __invoke(DetailBookQuery $query): DetailQueryResult
    {
        $book = $this->bookProvider->loadById($query->id);

        return DetailQueryResult::fromBook($book);
    }
}
