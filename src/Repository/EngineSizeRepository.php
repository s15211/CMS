<?php

namespace App\Repository;

use App\Entity\EngineSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EngineSize|null find($id, $lockMode = null, $lockVersion = null)
 * @method EngineSize|null findOneBy(array $criteria, array $orderBy = null)
 * @method EngineSize[]    findAll()
 * @method EngineSize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EngineSizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EngineSize::class);
    }

    // /**
    //  * @return EngineSize[] Returns an array of EngineSize objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EngineSize
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
