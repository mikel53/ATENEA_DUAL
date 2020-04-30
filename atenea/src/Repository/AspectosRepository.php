<?php

namespace App\Repository;

use App\Entity\Aspectos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Aspectos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aspectos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aspectos[]    findAll()
 * @method Aspectos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AspectosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aspectos::class);
    }

    // /**
    //  * @return Aspectos[] Returns an array of Aspectos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aspectos
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
