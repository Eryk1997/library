<?php

declare(strict_types=1);

namespace App\Modules\Loan\Api\Controller;

use App\Modules\Loan\Application\Messenger\Command\ReturnCommand;
use App\Modules\Loan\Domain\ValueObject\LoanId;
use App\Shared\Api\Controller\AbstractApiController;
use App\Shared\Infrastructure\Messenger\CommandBus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[AsController]
#[Route('/loans/{id}/return', name: 'api_loans_return', methods: ['PUT'])]
class ReturnController extends AbstractApiController
{
    public function __invoke(
        #[CurrentUser]
        ?UserInterface $user,
        CommandBus $commandBus,
        string $id,
    ): JsonResponse {
        try {
            $commandBus->dispatch(new ReturnCommand(
                id: LoanId::fromString($id),
                user: $user,
            ));

            return $this->successData($id);
        } catch (HandlerFailedException $exception) {
            return $this->successKnownIssueMessage($exception);
        }
    }
}
