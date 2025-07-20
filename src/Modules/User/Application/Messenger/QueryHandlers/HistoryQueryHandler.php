<?php

declare(strict_types=1);

namespace App\Modules\User\Application\Messenger\QueryHandlers;

use App\Modules\Loan\Domain\Repositories\LoanQueryRepositoryInterface;
use App\Modules\Loan\Domain\ValueObject\Query\UserHistoryQuery;
use App\Modules\Loan\Domain\ValueObject\QueryResult\UserHistoryResult;
use App\Modules\User\Application\Messenger\Queries\History\HistoryQuery;
use App\Modules\User\Application\Validator\CheckHistoryAccess;

readonly class HistoryQueryHandler
{
    public function __construct(
        private LoanQueryRepositoryInterface $loanQueryRepository,
    ) {
    }

    /** @return UserHistoryResult[] */
    public function __invoke(HistoryQuery $historyQuery): array
    {
        CheckHistoryAccess::byUserIdAndUser($historyQuery->userId, $historyQuery->user);

        return $this->loanQueryRepository->loadUserHistory(new UserHistoryQuery($historyQuery->userId));
    }
}
