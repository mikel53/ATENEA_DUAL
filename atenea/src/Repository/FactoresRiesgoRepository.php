<?php

namespace App\Repository;

use App\Entity\FactoresRiesgo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FactoresRiesgo|null find($id, $lockMode = null, $lockVersion = null)
 * @method FactoresRiesgo|null findOneBy(array $criteria, array $orderBy = null)
 * @method FactoresRiesgo[]    findAll()
 * @method FactoresRiesgo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactoresRiesgoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FactoresRiesgo::class);
    }

    // /**
    //  * @return FactoresRiesgo[] Returns an array of FactoresRiesgo objects
    //  */
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
    public function findOneBySomeField($value): ?FactoresRiesgo
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
