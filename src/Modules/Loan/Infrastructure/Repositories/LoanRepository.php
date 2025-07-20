<?php

declare(strict_types=1);

namespace App\Modules\Loan\Infrastructure\Repositories;

use App\Modules\Loan\Domain\Entity\Loan;
use App\Modules\Loan\Domain\Repositories\LoanRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Loan>
 */
class LoanRepository extends ServiceEntityRepository implements LoanRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loan::class);
    }

    public function save(Loan $loan): void
    {
        $this->getEntityManager()->persist($loan);
        $this->getEntityManager()->flush();
    }
}
