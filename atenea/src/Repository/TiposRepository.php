<?php

namespace App\Repository;

use App\Entity\Tipos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tipos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tipos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tipos[]    findAll()
 * @method Tipos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TiposRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tipos::class);
    }

    public function findByInternos(){
        $q = $this->createQueryBuilder('t')
        ->select('t')
        ->Where('t.interno=1')->getQuery();
        $result = $q->getResult();
        return $result;
    }

    public function findByExternos(){
        $q = $this->createQueryBuilder('t')
        ->select('t')
        ->Where('t.interno=0')->getQuery();
        $result = $q->getResult();
        return $result;
    }
    // /**
    //  * @return Tipos[] Returns an array of Tipos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tipos
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
