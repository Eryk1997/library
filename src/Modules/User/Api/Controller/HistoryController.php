<?php

declare(strict_types=1);

namespace App\Modules\User\Api\Controller;

use App\Modules\User\Api\Model\History\HistoryResponseModel;
use App\Modules\User\Application\Exception\UserException;
use App\Modules\User\Application\Messenger\Queries\History\HistoryQuery;
use App\Modules\User\Application\Messenger\QueryHandlers\HistoryQueryHandler;
use App\Shared\Api\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[AsController]
#[Route('/users/{id}/loans', name: 'api_users_loans', methods: ['GET'])]
class HistoryController extends AbstractApiController
{
    public function __invoke(
        #[CurrentUser]
        ?UserInterface $user,
        HistoryQueryHandler $historyQueryHandler,
        string $id,
    ): JsonResponse {
        try {
            $results = $historyQueryHandler(new HistoryQuery(
                userId: $id,
                user: $user,
            ));

            return $this->successData(HistoryResponseModel::multiple($results));
        } catch (UserException $exception) {
            return $this->unknownIssueThrow($exception);
        }
    }
}
