<?php

declare(strict_types=1);

namespace App\Modules\Book\Domain\Exception;

class BookException extends \DomainException
{
    public function __construct(string $translationKey, array $params = [], ?\Throwable $previous = null)
    {
        $message = json_encode([
            'key' => $translationKey,
            'params' => $params,
        ]);

        parent::__construct($message, 0, $previous);
    }
}
