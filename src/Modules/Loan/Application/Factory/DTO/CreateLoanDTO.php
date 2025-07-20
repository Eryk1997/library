<?php

declare(strict_types=1);

namespace App\Modules\Loan\Application\Factory\DTO;

use App\Modules\Book\Domain\Entity\Book;
use App\Modules\Loan\Domain\Enums\Status;
use App\Modules\Loan\Domain\ValueObject\LoanId;
use Symfony\Component\Security\Core\User\UserInterface;

readonly class CreateLoanDTO
{
    public function __construct(
        public LoanId $loanId,
        public UserInterface $user,
        public Book $book,
        public Status $status,
    ) {
    }
}
