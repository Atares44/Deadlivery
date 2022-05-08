<?php

namespace App\Repository;

use App\Entity\Clients;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }


    /**
     * Requete permettant de récupérer les informations de l'utilisateur,
     * ainsi que les informations de son compte client si il est client
     *
     * @param int $id
     * @return User|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findWithClientInfo(int $id): ?User
    {

        return $this->createQueryBuilder('u')
            ->leftJoin('u.clientAccount', 'c')
            ->addSelect('c')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(50)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }


    public function findClientWithOrders(int $id): ?User
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.clientAccount', 'c')
            ->leftJoin('c.orders', 'o')
            ->leftJoin('o.orderProducts', 'p')
            ->leftJoin('o.orderService', 's')
            ->addSelect('c')
            ->addSelect('o')
            ->addSelect('p')
            ->addSelect('s')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(50)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    // /**
    //  * @return User[] Returns an array of User objects
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
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * Requete permettant de récupérer les informations de l'utilisateur,
     * ainsi que les informations de son compte client si il est client
     *
     * @param string $email
     * @return User|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findWithIdClient(string $email): ?User
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.clientAccount', 'c')
            ->addSelect('c')
            ->andWhere('u.userMail = :email')
            ->setParameter('email', $email)
            ->setMaxResults(50)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findByEmail(string $email): ?User{
        return $this->createQueryBuilder('u')
            ->addSelect('u')
            ->andWhere('u.userMail = :email')
            ->setParameter('email', $email)
            ->setMaxResults(50)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findWithAdresses(string $email){
        return $this->createQueryBuilder('u')
            ->leftJoin('u.userAdresses', 'a')
            ->addSelect('a')
            ->andWhere('u.userMail = :email')
            ->setParameter('email', $email)
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
            ;
    }
}
