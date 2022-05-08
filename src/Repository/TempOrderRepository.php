<?php

namespace App\Repository;

use App\Entity\TempOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TempOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method TempOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method TempOrder[]    findAll()
 * @method TempOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TempOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TempOrder::class);
    }

    public function findAllByProduct($id)
    {
        $dateNow = new \DateTime();
        $dateNow->modify("+6 days");
        return $this->createQueryBuilder('t')
            ->andWhere('t.tempOrderProductId = :prodId')
            ->andWhere('t.availableDate >= :dateNow')
            ->setParameter('prodId', $id)
            ->setParameter('dateNow', $dateNow)
            ->orderBy('t.tempStartDate', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByDate($id, $startDate, $endDate)
    {
        $dateNow = new \DateTime();
        $dateNow->modify("+6 days");
        return $this->createQueryBuilder('t')
            ->andWhere('t.tempOrderProductId = :prodId')
            ->andWhere('t.availableDate >= :dateNow')
            ->andWhere('t.tempStartDate BETWEEN :startDate AND :endDate')
            ->orWhere('t.availableDate BETWEEN :startDate AND :endDate')
            ->andWhere('t.tempOrderProductId = :prodId')
            ->andWhere('t.availableDate >= :dateNow')
            ->orWhere('t.tempStartDate < :startDate AND t.availableDate > :endDate')
            ->andWhere('t.tempOrderProductId = :prodId')
            ->andWhere('t.availableDate >= :dateNow')
            ->setParameter('prodId', $id)
            ->setParameter('startDate', $startDate)
            ->setParameter('dateNow', $dateNow)
            ->setParameter('endDate', $endDate)
            ->orderBy('t.tempStartDate', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return TempOrder[] Returns an array of TempOrder objects
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
    public function findOneBySomeField($value): ?TempOrder
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
