<?php

declare(strict_types=1);

namespace App\Modules\Loan\Application\Provider;

use App\Modules\Loan\Domain\Enums\Status;
use App\Modules\Loan\Domain\Repositories\LoanQueryRepositoryInterface;

final readonly class LoanProvider
{
    public function __construct(private LoanQueryRepositoryInterface $loanQueryRepository)
    {
    }

    public function countByBookIdAndStatus(string $bookId, Status $status): int
    {
        return $this->loanQueryRepository->countByBookIdAndStatus($bookId, $status);
    }
}
