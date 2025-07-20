<?php

declare(strict_types=1);

namespace App\Modules\Loan\Domain\Repositories;

use App\Modules\Loan\Domain\Enums\Status;

interface LoanQueryRepositoryInterface
{
    public function countByBookIdAndStatus(string $bookId, Status $status): int;
}
