<?php

namespace App\Repository;

use App\Entity\IceCream;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IceCream|null find($id, $lockMode = null, $lockVersion = null)
 * @method IceCream|null findOneBy(array $criteria, array $orderBy = null)
 * @method IceCream[]    findAll()
 * @method IceCream[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IceCreamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IceCream::class);
    }

//    /**
//     * @return IceCream[] Returns an array of IceCream objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IceCream
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
