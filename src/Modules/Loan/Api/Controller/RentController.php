<?php

declare(strict_types=1);

namespace App\Modules\Loan\Api\Controller;

use App\Modules\Loan\Api\Model\Rent\RentRequestModel;
use App\Modules\Loan\Domain\ValueObject\LoanId;
use App\Shared\Api\Controller\AbstractApiController;
use App\Shared\Infrastructure\Messenger\CommandBus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[AsController]
#[Route('/loans', name: 'api_loans_rent', methods: ['POST'])]
class RentController extends AbstractApiController
{
    public function __invoke(
        #[MapRequestPayload]
        RentRequestModel $rentRequestModel,
        CommandBus $commandBus,
        #[CurrentUser]
        ?UserInterface $user,
    ): JsonResponse {
        try {
            $id = LoanId::new();

            $commandBus->dispatch($rentRequestModel->toRentCommand($id, $user));

            return $this->successData($id);
        } catch (HandlerFailedException $exception) {
            return $this->successKnownIssueMessage($exception);
        }
    }
}
