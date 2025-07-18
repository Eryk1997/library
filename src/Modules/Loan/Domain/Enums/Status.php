<?php

declare(strict_types=1);

namespace App\Modules\Loan\Domain\Enums;

enum Status: string
{
    case BORROWED = 'BORROWED';

    case RETURNED = 'RETURNED';
}
