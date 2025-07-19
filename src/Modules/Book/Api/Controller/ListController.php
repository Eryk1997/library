<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Controller;

use App\Modules\Book\Api\Model\List\ListRequestModel;
use App\Modules\Book\Api\Model\List\ListResponseModel;
use App\Modules\Book\Application\Messenger\QueryHandlers\ListBookQueryHandler;
use App\Shared\Api\Controller\AbstractApiController;
use App\Shared\Api\Model\PaginationModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/books', name: 'api_books_list', methods: ['GET'])]
class ListController extends AbstractApiController
{
    public function __invoke(
        #[MapQueryString]
        ListRequestModel $listRequestModel,
        ListBookQueryHandler $listBookQueryHandler,
    ): JsonResponse {
        $vo = $listBookQueryHandler($listRequestModel->toListBookQuery());

        return $this->successPaginatedData(
            ListResponseModel::fromPaginatorVO($vo),
            PaginationModel::fromPaginatorVO($vo),
        );
    }
}
