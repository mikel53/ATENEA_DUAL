<?php

namespace App\Repository;

use App\Entity\UsuarioRolGestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsuarioRolGestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsuarioRolGestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsuarioRolGestion[]    findAll()
 * @method UsuarioRolGestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioRolGestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuarioRolGestion::class);
    }

    // /**
    //  * @return UsuarioRolGestion[] Returns an array of UsuarioRolGestion objects
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
    public function findOneBySomeField($value): ?UsuarioRolGestion
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
