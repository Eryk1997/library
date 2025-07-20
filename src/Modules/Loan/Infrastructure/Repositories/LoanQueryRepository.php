<?php

declare(strict_types=1);

namespace App\Modules\Loan\Infrastructure\Repositories;

use App\Modules\Loan\Domain\Entity\Loan;
use App\Modules\Loan\Domain\Enums\Status;
use App\Modules\Loan\Domain\Repositories\LoanQueryRepositoryInterface;
use App\Modules\Loan\Domain\ValueObject\Query\UserHistoryQuery;
use App\Modules\Loan\Domain\ValueObject\QueryResult\UserHistoryResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Loan>
 */
class LoanQueryRepository extends ServiceEntityRepository implements LoanQueryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loan::class);
    }

    public function countByBookIdAndStatus(string $bookId, Status $status): int
    {
        return (int) $this->createQueryBuilder('loan')
            ->select('COUNT(loan.id)')
            ->where('loan.book = :bookId')
            ->andWhere('loan.status = :status')
            ->setParameter('bookId', $bookId)
            ->setParameter('status', $status)
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function findById(string $id): ?Loan
    {
        return $this->find($id);
    }

    /** @return UserHistoryResult[] */
    public function loadUserHistory(UserHistoryQuery $query): array
    {
        return $this->createQueryBuilder('loan')
            ->select(sprintf(
                'NEW %s(
                    book.title.title,
                    book.author.author,
                    book.isbn.isbn,
                    book.yearPublished.yearPublished,
                    loan.status,
                    loan.rentalDate,
                    loan.returnDate
                )',
                UserHistoryResult::class,
            ))
            ->leftJoin('loan.book', 'book')
            ->where('loan.user = :userId')
            ->setParameter('userId', $query->userId)
            ->getQuery()
            ->getResult()
        ;
    }
}
