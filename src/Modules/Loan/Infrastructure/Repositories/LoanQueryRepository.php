<?php

declare(strict_types=1);

namespace App\Modules\Loan\Infrastructure\Repositories;

use App\Modules\Loan\Domain\Entity\Loan;
use App\Modules\Loan\Domain\Enums\Status;
use App\Modules\Loan\Domain\Repositories\LoanQueryRepositoryInterface;
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
}
