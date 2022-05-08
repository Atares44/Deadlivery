<?php

namespace App\Repository;

use App\Entity\Role;
use App\Entity\ServicesType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    /**
     * Renvoie le rôle avec les utilisateurs ayant ce rôle
     * @param int $id
     * @return Role|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findWithUsers(int $id): ?Role
    {

        return $this->createQueryBuilder('r')
            ->leftJoin('r.users', 'u')
            ->addSelect('u')
            ->andWhere('r.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(50)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    // /**
    //  * @return Role[] Returns an array of Role objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Role
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
