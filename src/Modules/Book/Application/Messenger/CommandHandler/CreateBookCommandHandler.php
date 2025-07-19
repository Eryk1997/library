<?php

declare(strict_types=1);

namespace App\Modules\Book\Application\Messenger\CommandHandler;

use App\Modules\Book\Application\Factory\CreateBookFactory;
use App\Modules\Book\Application\Messenger\Command\CreateBookCommand;
use App\Modules\Book\Domain\Repositories\BookRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreateBookCommandHandler
{
    public function __construct(
        private CreateBookFactory $createBookFactory,
        private BookRepositoryInterface $bookRepository,
    ) {
    }

    public function __invoke(CreateBookCommand $command): void
    {
        $book = $this->createBookFactory->createByCreateBookCommand($command);

        $this->bookRepository->save($book);
    }
}
