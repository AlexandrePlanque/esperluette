<?php

namespace App\Repository;

use App\Entity\FormResponses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormResponses|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormResponses|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormResponses[]    findAll()
 * @method FormResponses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormResponsesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormResponses::class);
    }

//    /**
//     * @return FormResponses[] Returns an array of FormResponses objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormResponses
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
