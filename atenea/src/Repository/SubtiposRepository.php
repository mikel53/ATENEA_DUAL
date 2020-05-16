<?php

namespace App\Repository;

use App\Entity\Subtipos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subtipos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subtipos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subtipos[]    findAll()
 * @method Subtipos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubtiposRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subtipos::class);
    }

    public function findByTipo($id){
        $q = $this->createQueryBuilder('c')
        ->where('c.tipos=:tipos_id')->setParameter('tipos_id', $id)
        ->getQuery()->getResult();
        return $q;

    }

    // /**
    //  * @return Subtipos[] Returns an array of Subtipos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subtipos
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
