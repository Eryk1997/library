<?php

declare(strict_types=1);

namespace App\Modules\Loan\Api\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class BookAvailable extends Constraint
{
    public static string $message = 'book.available';

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
