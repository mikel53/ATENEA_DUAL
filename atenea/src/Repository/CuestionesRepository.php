<?php

namespace App\Repository;

use App\Entity\Cuestiones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cuestiones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cuestiones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cuestiones[]    findAll()
 * @method Cuestiones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuestionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cuestiones::class);
    }

    // /**
    //  * @return Cuestiones[] Returns an array of Cuestiones objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cuestiones
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
