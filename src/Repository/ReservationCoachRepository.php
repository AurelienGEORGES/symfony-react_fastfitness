<?php

namespace App\Repository;

use App\Entity\ReservationCoach;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationCoach>
 *
 * @method ReservationCoach|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationCoach|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationCoach[]    findAll()
 * @method ReservationCoach[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationCoachRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationCoach::class);
    }

    public function add(ReservationCoach $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReservationCoach $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ReservationCoach[] Returns an array of ReservationCoach objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReservationCoach
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
