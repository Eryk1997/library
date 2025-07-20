<?php

declare(strict_types=1);

namespace App\Shared\Api\Controller;

use App\Shared\Api\Model\PaginationModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AbstractApiController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly TranslatorInterface $translator,
    ) {
    }

    protected function successData(mixed $data, int $response = Response::HTTP_OK): JsonResponse
    {
        return $this->json([
            'response' => true,
            'data' => $data,
        ], $response);
    }

    protected function unknownIssueThrow(\Throwable $throwable): JsonResponse
    {
        return $this->json([
            'response' => false,
            'errors' => [
                'message' => $this->translator->trans($throwable->getMessage(), [], 'exceptions'),
                'date' => new \DateTimeImmutable(),
            ],
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param array<string, string> $errors
     */
    protected function errors(array $errors, ?\Throwable $throwable = null): JsonResponse
    {
        return $this->json([
            'response' => false,
            'errors' => [
                'date' => new \DateTimeImmutable(),
                'message' => $this->translator->trans($throwable->getMessage(), [], 'exceptions'),
                $errors,
            ],
        ], Response::HTTP_BAD_REQUEST);
    }

    protected function successPaginatedData(mixed $data, PaginationModel $pagination): JsonResponse
    {
        return $this->json([
            'response' => true,
            'data' => $data,
            'pagination' => $pagination,
        ]);
    }

    /** @param array<int, string> $errors */
    protected function successKnownIssueMessage(\Exception $exception, array $errors = []): JsonResponse
    {
        $translatedMessage = 'Unexpected error';

        $previous = $exception->getPrevious();
        if ($previous && $previous->getMessage()) {
            $data = json_decode($previous->getMessage(), true);
            if (is_array($data) && isset($data['key'])) {
                $translatedMessage = $this->translator->trans($data['key'], $data['params'] ?? [], 'exceptions');
            } else {
                $translatedMessage = $this->translator->trans($previous->getMessage(), [], 'exceptions');
            }
        }

        return $this->json([
            'response' => 'false',
            'errors' => [
                'date' => new \DateTimeImmutable(),
                'message' => $translatedMessage,
            ],
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param array<string, mixed> $headers
     * @param array<string, mixed> $context
     */
    private function json(mixed $data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        $json = $this->serializer->serialize($data, 'json', array_merge([
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ], $context));

        return new JsonResponse($json, $status, $headers, true);
    }
}
