<?php

namespace App\Repository;

use App\Entity\QuestionCat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuestionCat|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionCat|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionCat[]    findAll()
 * @method QuestionCat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionCatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuestionCat::class);
    }

//    /**
//     * @return QuestionCat[] Returns an array of QuestionCat objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionCat
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
