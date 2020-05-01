<?php

namespace App\Repository;

use App\Entity\UnidadRolGestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnidadRolGestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnidadRolGestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnidadRolGestion[]    findAll()
 * @method UnidadRolGestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnidadRolGestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnidadRolGestion::class);
    }

    // /**
    //  * @return UnidadRolGestion[] Returns an array of UnidadRolGestion objects
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
    public function findOneBySomeField($value): ?UnidadRolGestion
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
