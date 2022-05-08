<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

    public function findAllNotes(int $id): ?Products
    {

        return $this->createQueryBuilder('p')
            ->leftJoin('p.comments', 'c')
            ->addSelect('c')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findAllAvailable()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.productStatus != :status')
            ->setParameter('status', 'nonAvailable')
            ->getQuery()
            ->getResult();
    }

    public function findAllAvailableWithServId($id)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.productService', 's')
            ->andWhere('p.productStatus != :status')
            ->andWhere('s.id = :id' )
            ->setParameter('status', 'nonAvailable')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    public function findAllWithServId($id)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.productService', 's')
            ->andWhere('s.id = :id' )
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Products[] Returns an array of Products objects
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
    public function findOneBySomeField($value): ?Products
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
