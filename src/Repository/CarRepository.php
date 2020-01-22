<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function findByExampleField($name,$mark,$body,$engine)
    {
        if($name == 0 && $mark!= 0)
        {
            return $this->createQueryBuilder('c')
                ->andWhere("c.mark = :mark")
                ->setParameter('mark', $mark)
                ->orderBy('c.id', 'ASC')
                ->getQuery()
                ->getResult()
                ;
        }
        else if($name == 0 && $body != 0)
        {
            return $this->createQueryBuilder('c')
            ->andWhere("c.bodyType = :body")
            ->setParameter('body', $body)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
        }
        else if($mark != 0 && $body != 0 && $engine!=0)
        {
            return $this->createQueryBuilder('c')
                ->andWhere("c.name LIKE :name")
                ->setParameter('name', '%'.$name.'%')
                ->andWhere("c.mark = :mark")
                ->setParameter('mark', $mark)
                ->andWhere("c.bodyType = :body")
                ->setParameter('body', $body)
                ->andWhere("c.engineSize = :eng")
                ->setParameter('eng', $engine)
                ->orderBy('c.id', 'ASC')
                ->getQuery()
                ->getResult()
                ;
        }
        else if($mark != 0 && $body != 0)
        {
            return $this->createQueryBuilder('c')
                ->andWhere("c.name LIKE :name")
                ->setParameter('name', '%'.$name.'%')
                ->andWhere("c.mark = :mark")
                ->setParameter('mark', $mark)
                ->andWhere("c.bodyType = :body")
                ->setParameter('body', $body)
                ->getQuery()
                ->getResult()
                ;
        }
        else if($mark !=0 && $engine!= 0)
        {
            return $this->createQueryBuilder('c')
                ->andWhere("c.name LIKE :name")
                ->setParameter('name', '%'.$name.'%')
                ->andWhere("c.mark = :mark")
                ->setParameter('mark', $mark)
                ->andWhere("c.engineSize = :eng")
                ->setParameter('eng', $engine)
                ->orderBy('c.id', 'ASC')
                ->getQuery()
                ->getResult()
                ;
        }
        else if($body != 0 && $engine != 0)
        {
            return $this->createQueryBuilder('c')
                ->andWhere("c.name LIKE :name")
                ->setParameter('name', '%'.$name.'%')
                ->andWhere("c.bodyType = :body")
                ->setParameter('body', $body)
                ->andWhere("c.engineSize = :eng")
                ->setParameter('eng', $engine)
                ->orderBy('c.id', 'ASC')
                ->getQuery()
                ->getResult()
                ;
        }
        else if($mark != 0)
        {
            return $this->createQueryBuilder('c')
                ->andWhere("c.name LIKE :name")
                ->andWhere("c.mark = :mark")
                ->setParameter('name', '%'.$name.'%')
                ->setParameter('mark', $mark)
                ->getQuery()
                ->getResult()
                ;
        }
        else if($body != 0)
        {
            return $this->createQueryBuilder('c')
                ->andWhere("c.name LIKE :name")
                ->setParameter('name', '%'.$name.'%')
                ->andWhere("c.bodyType = :body")
                ->setParameter('body', $body)
                ->getQuery()
                ->getResult()
                ;
        }
        else if($engine != 0)
        {
            return $this->createQueryBuilder('c')
                ->andWhere("c.name LIKE :name")
                ->setParameter('name', '%'.$name.'%')
                ->andWhere("c.engineSize = :engine")
                ->setParameter('engine', $engine)
                ->getQuery()
                ->getResult()
                ;
        }
        else
        {
            return $this->createQueryBuilder('c')
            ->andWhere("c.name LIKE :name")
            ->setParameter('name', '%'.$name.'%')
            ->getQuery()
            ->getResult()
        ;
        }
    }
}
