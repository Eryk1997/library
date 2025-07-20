<?php

declare(strict_types=1);

namespace App\Modules\Loan\Application\Messenger\CommandHandler;

use App\Modules\Book\Application\Provider\BookProvider;
use App\Modules\Loan\Application\Factory\CreateLoanByCreateLoanDTOFactory;
use App\Modules\Loan\Application\Factory\DTO\CreateLoanDTO;
use App\Modules\Loan\Application\Messenger\Command\RentCommand;
use App\Modules\Loan\Domain\Enums\Status;
use App\Modules\Loan\Domain\Repositories\LoanRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RentCommandHandler
{
    public function __construct(
        private CreateLoanByCreateLoanDTOFactory $loadFactory,
        private BookProvider $bookProvider,
        private LoanRepositoryInterface $loanRepository,
    ) {
    }

    public function __invoke(RentCommand $command): void
    {
        $loan = $this->loadFactory->create(new CreateLoanDTO(
            loanId: $command->id,
            user: $command->user,
            book: $this->bookProvider->loadById($command->bookId),
            status: Status::BORROWED,
        ));

        $this->loanRepository->save($loan);
    }
}
