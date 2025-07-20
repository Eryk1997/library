<?php

declare(strict_types=1);

namespace App\Modules\Loan\Application\Messenger\Command;

use App\Modules\Loan\Domain\ValueObject\LoanId;
use App\Shared\Infrastructure\Messenger\CommandBus\Command;
use Symfony\Component\Security\Core\User\UserInterface;

readonly class RentCommand implements Command
{
    public function __construct(
        public LoanId $id,
        public UserInterface $user,
        public string $bookId,
    ) {
    }
}
