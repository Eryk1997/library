<?php

declare(strict_types=1);

namespace App\Shared\Api\Exception;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    private const API_FIREWALL = 'login'; // albo 'api'

    public function __construct(
        private readonly Security $security,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ExceptionEvent::class => 'onException',
        ];
    }

    public function onException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        $request = $event->getRequest();
        $fwName = $this->security->getFirewallConfig($request)?->getName();

        if ($fwName !== self::API_FIREWALL) {
            return;
        }

        if ($throwable instanceof HttpExceptionInterface
            && $throwable->getPrevious() instanceof ValidationFailedException
        ) {
            /** @var ValidationFailedException $validation */
            $validation = $throwable->getPrevious();

            $errors = [];
            foreach ($validation->getViolations() as $violation) {
                $errors[$violation->getPropertyPath()][] = $violation->getMessage();
            }

            $response = new JsonResponse([
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'errors' => $errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

            $event->setResponse($response);

            return;
        }

        if ($throwable instanceof BadCredentialsException) {
            $response = new JsonResponse([
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => $throwable->getMessage(),
            ], Response::HTTP_UNAUTHORIZED);

            $event->setResponse($response);

            return;
        }
    }
}
