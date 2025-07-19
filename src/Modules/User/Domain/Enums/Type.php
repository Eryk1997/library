<?php

declare(strict_types=1);

namespace App\Modules\User\Domain\Enums;

enum Type: string
{
    case LIBRARIAN = 'LIBRARIAN';

    case MEMBER = 'MEMBER';
}
