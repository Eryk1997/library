<?php

declare(strict_types=1);

namespace App\Modules\Loan\Application\Messenger\CommandHandler;

use App\Modules\Loan\Application\Exception\LoanException;
use App\Modules\Loan\Application\Messenger\Command\ReturnCommand;
use App\Modules\Loan\Application\Provider\LoanProvider;
use App\Modules\Loan\Domain\Enums\Status;
use App\Modules\Loan\Domain\Repositories\LoanRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class ReturnCommandHandler
{
    public function __construct(
        private LoanProvider $loanProvider,
        private LoanRepositoryInterface $loanRepository,
    ) {
    }

    public function __invoke(ReturnCommand $command): void
    {
        $loan = $this->loanProvider->findById($command->id->toUuid());

        if ($loan->isReturned()) {
            throw new LoanException('loan.returned');
        }

        $loan->setStatus(Status::RETURNED);
        $loan->markReturned();

        $this->loanRepository->save($loan);
    }
}
