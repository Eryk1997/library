<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Controller;

use App\Modules\Book\Api\Model\Create\CreateRequestModel;
use App\Modules\Book\Domain\ValueObject\BookId;
use App\Shared\Api\Controller\AbstractApiController;
use App\Shared\Infrastructure\Messenger\CommandBus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/books', name: 'api_books_create', methods: ['POST'])]
class CreateController extends AbstractApiController
{
    public function __invoke(
        #[MapRequestPayload]
        CreateRequestModel $createRequestModel,
        CommandBus $commandBus,
    ): JsonResponse {
        $id = BookId::new();
        $command = $createRequestModel->toCreateBookCommand($id);

        $commandBus->dispatch($command);

        return $this->successData($id);
    }
}
