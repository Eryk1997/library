<?php

declare(strict_types=1);

namespace App\Modules\Loan\Api\Model\Rent;

use App\Modules\Loan\Api\Validator\Constraint\BookAvailable;
use App\Modules\Loan\Api\Validator\Constraint\ExistBook;
use App\Modules\Loan\Application\Messenger\Command\RentCommand;
use App\Modules\Loan\Domain\ValueObject\LoanId;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

readonly class RentRequestModel
{
    public function __construct(
        #[NotBlank]
        #[ExistBook]
        #[BookAvailable]
        public string $bookId,
    ) {
    }

    public function toRentCommand(LoanId $id, UserInterface $user): RentCommand
    {
        return new RentCommand(
            id: $id,
            user: $user,
            bookId: $this->bookId,
        );
    }
}
