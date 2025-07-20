<?php

declare(strict_types=1);

namespace App\Modules\Loan\Domain\Repositories;

use App\Modules\Loan\Domain\Entity\Loan;
use App\Modules\Loan\Domain\Enums\Status;
use App\Modules\Loan\Domain\ValueObject\Query\UserHistoryQuery;
use App\Modules\Loan\Domain\ValueObject\QueryResult\UserHistoryResult;

interface LoanQueryRepositoryInterface
{
    public function countByBookIdAndStatus(string $bookId, Status $status): int;

    public function findById(string $id): ?Loan;

    /** @return UserHistoryResult[] */
    public function loadUserHistory(UserHistoryQuery $query): array;
}
