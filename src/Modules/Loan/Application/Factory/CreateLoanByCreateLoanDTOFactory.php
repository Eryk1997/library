<?php

declare(strict_types=1);

namespace App\Modules\Loan\Application\Factory;

use App\Modules\Loan\Application\Factory\DTO\CreateLoanDTO;
use App\Modules\Loan\Domain\Entity\Loan;

class CreateLoanByCreateLoanDTOFactory
{
    public function create(CreateLoanDTO $createLoanDTO): Loan
    {
        return new Loan(
            id: $createLoanDTO->loanId->toUuid(),
            book: $createLoanDTO->book,
            user: $createLoanDTO->user,
            status: $createLoanDTO->status,
        );
    }
}
