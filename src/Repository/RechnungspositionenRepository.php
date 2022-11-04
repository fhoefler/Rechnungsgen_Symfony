<?php

namespace App\Repository;

use App\Entity\Rechnungspositionen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rechnungspositionen>
 *
 * @method Rechnungspositionen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rechnungspositionen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rechnungspositionen[]    findAll()
 * @method Rechnungspositionen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechnungspositionenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rechnungspositionen::class);
    }

    public function save(Rechnungspositionen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Rechnungspositionen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Rechnungspositionen[] Returns an array of Rechnungspositionen objects
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

//    public function findOneBySomeField($value): ?Rechnungspositionen
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
