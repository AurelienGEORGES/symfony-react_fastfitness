<?php

namespace App\Repository;

use App\Entity\ReservationDieteticien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationDieteticien>
 *
 * @method ReservationDieteticien|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationDieteticien|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationDieteticien[]    findAll()
 * @method ReservationDieteticien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationDieteticienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationDieteticien::class);
    }

    public function add(ReservationDieteticien $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReservationDieteticien $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ReservationDieteticien[] Returns an array of ReservationDieteticien objects
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

//    public function findOneBySomeField($value): ?ReservationDieteticien
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
