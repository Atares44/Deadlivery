<?php

namespace App\Repository;

use App\Entity\ServicesType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use http\Env\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method ServicesType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServicesType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServicesType[]    findAll()
 * @method ServicesType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicesTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServicesType::class);
    }


    public function findWithZombies(int $id): ?ServicesType
    {

        return $this->createQueryBuilder('st')
            ->leftJoin('st.products', 'p')
            ->addSelect('p')
            ->andWhere('st.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(50)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findAllAvailable(){
        return $this->createQueryBuilder('s')
            ->andWhere('s.serviceTypeStatus = :status')
            ->setParameter('status', 'Available')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return ServicesType[] Returns an array of ServicesType objects
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
    public function findOneBySomeField($value): ?ServicesType
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
