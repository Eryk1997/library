<?php

declare(strict_types=1);

namespace App\Modules\Loan\Api\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ExistBook extends Constraint
{
    public string $message = 'book.not_found';

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
