<?php

declare(strict_types=1);

namespace App\Modules\User\Api\Controller;

use App\Modules\User\Api\Model\Login\LoginRequestModel;
use App\Modules\User\Api\Model\Login\LoginResponseModel;
use App\Modules\User\Application\Exception\UserException;
use App\Modules\User\Application\Messenger\Queries\Login\LoginQuery;
use App\Modules\User\Application\Messenger\QueryHandlers\LoginQueryHandler;
use App\Shared\Api\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/auth/login', name: 'api_auth_login', methods: ['POST'])]
class LoginController extends AbstractApiController
{
    public function __invoke(
        #[MapRequestPayload]
        LoginRequestModel $loginRequestModel,
        LoginQueryHandler $loginQueryHandler,
    ): JsonResponse
    {
        try {
            $loginQueryResult = $loginQueryHandler(new LoginQuery(
                email: $loginRequestModel->email,
                password: $loginRequestModel->password,
            ));

            return $this->successData(LoginResponseModel::fromQueryResult($loginQueryResult));
        } catch (UserException $userException) {
            return $this->unknownIssueThrow($userException);
        }
    }
}
