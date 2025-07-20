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
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AsController]
#[IsGranted('ROLE_LIBRARIAN')]
#[Route('/books', name: 'api_books_create', methods: ['POST'])]
class CreateController extends AbstractApiController
{
    public function __invoke(
        #[MapRequestPayload]
        CreateRequestModel $createRequestModel,
        CommandBus $commandBus,
    ): JsonResponse {
        try {
            $id = BookId::new();
            $command = $createRequestModel->toCreateBookCommand($id);

            $commandBus->dispatch($command);

            return $this->successData($id);
        } catch (HandlerFailedException $exception) {
            return $this->successKnownIssueMessage($exception);
        }
    }
}
