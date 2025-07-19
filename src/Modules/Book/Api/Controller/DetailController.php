<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Controller;

use App\Modules\Book\Api\Model\Detail\DetailResponseModel;
use App\Modules\Book\Application\Exception\BookException;
use App\Modules\Book\Application\Messenger\Queries\DetailBookQuery;
use App\Modules\Book\Application\Messenger\QueryHandlers\DetailBookQueryHandler;
use App\Shared\Api\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/books/{id}', name: 'api_books_detail', methods: ['GET'])]
class DetailController extends AbstractApiController
{
    public function __invoke(
        DetailBookQueryHandler $queryHandler,
        string $id
    ): JsonResponse {
        try {
            $result = $queryHandler(new DetailBookQuery(id: $id));

            return $this->successData(DetailResponseModel::fromDetailQueryResult($result));
        } catch (BookException $exception) {
            return $this->unknownIssueThrow($exception);
        }
    }
}
