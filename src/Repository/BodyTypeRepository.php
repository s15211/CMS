<?php

namespace App\Repository;

use App\Entity\BodyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BodyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method BodyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method BodyType[]    findAll()
 * @method BodyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BodyTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BodyType::class);
    }

    // /**
    //  * @return BodyType[] Returns an array of BodyType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BodyType
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
