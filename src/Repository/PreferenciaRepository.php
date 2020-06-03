<?php

namespace App\Repository;

use App\Entity\Preferencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Preferencia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Preferencia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Preferencia[]    findAll()
 * @method Preferencia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreferenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Preferencia::class);
    }

    // /**
    //  * @return Preferencia[] Returns an array of Preferencia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Preferencia
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
