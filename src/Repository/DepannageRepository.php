<?php

namespace App\Repository;

use App\Entity\Depannage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Depannage>
 *
 * @method Depannage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Depannage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Depannage[]    findAll()
 * @method Depannage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepannageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Depannage::class);
    }

    //    /**
    //     * @return Depannage[] Returns an array of Depannage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Depannage
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
