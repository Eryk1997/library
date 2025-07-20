<?php

declare(strict_types=1);

namespace App\Modules\Loan\Domain\Repositories;

use App\Modules\Loan\Domain\Entity\Loan;

interface LoanRepositoryInterface
{
    public function save(Loan $loan);
}
