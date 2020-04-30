<?php

namespace App\Repository;

use App\Entity\UnidadGestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnidadGestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnidadGestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnidadGestion[]    findAll()
 * @method UnidadGestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnidadGestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnidadGestion::class);
    }

    // /**
    //  * @return UnidadGestion[] Returns an array of UnidadGestion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UnidadGestion
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
