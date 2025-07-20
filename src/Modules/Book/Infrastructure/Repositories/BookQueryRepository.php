<?php

declare(strict_types=1);

namespace App\Modules\Book\Infrastructure\Repositories;

use App\Modules\Book\Domain\Entity\Book;
use App\Modules\Book\Domain\Repositories\BookQueryRepositoryInterface;
use App\Modules\Book\Domain\ValueObject\Query\ListBookQueryVO;
use App\Modules\Book\Domain\ValueObject\QueryResult\ListBookQueryResultVO;
use App\Shared\Infrastructure\Doctrine\Paginator\PaginatorFactory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method null|Book find($id, $lockMode = null, $lockVersion = null)
 * @method null|Book findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookQueryRepository extends ServiceEntityRepository implements BookQueryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /** @return Paginator<ListBookQueryResultVO> */
    public function findByListBookQuery(ListBookQueryVO $query): Paginator
    {
        $qb = $this->createQueryBuilder('book')
            ->select(sprintf(
                'NEW %s(
                    book.title.title,
                    book.author.author,
                    book.isbn.isbn,
                    book.yearPublished.yearPublished
                )',
                ListBookQueryResultVO::class,
            ))
        ;

        if ($query->author) {
            $qb
                ->andWhere('book.author.author LIKE :author')
                ->setParameter('author', '%'.$query->author.'%')
            ;
        }

        if ($query->title) {
            $qb
                ->andWhere('book.title.title LIKE :title')
                ->setParameter('title', '%'.$query->title.'%')
            ;
        }

        if ($query->isbn) {
            $qb
                ->andWhere('book.isbn.isbn = :isbn')
                ->setParameter('isbn', $query->isbn)
            ;
        }

        if ($query->yearPublished) {
            $qb
                ->andWhere('book.yearPublished.yearPublished = :yearPublished')
                ->setParameter('yearPublished', $query->yearPublished)
            ;
        }

        return PaginatorFactory::createScalarFromQuery($qb->getQuery(), $query->currentPage, $query->pageSize);
    }

    public function findById(string $id): ?Book
    {
        return $this->find($id);
    }

    public function findByTitle(string $title): ?Book
    {
        return $this->findOneBy(['title.title' => $title]);
    }
}
