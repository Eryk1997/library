<?php

declare(strict_types=1);

namespace App\Modules\Book\Api\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UniqueBookTitle extends Constraint
{
    public string $message = 'book.title_already_exists';

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
